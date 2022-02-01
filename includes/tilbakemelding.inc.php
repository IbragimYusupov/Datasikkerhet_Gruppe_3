<?php
	include_once 'dbh.inc.php';
	session_start();
	
	if (isset($_POST['submit'])) {
		$tidspunkt = mysqli_real_escape_string($conn, date("Y-m-d"));
		$tilbakemelding = mysqli_real_escape_string($conn, $_POST['tilbakemelding']);
		$student_id = mysqli_real_escape_string($conn, $_SESSION['user_id']);
		$emne_id = mysqli_real_escape_string($conn, $_POST['emne_id']);
		$svarGitForeleser = 0;
		
		if (empty($tilbakemelding)) {
			header("LOCATION: ../StudentHjemmeSide.php?error=tilbakemeldingTom");
			exit();
		}
		
		$sql = "INSERT INTO tilbakemelding_student (tidspunkt, tilbakemelding, svar_gitt_foreleser, emne_id, student_id)
			VALUES (?, ?, ?, ?, ?);";
		$stmtIn = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmtIn, $sql)) {
			echo "SQL error";
		} else {
			mysqli_stmt_bind_param($stmtIn, "isiii", $tidspunkt, $tilbakemelding, $svarGitForeleser, $emne_id, $student_id);
			mysqli_stmt_execute($stmtIn);
			mysqli_stmt_close($stmtIn);
			header("LOCATION: ../StudentHjemmeSide.php?tilbakemelding=sent");
			exit();
		}
	} else {
		header("LOCATION: ../StudentHjemmeSide.php?error=buttonNotUsed");
	}