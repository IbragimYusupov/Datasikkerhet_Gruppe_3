<?php
	include_once 'header.php';
?>
<?php
	$foreleser_informasjon = "SELECT navn, etternavn, e_post FROM foreleser;";
	$foreleser_informasjon_result = mysqli_query($conn, $foreleser_informasjon);
	$foreleser_informasjon_resultCheck = mysqli_num_rows($foreleser_informasjon_result);
	
	$foreleser_fag = "SELECT em.navn, em.id FROM emne em
					  INNER JOIN foreleser_has_emne fhe ON em.id = fhe.emne_id
					  INNER JOIN foreleser fo ON fhe.foreleser_id = fo.id
					  WHERE fo.id = 1;";
	$foreleser_fag_result = mysqli_query($conn, $foreleser_fag);
	$foreleser_fag_resultCheck = mysqli_num_rows($foreleser_fag_result);
	
	$arrayOfEmneId = array();
	$nr_of_emne = 0;
?>
<main class="main">
    <div class="fag-seksjon">
        <h2>Liste med fag</h2>
        <div>
            <ul>
			<?php 
			if ($foreleser_fag_resultCheck > 0) {
				while($fag_row = mysqli_fetch_assoc($foreleser_fag_result)) {
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
			if ($foreleser_informasjon_resultCheck > 0) {
				while($foreleser_row = mysqli_fetch_assoc($foreleser_informasjon_result)) {?>
            <tr>
                <th><?php echo $foreleser_row['navn'], ' ', $foreleser_row['etternavn'];?></th>
                <th><?php echo $foreleser_row['e_post'];?></th>
            </tr>
			<?php } }?>
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