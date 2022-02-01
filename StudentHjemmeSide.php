<?php

// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
$id = $_SESSION['id'];

  include_once 'connect.php';

  $stu_sql = "SELECT navn, etternavn, e_post, studiekull, studieretning FROM student, studieretning WHERE student.id=? AND
  student.studieretning_id = studieretning.id";
  $stu_stmt = mysqli_stmt_init($con);

  $emn_sql = "SELECT emne.navn from emne
  INNER JOIN studieretning_has_emne she ON emne.id = she.emne_id
  INNER JOIN studieretning sd on she.studieretning_id = sd.id
  INNER JOIN student st on sd.id = st.studieretning_id
  WHERE st.id = ?";

  $emn_stmt = mysqli_stmt_init($con);
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hjemmeside</title>
</head>
<body>
<header>
    <div class="nav-bar">
        <h1>Student hjemmeside</h1>
		
		<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logg ut</a>
		<a href="StudentTilbakemelding.php?">Tilbakemeldingskjema</a>
		
    </div>
</header>
<main class="main">
    <div class="fag-seksjon">
        <h2>Liste med fag</h2>
        <div>
            <ul>
              <?php
              if (!mysqli_stmt_prepare($emn_stmt, $emn_sql)) {
				            echo "SQL statment failed";
			      } else {
                mysqli_stmt_bind_param($emn_stmt, "i", $_SESSION['id']);
                mysqli_stmt_execute($emn_stmt);
                $emn_result = mysqli_stmt_get_result($emn_stmt);
                while($emne_row = mysqli_fetch_assoc($emn_result)) {
                  echo '
                  <li>',$emne_row["navn"],'</li>
                  ';
                }}
               ?>
            </ul>
        </div>
    </div>
    <div class="student-info">
        <h2>Student Informasjon</h2>
        <table>
            <tr>
                <th>Navn</th>
                <th>Epost</th>
                <th>Studentretning</th>
                <th>Studiekull</th>
            </tr>
            <tr>
              <?php
              if (!mysqli_stmt_prepare($stu_stmt, $stu_sql)) {
				            echo "SQL statment failed";
			      } else {
                mysqli_stmt_bind_param($stu_stmt, "i", $_SESSION['id']);
                mysqli_stmt_execute($stu_stmt);
                $stu_result = mysqli_stmt_get_result($stu_stmt);
                while($student_row = mysqli_fetch_assoc($stu_result)) {
                  echo '
                  <th>',$student_row["navn"],' ',$student_row["etternavn"],'</th>
                  <th>',$student_row["e_post"],'</th>
                  <th>',$student_row["studiekull"],'</th>
                  <th>',$student_row["studieretning"],'</th>
                  ';
                }}
               ?>

            </tr>
        </table>
    </div>
</main>
</body>
</html>

<style>
    table, th, td {
        border:1px solid black;
    }
    .nav-bar {
        display: flex;
        justify-content: space-evenly;
        align-items: center;
    }
    .fag-seksjon {
        display: flex;
        flex-direction: column;
    }
    .student-info {
        display: flex;
        flex-direction: column;
    }
    .main {
        display: flex;
        justify-content: space-evenly;
    }
</style>