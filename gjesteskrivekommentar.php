<?php 
session_start();
include_once "includes/dbh.inc.php";
$st_sql = "SELECT tilbakemelding, svar_gitt_foreleser FROM tilbakemelding_student WHERE id=?";
$fo_sql ="SELECT svar FROM svar_foreleser WHERE tilbakemelding_student_id=?";
$gj_sql ="SELECT kommentar FROM kommentar_gjest WHERE tilbakemelding_student_id=?";
//create a prepared statement
$st_stmt = mysqli_stmt_init($conn);
$fo_stmt = mysqli_stmt_init($conn);
$gj_stmt = mysqli_stmt_init($conn);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Gjestebruker </title>
    <link rel="stylesheet" href="stil.css">
    </head>

        <body>

        <header>
        <h2> Gjesteinnlogging </h2>
		<a href="gjestebrukerkommentar.php">Tilbake</a>
        
        </header>
        
            <h2>Resultat</h2>
        
            <?php
		if (!mysqli_stmt_prepare($st_stmt, $st_sql)){
		echo "st_SQL statment failed";
		}	else {
		//Bind parameters to the placeholder
		mysqli_stmt_bind_param($st_stmt, "i", $_SESSION['gtm']);
		//Run parameters inside database
		mysqli_stmt_execute($st_stmt);
		$st_result = mysqli_stmt_get_result($st_stmt);
		while ($st_row = mysqli_fetch_assoc($st_result)) {
			echo '<p>',$st_row["tilbakemelding"],'</p>
			<div>';
			
					echo
						'
					<form action="includes/gjestkommentar.inc.php" method="POST">
					<label>Kommentar</label>
                    <input type="text" name="svar" placeholder="Kommentar">
					<button type="submit" name="submit">Send</button>
					</form>
						';
					if ($st_row["svar_gitt_foreleser"]===1) {
						if (!mysqli_stmt_prepare($fo_stmt, $fo_sql)) {
							echo 'fo_SQL statment failed';
						 if (!$st_row["svar_gitt_foreleser"]==1){
							mysqli_stmt_bind_param($fo_stmt, "i", $_SESSION['gtm']);
							mysqli_stmt_execute($fo_stmt);
							$fo_result = mysqli_stmt_get_result($fo_stmt);
							while ($fo_row = mysqli_fetch_assoc($fo_result)){
								echo 
								'
								<h3>Svar gitt</h3>
								<p>',$fo_row["svar"] ,'</p>
								';
							}
						}
					}
				}

                if (!mysqli_stmt_prepare($gj_stmt, $gj_sql)) {
                    echo 'fo_SQL statment failed';
                } else {
                    mysqli_stmt_bind_param($gj_stmt, "i", $_SESSION['gtm']);
                    mysqli_stmt_execute($gj_stmt);
                    $gj_result = mysqli_stmt_get_result($gj_stmt);
                    while ($gj_row = mysqli_fetch_assoc($gj_result)){
                    echo 
                    '
                    <h3>Svar gitt</h3>
                    <p>',$gj_row["kommentar"] ,'</p>
                    ';
                    }
                }

		}} 
			?>

        </body>


</html>
