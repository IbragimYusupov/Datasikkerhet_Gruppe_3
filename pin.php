<?php

session_start();
	$_SESSION["PIN"] = $_POST['PIN'];
	header("Location: gjestebrukerkommentar.php");


