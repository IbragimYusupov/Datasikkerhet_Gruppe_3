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


$ForeleserBilde = "SELECT bilde.file_destination, bilde.bilde_navn, emne.navn, fo.etternavn, fo.navn as fornavn
				FROM bilde 
				INNER JOIN foreleser AS fo  ON fo.id = bilde.foreleser_id
				INNER JOIN foreleser_has_emne AS fhe ON fo.id = fhe.foreleser_id
				INNER JOIN emne ON emne.id = fhe.emne_id
				INNER JOIN studieretning_has_emne AS she ON fhe.emne_id = she.emne_id
				INNER JOIN studieretning AS sd on she.studieretning_id = sd.id
				INNER JOIN student AS st on sd.id = st.studieretning_id
				WHERE st.id = ?";
$bilde_init = mysqli_stmt_init($conn);



if(!mysqli_stmt_prepare($bilde_init, $ForeleserBilde)){
	echo "SQL statment failed";
} else {
	mysqli_stmt_bind_param($bilde_init, "i", $_SESSION['user_id']);
	mysqli_stmt_execute($bilde_init);
	$result_bilde = mysqli_stmt_get_result($bilde_init);
	$bilder = mysqli_fetch_all($result_bilde, MYSQLI_ASSOC);
}

$conn->close();
?>