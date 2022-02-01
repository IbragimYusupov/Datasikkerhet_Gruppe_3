<?php

	if(isset($_POST["submit"])) {
		include_once 'dbh.inc.php';
		include_once 'functions.inc.php';
		
		$fname = mysqli_real_escape_string($conn, $_POST["fname"]);
		$lname = mysqli_real_escape_string($conn, $_POST["lname"]);
		$pwd = mysqli_real_escape_string($conn, $_POST["pwd"]);
		$pwdRepeat = mysqli_real_escape_string($conn, $_POST["pwdrepeat"]);
		$email = mysqli_real_escape_string($conn, $_POST["email"]);
		$file = $_FILES["file"];
		$emneList = $_POST["emne_list"];
		$fullName = $fname . $lname;
		
		if (emptyInputSignupForeleser($fname ,$lname ,$pwd ,$pwdRepeat ,$email, $file, $emneList) !== false) {
			header("location: ../ForeleserRegistrer.php?error=emptyInput");
			exit();
		} 
		if (invalidUid($fullName) !== false) {
			header("location: ../ForeleserRegistrer.php?error=invalidUid");
			exit();
		} 
		if (invalidEmail($email) !== false) {
			header("location: ../ForeleserRegistrer.php?error=invalidEmail");
			exit();
		} 
		if (pwdMatch($pwd, $pwdRepeat) !== false) {
			header("location: ../ForeleserRegistrer.php?error=passwordNotMatch");
			exit();
		} 
		if (foreleserExists($conn, $email) !== false) {
			header("location: ../ForeleserRegistrer.php?error=emailTaken");
			exit();
		} 
		
		createForeleser($conn, $fname, $lname, $pwd, $email);
		$userExists = foreleserExists($conn, $email);
		$foreleserId = $userExists["id"];
	
		registrerEmner($conn, $foreleserId, $emneList);
		
		registerBilde($conn, $file, $foreleserId);
		
	} else {
		header("location: ../ForeleserRegistrer.php");
		exit();
	}

?>