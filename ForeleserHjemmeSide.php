<?php
	include_once 'header.php';
	$_SESSION['user_id'] = 1;
?>
<?php
	$foi_sql = "SELECT navn, etternavn, e_post FROM foreleser WHERE id = ?;";
	$foi_stmt = mysqli_stmt_init($conn);
	
	$fog_sql = "SELECT em.navn, em.id FROM emne em
					  INNER JOIN foreleser_has_emne fhe ON em.id = fhe.emne_id
					  INNER JOIN foreleser fo ON fhe.foreleser_id = fo.id
					  WHERE fo.id = ?;";
	$fog_stmt = mysqli_stmt_init($conn);
	
	$arrayOfEmneId = array();
	$nr_of_emne = 0;
?>
<main class="main">
    <div class="fag-seksjon">
        <h2>Liste med fag</h2>
        <div>
            <ul>
			<?php 
			if (!mysqli_stmt_prepare($fog_stmt, $fog_sql)) {
				echo "SQL statment failed";
			} else {
				mysqli_stmt_bind_param($fog_stmt, "i", $_SESSION['user_id']);
				mysqli_stmt_execute($fog_stmt);
				$fog_result = mysqli_stmt_get_result($fog_stmt);
				while($fag_row = mysqli_fetch_assoc($fog_result)) {
					array_push($arrayOfEmneId, $fag_row["id"]);
					echo 
					'<li>
					<form method="POST">
						<a href="ForeleserEmneMeldinger.php">
						<input type="hidden" name="emne" value="',$nr_of_emne,'">
							<button type="submit">', $fag_row["navn"], '</button>
						</a>
					</form>
					</li>';
					$nr_of_emne++;
				} 	
			}?>
			<?php
				function setEmne($arrayOfEmneId) {
					$emneNr = $_POST['emne'];
					$_SESSION['emne'] = $arrayOfEmneId[$emneNr];
					header("LOCATION: http://localhost/phpfiles/ForeleserEmneMeldinger.php");
				}
				if(array_key_exists('emne', $_POST)) {
					setEmne($arrayOfEmneId);
				}
			?>
            </ul>
        </div>
    </div>
    <div class="student-info">
        <h2>Foreleser Informasjon</h2>
        <table>
            <tr>
                <th>Navn</th>
                <th>Epost</th>
            </tr>
			<?php 
			if (!mysqli_stmt_prepare($foi_stmt, $foi_sql)) {
				echo "SQL statment failed";
			} else {
				mysqli_stmt_bind_param($foi_stmt, "i", $_SESSION['user_id']);
				mysqli_stmt_execute($foi_stmt);
				$foi_result = mysqli_stmt_get_result($foi_stmt);
				while($foreleser_row = mysqli_fetch_assoc($foi_result)) {
					echo '
					<tr>
					<th>',$foreleser_row["navn"],' ',$foreleser_row["etternavn"],'</th>
					<th>',$foreleser_row["e_post"],'</th>
					</tr>';
            
			 } }?>
        </table>
        <img src="temp" alt="Bilde av Foreleser">
    </div>
</main>
</body>
</html>

<style>
    table, th, td {
        border:1px solid black;
    }
	ul, li {
		list-style: none;
	}
    .nav-bar {
        display: flex;
        justify-content: space-evenly;
        align-items: center;
    }
    .fag-seksjon {
        display: flex;
        flex-direction: column;
    }
    .student-info {
        display: flex;
        flex-direction: column;
    }
    .main {
        display: flex;
        justify-content: space-evenly;
    }
</style>