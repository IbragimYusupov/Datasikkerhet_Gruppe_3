<?php 
	include_once 'header.php';
	//Created a template
	$st_sql = "SELECT tilbakemelding, svar_gitt_foreleser FROM tilbakemelding_student WHERE id=?";
	$fo_sql ="SELECT svar FROM svar_foreleser WHERE tilbakemelding_student_id=?";
	//create a prepared statement
	$st_stmt = mysqli_stmt_init($conn);
	$fo_stmt = mysqli_stmt_init($conn);
?>
<main>
    <div class="content">
        <h2>Melding fra Student</h2>
        <div>
		<?php
		if (!mysqli_stmt_prepare($st_stmt, $st_sql)){
		echo "st_SQL statment failed";
		}	else {
		//Bind parameters to the placeholder
		mysqli_stmt_bind_param($st_stmt, "i", $_SESSION['tm']);
		//Run parameters inside database
		mysqli_stmt_execute($st_stmt);
		$st_result = mysqli_stmt_get_result($st_stmt);
		while ($st_row = mysqli_fetch_assoc($st_result)) {
			echo '<p>',$st_row["tilbakemelding"],'</p>
			<div>';
			if (!$st_row["svar_gitt_foreleser"]==1) {
					echo
						'
					<form action="includes/kommentar.inc.php" method="POST">
					<label>Kommentar</label>
                    <input type="text" name="svar" placeholder="Kommentar">
					<a href="ForeleserEmneMeldinger.php"><button type="submit" name="submit">Send</button></a>
					</form>
						';
					} else {
						if (!mysqli_stmt_prepare($fo_stmt, $fo_sql)) {
							echo 'fo_SQL statment failed';
						} else {
							mysqli_stmt_bind_param($fo_stmt, "i", $_SESSION['tm']);
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
			} 
			?>
								<a href="ForeleserEmneMeldinger.php">
									<button>Tilbake</button>
								</a>
            </div>
        </div>
    </div>
</main>

</body>

</html>

<style>
    .nav-bar {
        display: flex;
        justify-content: space-evenly;
        align-items: center;
    }
    main {
        display: flex;
        justify-content: center;
    }
    .content {
        justify-content: center;
    }
</style>