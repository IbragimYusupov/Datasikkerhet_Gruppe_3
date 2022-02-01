	<?php 

	if (isset($_POST["submit"])){
		
		require_once 'dbh.inc.php';
		require_once 'functions.inc.php';
		
		$navn = mysqli_real_escape_string ($conn, $_POST["navn"]);
		$etternavn = mysqli_real_escape_string($conn, $_POST["etternavn"]);
		$e_post = mysqli_real_escape_string($conn, $_POST["e_post"]); 
		$passord = mysqli_real_escape_string($conn,$_POST["passord"] );
		$Bpassord = mysqli_real_escape_string($conn, $_POST["Bpassord"]);
		$studiekull = mysqli_real_escape_string($conn, $_POST["studiekull"]);
		$studieretning = mysqli_real_escape_string($conn, $_POST["studieretning_id"]);
		$fulltnavn = $navn . $etternavn;
		

		if(emptyInputSignup($navn, $etternavn, $e_post, $passord, $Bpassord, $studiekull, $studieretning) !== false){
			header ("location: ../Reg2.php?error=emptyinput");
			exit();
		}
		
		if (invalidUid($navn, $etternavn) !== false){
			header("location; ../Reg2.php?error=invalidUid");
			exit();
			}
		
		if (invalidepost($e_post) !== false){
			header("location; ../Reg2.php?error=invalidepost");
			exit();
		}
		if (passordulike($passord, $Bpassord) !== false){
			header("location; ../Reg2.php?error=passordulike");
			exit();
		}
	/*	if (eposttatt($conn, $e_post) !== false){
			header("location; ../Reg2.php?error=eposttatt");
			exit();
			} */
		if (studentExists($conn, $e_post) !== false){
			header("location: ../Reg2.php?error=eposttatt");
			exit();
		}	
	   createUser($conn, $navn, $etternavn, $e_post, $passord, $studiekull, $studieretning);
			
	}
	else {
			header("location: ../Reg2.php");
			exit();
	}
		