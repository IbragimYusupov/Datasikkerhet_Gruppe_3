<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);
/* htmlspecialchars validate specialchar
$_server return the response to the same site */	

$message_box = ""; //set an empty variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$message_box = validate_input($_POST["message-box"]);
}

/*function for validating data, code from w3schools*/
function validate_input($data) {
	$data = trim($data); // removes unnecessary characters
	$data = stripslashes($data); // remove backslashes
	$data = htmlspecialchars($data); // converts specialchar
	return $data;
}

?>
