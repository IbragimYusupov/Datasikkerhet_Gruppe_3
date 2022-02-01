<?php 
include_once 'includes/dbh.inc.php';

 $sql = "SELECT navn FROM emne;";
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
    <h2>Registrering Foreleser</h2>
    <form action="includes/lagFor.php" method="post">
      <div class="input-box">
        <input type="text" placeholder="Skriv inn fornavn" name="navn" required>
      </div>
	  <div class="input-box">
        <input type="text" placeholder="Skriv inn etternavn" name="etternavn" required>
      </div>
      <div class="input-box">
        <input type="email" placeholder="Skriv inn e-post" name="e_post" required>
      </div>
      <div class="input-box">
        <input type="password" placeholder="Lag passord" name="passord" required>
      </div>
	   <div class="input-box">
        <input type="password" placeholder="Bekreft passord" name="Bpassord" required>
      </div>
	  Emne:
	  <select name="emne_liste" >
		<?php
			if(!mysqli_stmt_prepare($stmt, $sql)) {
				echo "SQL statment failed";
			} else {
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				while($row = mysqli_fetch_assoc($result)) {
					echo 
					'
					<option value="',$row["navn"],'">
					',$row["navn"] ,'
					</option>
					';
					
				}
			}
		?>
		</select>
	  
	  
	  <div required>
	  <label for="myfile">Legg til bilde:</label>
	  <input class="file-upload-input" type="file" onchange="readURL(this)" accept="Image/*" name="bilde_navn">
	  </div>
	  
      <div class="input-box button">
        <input type="submit" value="Registrer" name="submit">
      </div>
      <div class="text">
        <h3>Har du en bruker fra før? <a href="#">Logg inn her</a></h3>
		<h3>registrere som student? <a href="Reg2.php"> Studentregistrering</a></h3>
	  </div>
    </form>
  </div>
</body>
</html>
