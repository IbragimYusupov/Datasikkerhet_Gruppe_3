<!DOCTYPE html>	
	<html lang="nb">
	
		<!-- Information about the page -->
		<head>
			<title lang="nb">Steg 1</title>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<meta name="description" content="Meldingstjeneste for tilbakemeldinger på emner">
			<meta name="keywords" content="Tilbake melding, emne">
			
			<link rel="stylesheet" media="screen" href="" />
		</head>
		
		<!-- The visible content of the page -->
		<body>
		
			<!-- header content -->
			<header>
				<h1>Steg 1</h1>
			</header>
			
			<!-- navigation -->
			<nav>
				<ul>
					<li><a href=".html">Hjem</a></li>
				</ul>
			</nav>
			
			<!-- main body -->
			<main>
				<section>
					<h2>Emne navn</h2>
					<!--xx needs to be changed-->
					<form action="student_feedback.php" method="POST">
						<label for="message-box" name="emne-tilbakemelding">Send melding</label><br>
						<textarea id="message-box" name="message-box" rows="5" cols="50" 
						placeholder="Skriv din tilbakemelding her" maxlength="500"></textarea>
						<input type = "submit" value = "submit" />
					</form>
				</section>
			</main>
			
			<!-- footer content-->
			<footer>
				<section>
				<!--Gruppe informasjon?-->
				</section>
			</footer>
		</body>
	</html>
	