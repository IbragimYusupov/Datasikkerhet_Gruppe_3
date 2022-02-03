<?php
$email = $_POST['email'];
$unhashed_email = $_POST['email'];

if(isset($_POST['submit_email']) && $_POST['email']) {

  // Connect to db variable
  $db_connection = mysqli_connect("localhost","anton","DatabaseSikkerhet3!","datasikkerhet");

  // Sql query
  $select = mysqli_query($db_connection, "SELECT e_post,passord FROM foreleser WHERE e_post = '$email' LIMIT 1");
  if(mysqli_num_rows($select)==1) { 

    while($row=mysqli_fetch_array($select))
    {
      // MD5 Hash
      $email = md5($row['e_post']);
      $pass = md5($row['passord']);
    }

    // Link
    $link = "<a href='http://158.39.188.203/steg1/reset_pass.php?key=".$email."&reset=".$pass."'>Klikk her for å tilbakestille ditt passord</a>";

    // Send mail
    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );
    $from = "datasikkerhet.gruppe3@gmail.com";
    $to = $unhashed_email;
    $subject = "Tilbakestill ditt passord - HTT";
    $message = "This is a test to check the PHP Mail functionality" . $link; 
    $headers = "From:" . $from;
    
    mail($to, $subject, $message, $headers);
    $result = mail($to, $subject, $message, $headers);
    if($result ==  true)
    {
      echo 'Mailen er sendt. Sjekk innboksen din!:)';
    }
    else
    {
      echo 'Mailen ble ikke sendt! :(';
    }
  } else {
    echo '<p>Email does not exist.</p>';
  }
}
else {
  echo '<h1>Get rekt son.</h1>';
  echo '<iframe width="420" height="315" src="https://www.youtube.com/watch?v=dQw4w9WgXcQ"></iframe>';
}
?>