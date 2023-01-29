<?php
session_start();

if(isset($_SESSION['usuario'])){
	session_destroy();
}




?>

<!DOCTYPE html>
<html>
	<head>
		<title>Manchester United</title>
		<link rel="stylesheet" href="css/styles.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> 
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;1,100;1,200&family=Roboto:wght@300&display=swap">
	</head>
	<body class="bodyInicio">
								<div class="NavbarFondo">
									<div class="navbarInicio">
										<ul>
											<li><a href="index.php?r=inicio">Inicio</a></li>
											<li><a href="index.php?r=noticias">Noticias</a></li>
											<li><a href="index.php?r=jugadores">Jugadores</a></li>
											<li><a href="index.php?r=contacto">Contacto</a></li>
										</ul>
										<img src="css/imagenes/logo.png" class="logo-navbar">
									</div>
								</div>
							<main>								
							<div class="Fondo-Inicio">
								<div class="textoInicio">
									<h1>Manchester United</h1>
									<p>Bienvenido a la pagina de Manchester United</p>
								</div>
							</div>
							</main>
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	</body>
</html>
