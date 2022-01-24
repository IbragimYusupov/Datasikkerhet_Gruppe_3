<?php 
	include_once 'header.php';
	//Created a template
	$st_sql = "SELECT tilbakemelding FROM tilbakemelding_student WHERE id=?";
	//create a prepared statement
	$stmt = mysqli_stmt_init($conn);
?>
<main>
    <div class="content">
        <h2>Melding fra Student</h2>
        <div>
		<?php
		if (!mysqli_stmt_prepare($stmt, $st_sql)){
		echo "SQL statment failed";
		}	else {
		//Bind parameters to the placeholder
		mysqli_stmt_bind_param($stmt, "s", $_SESSION['tm']);
		//Run parameters inside database
		mysqli_stmt_execute($stmt);
		$st_result = mysqli_stmt_get_result($stmt);
		while ($st_row = mysqli_fetch_assoc($st_result)) {
			echo '<p>',$st_row["tilbakemelding"],'</p>';
		}
	}
		?>
            <div>
				<form action="includes/kommentar.inc.php" method="POST">
                <label>Kommentar
                    <input type="text" name="svar" placeholder="Kommentar">
					<?php echo'<input type="hidden" name="foreleser_id" value="',$_SESSION['user_id'] ,'">
					<input type="hidden" name="tilbakemelding_student_id" value="',$_SESSION['tm'] ,'">' ?>
                </label>
                <a href="ForeleserEmneMeldinger.php"><button type="submit" name="submit">Send</button></a>
				</form>
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