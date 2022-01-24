<?php
if (isset($_POST) & !empty($_POST)) {
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $sql = "SELECT * FROM `login` WHERE email = '$email'";
    $res = mysqli_query($connection, $sql);
    $count = mysqli_num_rows($res);
    if ($count == 1) {
        echo "Send email to user with password";
    } else {
        echo "User name does not exist in database";
    }
}
?>