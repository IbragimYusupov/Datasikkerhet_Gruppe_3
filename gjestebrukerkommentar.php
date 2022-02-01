<?php 
session_start();
include_once "includes/dbh.inc.php";
$sql = "SELECT id,tilbakemelding FROM tilbakemelding_student
INNER JOIN emne ON tilbakemelding_student.emne_id = emne.id
 WHERE pin=?;";
$stmt = mysqli_stmt_init($conn);
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

        <header>
        <h2> Gjesteinnlogging </h2>
        
        </header>
        
            <h2>Resultat</h2>
        
            <?php
	        //Prepare the prepared statement
	        if (!mysqli_stmt_prepare($stmt, $sql)){
		    echo "SQL statment failed";
	    }	else {
		    //Bind parameters to the placeholder
		    mysqli_stmt_bind_param($stmt, "i", $_SESSION['PIN']);
		    //Run parameters inside database
		    mysqli_stmt_execute($stmt);
		    $st_result = mysqli_stmt_get_result($stmt);
		
		    while ($st_row = mysqli_fetch_assoc($st_result)) {
			    array_push($arrayOfTmId, $st_row["id"]);
			    echo 
				    '<div class="melding">
					    <p>', $st_row["tilbakemelding"], '</p>
					    <form method="POST">
						    <a href="gjestekommentar.php">
						    <input type="hidden" name="melding" value="',$nrOfTm,'">
							    <button>Svar</button>
						    </a>
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
					header("LOCATION: gjestekommentar.php");
				}
				if(array_key_exists('melding', $_POST)) {
					setTm($arrayOfTmId);
				}
		?>
            
        </body>


</html>
