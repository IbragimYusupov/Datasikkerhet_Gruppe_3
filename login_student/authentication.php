<?php
    include('connection.php');
    $e_post = $_POST['user'];
    $passord = $_POST['pass'];

        //to prevent from mysqli injection
        $e_post = stripcslashes($e_post);
        $passord = stripcslashes($passord);
        $e_post = mysqli_real_escape_string($con, $e_post);
        $passord = mysqli_real_escape_string($con, $passord);

        $sql = "select * from student where e_post = '$e_post' and passord = '$passord'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);

        if($count == 1){
            echo "<h1><center> Login successful </center></h1>";
        }
        else{
            echo "<h1> Login failed. Invalid username or password.</h1>";
        }
?>
