<?php
// Connect to db variable
include_once "includes/dbh.inc.php";

if(isset($_POST['submit_password']) && $_POST['email'] && $_POST['password'])
{
  $email= $_POST['email'];
  $pass = $_POST['password'];

  $select = mysqli_query($conn, "UPDATE foreleser SET passord = md5('$pass') WHERE md5(e_post) = '$email' LIMIT 1");
  echo '<p>Passordet er skiftet på din brukerkonto :)...kanskje</p>';
} else {
  echo '<p>Get rekt son.</p>';
}
?>