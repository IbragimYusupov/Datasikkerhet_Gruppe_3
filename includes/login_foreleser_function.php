<?php 
	
	if(isset($_POST["submit"])) {
		include_once 'dbh.inc.php';
		include_once 'functions.inc.php';
		
		$email = mysqli_real_escape_string($conn, $_POST["email"]);
		$pwd = mysqli_real_escape_string($conn, $_POST["pwd"]);
		
			if (emptyInputLogin($email, $pwd)) {
				header("location: ../index.php?error=emptyinput");
				exit();
			}
		loginForeleser($conn, $email, $pwd);
	} else {
		header("location: ../index.php");
		exit();
	}