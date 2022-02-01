<?php

//Koble til databasen

$conn = new mysqli('localhost', 'root','','mydb');
if(!$conn){
	die("Tilkobling Feilet :". mysqli_connect_error());
}else{

}
