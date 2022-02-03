<?php
	include_once 'header.php';
?>

<div class="login">
	<form action="includes/reset_request_foreleser.php" method="POST" class="login_form">
	<input type="text" name="email" placeholder="email">
	<button type="submit" name="reset-request-submit">Resett Passord</button>
	</form>
	
	<?php
		if(isset($_GET["reset"])) {
			if ($_GET["reset"] == "success") {
				echo '<p>Skjekk mailen din!</p>';
			}
		}
		if(isset($_GET["error"])) {
			if ($_GET["error"] == "emailNotExits") {
				echo '<p>Den mailen brukes ikke!</p>';
			}
		}
	?>
	
	<a href="index.php">Tilbake</a>
</div>

</main>
</body>
</html>

<style>
.login {
	 display: flex;
	 flex-direction: column;
	 align-items: center
}
.login_form {
	 display: flex;
	 flex-direction: column;
}
</style>
