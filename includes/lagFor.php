<?php
		
if (isset($_POST["submit"])){
		require_once 'dbh.inc.php';
		require_once 'functions.inc.php';
		
		$navn = mysqli_real_escape_string ($conn, $_POST["navn"]);
		$etternavn = mysqli_real_escape_string($conn, $_POST["etternavn"]);
		$e_post = mysqli_real_escape_string($conn, $_POST["e_post"]); 
		$passord = mysqli_real_escape_string($conn,$_POST["passord"] );
		$Bpassord = mysqli_real_escape_string($conn, $_POST["Bpassord"]);
		$emneListe = $_POST["emne_liste"];
		$file = $_FILES["file"];
		$fulltnavn = $navn.$etternavn;

		 if(emptyInputSignupForeleser($navn, $etternavn, $e_post, $passord, $Bpassord, $file, $emneListe) !== false){
			header ("location: ../Reg2for.php?error=emptyinput");
			exit();
		}
		
		if (imgAllowed($file) !== false) {
			header("location: ../Reg2for.php?error=imgInvalid");
			exit();
		}
	
		if (invalidUid($navn) !== false){
			header("location: ../Reg2for.php?error=invalidUid");
			exit();
			} 
		
		if (invalidepost($e_post) !== false){
			header("location: ../Reg2for.php?error=invalidepost");
			exit();
		}
		
		if (passordulike($passord, $Bpassord) !== false){
			header("location: ../Reg2for.php?error=passordulike");
			exit();
		}
		
		if (eposttattFor($conn, $e_post) !== false){
			header("location: ../Reg2for.php?error=eposttatt");
			exit();
		}	
		
	   createForeleser($conn, $navn, $etternavn, $e_post, $passord);
		$userExists = eposttattFor ($conn, $e_post);
		$foreleserid = $userExists["id"];
		echo "yes!6";
		registrerEmner($conn, $foreleserid, $emneListe);
		echo "yes!7";
		registrerBilde($conn, $file, $foreleserid);
		echo "yes!8";
}
	
	else {
			header("location: ../Reg2for.php");
			exit();
	} 

