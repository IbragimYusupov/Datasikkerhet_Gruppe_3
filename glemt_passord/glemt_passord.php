/*
    Work is unfinished
    Code is taken from phpflow.com
*/

<?php
require_once ('connect.php');
require ('config.php');
require ('PHPMailer/PHPMailerAutoload.php');
if (isset($_POST) & !empty($_POST)) {
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $sql = "SELECT * FROM `login` WHERE email = '$email'";
    $res = mysqli_query($connection, $sql);
    $count = mysqli_num_rows($res);
    if ($count == 1) {
        $r = mysqli_fetch_assoc($res);
        $password = $r['password'];
        $to = $r['email'];
        $subject = "Your Recovered Password";
        $message = "Please use this password to login " . $password;
        $headers = "From : admin@phpflow.com";
        if (mail($to, $subject, $message, $headers)) {
            echo "Passordet har blitt send til din email id.";
        } else {
            echo "Mislykkes i å få tak i passordet ditt, prøv igjen!";
        }
    } else {
        echo "Email adressen eksisterer ikke i databasen.";
    }
}


<?php if(isset($smsg)){ ?> 
<?php echo $smsg; ?> 
<?php } ?> <?php if(isset($fmsg)){ ?> 
<?php echo $fmsg; ?> 
<?php } ?> 