<?php

if (isset($_POST["reset-request-submit"])) {
	
	require_once 'dbh.inc.php';
	include_once 'dunctions.inc.php';
	
	$userEmail = $_POST["email"];
	
	if (empty($userEmail)) {
		header("location: ../ForeleserGlemtPassord.php?error=empty");
		exit();
	}
	
	if (foreleserExists($conn, $userEmail) !== false) {
		header("location: ../ForeleserGlemtPassord.php?error=emailNotExits");
		exit();
	} 
	
	$selector = bin2hex(random_bytes(8));
	$token = random_bytes(32);
	
	$url = "http://158.39.188.203/steg1/create-new-foreleser-password.php?selector=".$selector."&validator".bin2hex($token);
	
	$expires = date("U") + 1800;
	
	
	$sql = "DELETE FROM pwdreset WHERE pwdResetEmail=?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		die("There was an error!");
	} else {
		mysqli_stmt_bind_param($stmt, "s", $userEmail);
		mysqli_stmt_execute($stmt);
	}
	
	$sql = "INSERT INTO pwdreset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) 
			VALUES (?, ?, ?, ?);";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		die("There was an error!");
	} else {
		$hasedToken = password_hash($token, PASSWORD_DEFAULT);
		mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $token, $expires);
		mysqli_stmt_execute($stmt);
	}
	
	mysqli_stmt_close($stmt);
	
	$to = $userEmail;
	
	$subject = 'Reset dit passord';
	
	$message = '<p>Du har bett om å resette passoret dit.</p>';
	$message .= '<p>Her er linken for å resette: </br>';
	$message .= '<a href="'. $url .'">'. $url .'</a></p>';
	
	$headers = "From: Gruppe3 <datasikkerhet.gruppe3@gmail.com>\r\n";
	$headers .= "Reply-To: datasikkerhet.gruppe3@gmail.com\r\n";
	$headers .= "Content-type: text/html\r\n";
	
	mail($to, $subject, $message, $headers);
	
	header("Location: ../ForeleserGlemtPassord.php?reset=success");
	
} else {
	header("Location: ../ForeleserLogInn.php");
}