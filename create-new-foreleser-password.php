<?php
	include_once 'header.php';
?>

<div class="login">
	
	<?php
		$selector = $_GET["selector"];
		$validator = $_GET["validator"];
		
		if (empty($selector) || empty($validator)) {
			echo 'Kan ikke validere forspørsel!';
		} else {
			if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
				?>
				<form action="includes/reset_passord_foreleser.php" method="POST" class="login_form">
				<input type="hidden" name="selector" value="<?php echo $selector; ?>">
				<input type="hidden" name="validator" value="<?php echo $validator; ?>">
				<input type="password" name="pwd" placeholder="Passord">
				<input type="password" name="pwd-repeat" placeholder="Gjenta Passord">
				<button type="submit" name="reset-password-submit">Reset passord</button>
				</form>
				<?php
			}
		} 
	?>
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
