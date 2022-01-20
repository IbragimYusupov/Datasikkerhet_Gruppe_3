<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/stilark.css">
    <title>login</title>
  </head>
  <body>
    <h1>dette er en loginside</h1>
      <from action="process.php" method="POST">
        <p>
          <label>Brukernavn</label><br>
          <input type="text" id="bruker" ="bruker"/>
        </p>
        <p>
          <label>Passord</label><br>
          <input type="password" id="pass" ="pass"/>
        </p>
        <p>
          <input type="submit" id="btn" value="Logg inn">
        </p>
      </form>
      <button type="button" name="button">logg inn som gjest</button>
      <p><button type="button" name="Registrerl">Registrer Lærer</button>
      <button type="button" name="Registrers">Registrer Student</button></p>
  </body>
</html>
