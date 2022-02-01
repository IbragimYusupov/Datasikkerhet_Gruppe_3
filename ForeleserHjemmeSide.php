<?php
	include_once 'header.php';
?>
<?php
	$foi_sql = "SELECT fo.navn, fo.etternavn, fo.e_post, bilde.file_destination, bilde.bilde_navn
				FROM foreleser fo 
				INNER JOIN bilde ON fo.id = bilde.foreleser_id
				WHERE fo.id = ?;";
	$foi_stmt = mysqli_stmt_init($conn);
	
	$fog_sql = "SELECT em.navn, em.id FROM emne em
					  INNER JOIN foreleser_has_emne fhe ON em.id = fhe.emne_id
					  INNER JOIN foreleser fo ON fhe.foreleser_id = fo.id
					  WHERE fo.id = ?;";
	$fog_stmt = mysqli_stmt_init($conn);
	
	$sql = "SELECT studieretning FROM studieretning;";
	$stmt =  mysqli_stmt_init($conn);
	
	
	$arrayOfEmneId = array();
	$nr_of_emne = 0;
?>
<main class="main">
	<?php
	if (isset($_SESSION['type'])) {
		if ($_SESSION['type'] !== "f") {
		echo 'Du er ikke en foreleser';
		} else {
			include_once 'ForeleserContent.php';
		}
	} else {
		echo 
		'
			<p>Du er ikke logget inn</p>
			<a href="index.php">Logg Inn</a>
		';
	}
	?>
    
</main>
</body>
</html>

<style>
	img {
		border: 1px solid #ddd;
		border-radius: 4px;
		padding: 5px;
		width: 150px;
	}
    table, th, td {
        border:1px solid black;
    }
	ul, li {
		list-style: none;
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