<?php 
$navn = $_POST['navn'];
$etternavn = $_POST['etternavn'];
$e_post = $_POST['e_post'];
$passord = $_POST['passord'];
$studieretning = $_POST['studieretning'];
$studiekull = $_POST['studiekull'];

// koble til databasen: 

$conn = new mysqli('localhost', 'root','','datasikkerhet');
if(conn ->connect_error){
	echo "$conn->connect_error";
	die("Tilkobling Feilet :". $conn -> connect_error);
}else{
	$stmt = $conn->prepare("insert into registration(navn, etternavn, e_post, passord, studieretning, studiekull) values(?, ?, ?, ?, ?, ?)");
	$stmt->bind_param("sssssi", $navn, $etternavn, $e_post, $passord, $studieretning, $studiekull);
	$execval = $stmt->execute(); 
	echo $execval;
	echo "Registrering fullført!";
	$stmt->close();
	$conn->close();
} 
?>