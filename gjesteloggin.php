<?php
$pin = $_POST['PIN']

validPin(){
    if($pin == "4738"){
        header("location: /localhost/matte")

    }if($pin == "9938"){
        header("location: /localhost/engelsk")

    }if($pin == "7472"){
        header("location: /localhost/IT")

    }else{
        die("Ugyldig PIN" . header("location: /localhost/gjestebruker"))
        exit();
    }
}




//Koble til databasen

$conn = new mysqli('localhost', 'root','','mydb');
if(!$conn){
	die("Tilkobling Feilet :". mysqli_connect_error());
}else{

}