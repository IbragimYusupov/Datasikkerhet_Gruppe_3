<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Hjemmeside</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Hjemmeside Foreleser</h1>
				<a href="profile.php"><i class="fas fa-user-circle"></i>profil</a>
				<a href="logout_foreleser.php"><i class="fas fa-sign-out-alt"></i>Logg ut</a>
			</div>
		</nav>
		<div class="content">
			<h2>Fag</h2>
			<p>Velkommen, <?=$_SESSION['name']?>!</p>
		</div>
	</body>
</html>
