<?php 
$navn = $_POST['navn'];
$etternavn = $_POST['etternavn'];
$e_post = $_POST['e_post'];
$passord = $_POST['passord'];
$emne = $_POST['emne'];


// koble til databasen: 

$conn = new mysqli('localhost', 'root','','datasikkerhet');
if(conn ->connect_error){
	echo "$conn->connect_error";
	die("Tilkobling Feilet :". $conn -> connect_error);
}else{
	$stmt = $conn->prepare("insert into registration(navn, etternavn, e_post, passord, emne) values(?, ?, ?, ?, ?)");
	$stmt->bind_param("sssss", $navn, $etternavn, $e_post, $passord, $emne);
	$execval = $stmt->execute(); 
	echo $execval;
	echo "Registrering fullført!";
	$stmt->close();
	$conn->close();
} 
?>