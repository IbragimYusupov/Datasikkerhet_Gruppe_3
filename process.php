<?php
  //get value
  $brukernavn = $POST['brukernavn']
  $passord = $POST['passord']

  //prevent mysql injection
  $brukernavn = stripcslashes($brukernavn);
  $passord = stripcslashes($passord);
  $brukernavn = mysql_real_escape_string($brukernavn);
  $passord = mysql_real_escape_string($passord);

  //connect to the server
  mysql_connect("localhost", "root", "");
  mysql_select_db("login");

  //query to the server and select Database
  $result = mysql_query("select * from users where username = '$username' and password ='$passord'") or die();
   ?>
