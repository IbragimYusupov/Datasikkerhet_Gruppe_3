<?php

if(isset($_POST["reset-password-submit"])) {
	
	$selector = $_POST["selector"];
	$validator = $_POST["validator"];
	$password = $_POST["pwd"];
	$passwordRepeat = $_POST["pwd-repeat"];
	
	if (empty($password) || empty($passwordRepeat)) {
		
	} else {
		header("Location: ../create-new-student-password.php?selector=".$selector."&validator".$validator."&passord=tom");
		exit();
	} elseif ($passwordRepeat != $passwordRepeat) {
		header("Location: ../create-new-student-password.php?selector=".$selector."&validator".$validator."&passord=tom");
		exit();
	}
	
	$currentDate = date("U");
	
	require_once 'dbh.inc.php';
	
	$sql = "SELECT * FROM pwdreset WHERE pwdResetSelector =? AND pwdResetExpires >= ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		die("There was an error!");
	} else {
		mysqli_stmt_bind_param($stmt, "s", $selector, $currentDate);
		mysqli_stmt_execute($stmt);
		
		$result = mysqli_stmt_reset($stmt);
		if (!$row = mysqli_fetch_assoc($result)) {
			die("Du trenger å gjøre det på nytt");
		} else {
			
			$tokenBin = hex2bin($validator);
			$tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);
			
			if ($tokenCheck === false) {
				die("Du trenger å gjøre det på nytt");
			} elseif ($tokenCheck === true) {
				
				$tokenEmail = $row["pwdResetEmail"];
				
				$sql = "SELECT * FROM student WHERE e_post=?;";
				$stmt = mysqli_stmt_init($conn);
				
				if (!mysqli_stmt_prepare($stmt, $sql)) {
					die("There was an error!");
				} else {
					
					mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
					mysqli_stmt_execute($stmt);
					$result = mysqli_stmt_reset($stmt);
					
					if (!$row = mysqli_fetch_assoc($result)) {
						die("There was an error!");
					} else {
						
						$sql = "UPDATE student SET passord=? WHERE e_post=?;";
						$stmt = mysqli_stmt_init($conn);
						
						if (!mysqli_stmt_prepare($stmt, $sql)) {
							die("There was an error!");
						} else {
							
							$hasedPwd = password_hash($password, PASSWORD_BCRYPT);
							mysqli_stmt_bind_param($stmt, "ss", $hasedPwd, $tokenEmail);
							mysqli_stmt_execute($stmt);
							
							$sql = "DELETE FROM pwdreset WHERE pwdResetEmail=?;";
							$stmt = mysqli_stmt_init($conn);
							if (!mysqli_stmt_prepare($stmt, $sql)) {
								die("There was an error!");
							} else {
								mysqli_stmt_bind_param($stmt, "s", $userEmail);
								mysqli_stmt_execute($stmt);
								header("Location: ../StudentLogInn.php?newpwd=passordopdatert");
							}
						}
					}
				}
			}
		}
	}
	
} else {
	header("Location: ../StudentLogInn.php");
}