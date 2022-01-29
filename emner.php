<?php
include_once 'connect.php';
$emneNavn = 'SELECT navn FROM emne';
$emneNavn_init = mysqli_stmt_init($con);

if(!mysqli_stmt_prepare($emneNavn_init, $emneNavn)){
	echo "SQL statment failed";
} else {
	mysqli_stmt_execute($emneNavn_init);
	$result = mysqli_stmt_get_result($emneNavn_init);
	$emner = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

$con->close();
?>