<?php

	if(isset($_POST["submit"])) {
		include_once 'dbh.inc.php';
		include_once 'functions.inc.php';
		
		$fname = mysqli_real_escape_string($conn, $_POST["fname"]);
		$lname = mysqli_real_escape_string($conn, $_POST["lname"]);
		$pwd = mysqli_real_escape_string($conn, $_POST["pwd"]);
		$pwdRepeat = mysqli_real_escape_string($conn, $_POST["pwdrepeat"]);
		$email = mysqli_real_escape_string($conn, $_POST["email"]);
		$studiekull = mysqli_real_escape_string($conn, $_POST["studiekull"]);
		$studieretning = mysqli_real_escape_string($conn, $_POST["studieretning_id"]);
		$fullName = $fname . $lname;
		
		if (emptyInputSignupStudent($fname ,$lname ,$pwd ,$pwdRepeat ,$email, $studiekull, $studieretning) !== false) {
			header("location: ../StudentRegistrer.php?error=emptyInput");
			exit();
		} 
		if (invalidUid($fullName) !== false) {
			header("location: ../StudentRegistrer.php?error=invalidUid");
			exit();
		} 
		if (invalidEmail($email) !== false) {
			header("location: ../StudentRegistrer.php?error=invalidEmail");
			exit();
		} 
		if (pwdMatch($pwd, $pwdRepeat) !== false) {
			header("location: ../StudentRegistrer.php?error=passwordNotMatch");
			exit();
		} 
		if (studentExists($conn, $email) !== false) {
			header("location: ../StudentRegistrer.php?error=emailTaken");
			exit();
		} 
		
		createStudent($conn, $fname, $lname, $pwd, $email, $studiekull, $studieretning);
		
	} else {
		header("location: ../StudentRegistrer.php");
		exit();
	}

?>