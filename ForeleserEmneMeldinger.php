<?php
	include_once 'header.php';
	//Created a template
	$st_sql = "SELECT id, tilbakemelding FROM tilbakemelding_student WHERE emne_id=?";
	//create a prepared statement
	$stmt = mysqli_stmt_init($conn);
	
	$arrayOfTmId = array();
	$nrOfTm = 0;
?>
<main>
    <h2 class="tittel">Emne Navn</h2>
    <h3>Meldinger</h3>
    <div class="meldinger">
	<?php
	//Prepare the prepared statement
	if (!mysqli_stmt_prepare($stmt, $st_sql)){
		echo "SQL statment failed";
	}	else {
		//Bind parameters to the placeholder
		mysqli_stmt_bind_param($stmt, "i", $_SESSION['emne']);
		//Run parameters inside database
		mysqli_stmt_execute($stmt);
		$st_result = mysqli_stmt_get_result($stmt);
		
		while ($st_row = mysqli_fetch_assoc($st_result)) {
			array_push($arrayOfTmId, $st_row["id"]);
			echo 
				'<div class="melding">
					<p>', $st_row["tilbakemelding"], '</p>
					<form method="POST">
						<a href="ForeleserKomentar.php">
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
					$_SESSION['tm'] = $arrayOfTmId[$tmNr];
					header("LOCATION: http://localhost/phpfiles/ForeleserKomentar.php");
				}
				if(array_key_exists('melding', $_POST)) {
					setTm($arrayOfTmId);
				}
		?>
    </div>
</main>
<footer>
    <p>Footer Info</p>
</footer>
</body>
</html>

<style>
    .nav-bar {
        display: flex;
        justify-content: space-evenly;
        align-items: center;
    }
    .tittel {
        display: flex;
        justify-content: center;
    }
    h3 {
        display: flex;
        justify-content: center;
    }
    .meldinger {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-evenly;
    }
    .melding {
        border: solid black;
    }
</style>