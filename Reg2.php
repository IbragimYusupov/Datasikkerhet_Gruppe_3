 <?php 
include_once 'includes/dbh.inc.php';

 $sql = "SELECT id, studieretning FROM studieretning;";
	$stmt =  mysqli_stmt_init($conn);
	$fog_stmt = mysqli_stmt_init($conn);
	
 ?>
 <!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body align="center">
  
  <div class="wrapper">
		<h2>Registrering Student</h2>
		<form action="includes/signup.inc.php" method="POST">
		<div class="input-box">
        <input type="text" placeholder="Skriv inn fornavn" name="navn">
		</div>
		<div class="input-box">
        <input type="text" placeholder="Skriv inn etternavn" name="etternavn">
		</div>
		<div class="input-box">
        <input type="text" placeholder="Skriv inn e-post"  name="e_post">
		</div>
		<div class="input-box">
        <input type="password" placeholder="Lag passord" name="passord">
		</div>
		<div class="input-box">
        <input type="password" placeholder="Bekreft passord" name="Bpassord">
		</div>

		<div class="input-box">
		<input type="number" placeholder="skriv inn studiekull" name="studiekull">
		</div >
			Studieretning:
		
		<select name="studieretning_id" >
		<?php
			if(!mysqli_stmt_prepare($stmt, $sql)) {
				echo "SQL statment failed";
			} else {
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				while($row = mysqli_fetch_assoc($result)) {
					echo 
					'
					<option value="',$row["id"],'">
					',$row["studieretning"] ,'
					</option>
					';
					
				}
			}
		?>
		</select>
		
      <div class="input-box button">
        <button type="submit" name="submit"> Registrer</button>
      </div>
      
		</form>
	</div>
<div class="text">
        <h3>Har du en bruker fra før? <a href="login_student.html">Logg inn her</a></h3>
		<h3>Registrere som foreleser? <a href="Reg2for.php"> Foreleserregistrering</a></h3>
      </div>
  </div>
</body>
</html>
