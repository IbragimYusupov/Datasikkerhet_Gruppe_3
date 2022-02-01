<?php
include_once 'includes/dbh.inc.php';
$emneNavn = "SELECT emne.navn from emne
  INNER JOIN studieretning_has_emne she ON emne.id = she.emne_id
  INNER JOIN studieretning sd on she.studieretning_id = sd.id
  INNER JOIN student st on sd.id = st.studieretning_id
  WHERE st.id = ?";
$emneNavn_init = mysqli_stmt_init($conn);



if(!mysqli_stmt_prepare($emneNavn_init, $emneNavn)){
	echo "SQL statment failed";
} else {
	mysqli_stmt_bind_param($emneNavn_init, "i", $_SESSION['user_id']);
	mysqli_stmt_execute($emneNavn_init);
	$result = mysqli_stmt_get_result($emneNavn_init);
	$emner = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

$conn->close();
?>