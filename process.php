<?php
  //verdi
  $brukernavn = $POST['brukernavn']
  $passord = $POST['passord']

  //forhindre mysql-injeksjon
  $brukernavn = stripcslashes($brukernavn);
  $passord = stripcslashes($passord);
  $brukernavn = mysql_real_escape_string($brukernavn);
  $passord = mysql_real_escape_string($passord);

  //koble til server
  mysql_connect("localhost", "root", "");
  mysql_select_db("login");

  //spørre til server og velge database
  $result = mysql_query("velge * fra brukerne hvor brukernavn = '$username' og passord = '$passord'")
              or die("kunne ikke spørre databasen ".mysql_error());
  $row = mysql_fetch_array($result);
  if ($row['brukernavn'] == $brukernavn && $row['passord'] == $passord ) {
    echo "din innlogging ble suksessfull velkommen".row['brukernavn'];
  } else {
    echo "din innlogging ble feil";
  }
   ?>
