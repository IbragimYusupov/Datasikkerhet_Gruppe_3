<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/stilark.css">
    <title>logg inn</title>
  </head>
  <body>
    <h1>dette er en loginside</h1>
      <form class="" action="process.php" method="post">
        <p>
          <label>Brukernavn</label><br>
          <input type="text" id="bruker" name="bruker"/>
        </p>

        <p>
          <label>Passord</label><br>
          <input type="password" id="passord" name="passord"/>
        </p>

        <p>
          <input type="submit" id="btn" value="Logg inn"/>
        </p>
      </form>

      <button type="button" name="button">logg inn som gjest</button>
      <p><button type="button" name="Registrerl">Registrer Lærer</button>
      <button type="button" name="Registrers">Registrer Student</button></p>
  </body>
</html>
