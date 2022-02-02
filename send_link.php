<?php
// require 'phpmailer/includes/PHPMailer.php';
// require 'phpmailer/includes/SMTP.php';
// require 'phpmailer/includes/Exception.php';

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;
// use PHPMailer\PHPMailer\SMTP;

$email = $_POST['email'];
$unhashed_email = $_POST['email'];

if(isset($_POST['submit_email']) && $_POST['email']) {

  // Connect to db variable
  $db_connection = mysqli_connect("localhost","root","","datasikkerhet");
  if(!$db_connection){
    die("Connection failed:". mysqli_connect_error());
  }

  // Sql query
  $select = mysqli_query($db_connection, "SELECT e_post,passord FROM foreleser WHERE e_post = '$email' LIMIT 1");
  if(mysqli_num_rows($select)==1) { 

    while($row=mysqli_fetch_array($select))
    {
      // MD5 Hash
      $email = md5($row['e_post']);
      $pass = md5($row['passord']);
    }

    // Instantiate PHPMailer
    // $mail = new PHPMailer(true);

    // Server Settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;  // <-For debugging
    // $mail->CharSet = "utf-8";
    // $mail->IsSMTP();
    // $mail->Host = "smtp.gmail.com";
    // $mail->SMTPAuth = true;  
    // $mail->Username = "reset.pwd.datasikkerhet.gruppe3@gmail.com";
    // $mail->Password = "";
    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   
    // $mail->Port = 587;

    // Recipient
    // $mail->setFrom('reset.pwd.datasikkerhet.gruppe3@gmail.com','Tilbakemeldingstjeneste');
    // $mail->addAddress($unhashed_email);

    // Content
    // $mail->IsHTML(true);
    // $mail->Subject = 'Reset Password';
    // Password reset link
    // $link = "<a href='http://158.39.188.203/steg1/reset_pass.php?key=".$email."&reset=".$pass."'>Klikk her for å oppdatere passordet ditt hos Tilbakemeldingstjenesten på Høgskolen i Østfold.</a>";
    // $mail->Body = $link;
    // if($mail->Send())
    {
      echo "Check Your Email and click on the link sent to your email.";
    }
    else {
      echo "Mail Error - >".$mail->ErrorInfo;
    }
  } else {
    echo '<p>Email does not exist.</p>';
  }
}
else {
  echo '<p>Get rekt son.</p>';
}
?>