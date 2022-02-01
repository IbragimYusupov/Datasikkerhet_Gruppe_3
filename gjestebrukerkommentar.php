<?php 
session_start();
include_once "includes/dbh.inc.php";
$sql = "SELECT ts.id, ts.tilbakemelding 
		FROM tilbakemelding_student ts
		INNER JOIN emne ON ts.emne_id = emne.id
		WHERE pin_kode=?;";
$stmt = mysqli_stmt_init($conn);

$foi_sql = "SELECT bilde.file_destination, bilde.bilde_navn
				FROM bilde 
				INNER JOIN foreleser fo  ON fo.id = bilde.foreleser_id
				INNER JOIN foreleser_has_emne fhe ON fo.id = fhe.foreleser_id
				INNER JOIN emne ON emne.id = fhe.emne_id
				WHERE emne.pin_kode = ?;";
$foi_stmt = mysqli_stmt_init($conn);

$arrayOfTmId = array();
    $nrOfTm = 0;
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Gjestebruker </title>
    <link rel="stylesheet" href="stil.css">
    </head>

        <body>
		<?php
	        //Prepare the prepared statement
	        if (!mysqli_stmt_prepare($foi_stmt, $foi_sql)){
		    echo "SQL statment failed";
	    }	else {
		    //Bind parameters to the placeholder
		    mysqli_stmt_bind_param($foi_stmt, "i", $_SESSION["PIN"]);
		    //Run parameters inside database
		    mysqli_stmt_execute($foi_stmt);
		    $result = mysqli_stmt_get_result($foi_stmt);
		    while ($row = mysqli_fetch_assoc($result)) {
			    echo 
				    '<div>
					   <img src="http://localhost/phpfiles/uploads/',$row["file_destination"],'" alt="',$row["bilde_navn"],'">
				    </div>';
		}
	}
	?>

        <header>
        <h2> Gjesteinnlogging </h2>
        <form action="includes/logout.php" method="POST">
		<button type="submit" name="submitLogout">Logg ut</button>
		</form>
        </header>
        
            <h2>Resultat</h2>
        
            <?php
	        //Prepare the prepared statement
	        if (!mysqli_stmt_prepare($stmt, $sql)){
		    echo "SQL statment failed";
	    }	else {
		    //Bind parameters to the placeholder
		    mysqli_stmt_bind_param($stmt, "i", $_SESSION["PIN"]);
		    //Run parameters inside database
		    mysqli_stmt_execute($stmt);
		    $st_result = mysqli_stmt_get_result($stmt);
		
		    while ($st_row = mysqli_fetch_assoc($st_result)) {
			    array_push($arrayOfTmId, $st_row["id"]);
			    echo 
				    '<div class="melding">
					    <p>', $st_row["tilbakemelding"], '</p>
					    <form method="POST">
						    <input type="hidden" name="melding" value="',$nrOfTm,'">
							    <button>Svar</button>
					    </form>
				    </div>';
				
			$nrOfTm++;
		}
	}
	?>
		<?php
				function setTm($arrayOfTmId) {
					$tmNr = $_POST['melding'];
					$_SESSION['gtm'] = $arrayOfTmId[$tmNr];
					header("LOCATION: gjesteskrivekommentar.php");
				}
				if(array_key_exists('melding', $_POST)) {
					setTm($arrayOfTmId);
				}
		?>
            
        </body>


</html>

<style>
img {
		border: 1px solid #ddd;
		border-radius: 4px;
		padding: 5px;
		width: 150px;
	}
</style>
