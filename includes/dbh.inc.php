<?php
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "datasikkerhet";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
 if(!$conn){
	die("Tilkobling Feilet :". mysqli_connect_error());
}

