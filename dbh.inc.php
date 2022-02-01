<?php

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "datasikkerhet";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
	die("Tilkobling feilet:  " .mysqli_connect_error());
}