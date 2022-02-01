<?php
		
if (isset($_POST["submit"])){
		require_once 'dbh.inc.php';
		require_once 'functions.inc.php';
		
		$navn = mysqli_real_escape_string ($conn, $_POST["navn"]);
		$etternavn = mysqli_real_escape_string($conn, $_POST["etternavn"]);
		$e_post = mysqli_real_escape_string($conn, $_POST["e_post"]); 
		$passord = mysqli_real_escape_string($conn,$_POST["passord"] );
		$Bpassord = mysqli_real_escape_string($conn, $_POST["Bpassord"]);
		$file = "test";
		$emneListe = $_POST["emne_liste"];
		$fulltnavn = $navn.$etternavn;

		 if(emptyInputSignupForeleser($navn, $etternavn, $e_post, $passord, $Bpassord, $file, $emneListe) !== false){
			header ("location: ../Reg2For.php?error=emptyinput");
			exit();
		}
	
		if (invalidUid($navn, $etternavn) !== false){
			header("location; ../Reg2For.php?error=invalidUid");
			exit();
			}
		
		if (invalidepost($e_post) !== false){
			header("location; ../Reg2For.php?error=invalidepost");
			exit();
		}
	
		if (passordulike($passord, $Bpassord) !== false){
			header("location; ../Reg2For.php?error=passordulike");
			exit();
		}
		if (eposttatt($conn, $e_post) !== false){
			header("location; ../Reg2For.php?error=eposttatt");
			exit();
			} 
		
		if (foreleserExists($conn, $e_post) !== false){
			header("location: ../Reg2.php?error=eposttatt");
			exit(); 
		}	
	   createForeleser($conn, $navn, $etternavn, $e_post, $passord);
		$userExists = ForeleserExists ($conn, $e_post);
		$foreleserid = $userExists["id"];
		
		registrerEmner($conn, $foreleser_id, $emneListe);
		registrerBilde($conn, $file, $foreleser_id);
}
	
	else {
			header("location: ../Reg2For.php");
			exit();
	} 