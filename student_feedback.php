<?php echo htmlspecialchars($_SERVER["StudentTilbakemelding.php"]);
/* htmlspecialchars validate specialchar
$_server return the response to the same site */

$host="127.0.0.1";
$port=3306;
$socket="";
$user="root";
$password="";
$dbname="mydb";

$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());

	
/*function for validating data, code from w3schools*/
function validate_input($data) {
	$data = trim($data); // removes unnecessary characters
	$data = stripslashes($data); // remove backslashes
	$data = htmlspecialchars($data); // converts specialchar
	return $data;
}	

$emne = filter_input(INPUT_POST, 'emne', FILTER_SANITIZE_STRING);

$emneId = "select id from emne where navn = $emne";

$message_box = ""; //set an empty variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$message_box = validate_input($_POST["message-box"]);
}




$sql = "INSERT INTO `tilbakemelding_student` (`id`, `tidspunkt`, `tilbakemelding`, `svar_gitt_foreleser`, `emne_id`, `student_id`) VALUES (NULL, '', '$message_box', '0', '$emneId', '1')";

if($con -> query($sql) === TRUE) {
	echo "Tilbakemelding gitt";
}else{
	echo "Error:" . $sql . "<br>" . $con->error;
}
$con->close();

?>