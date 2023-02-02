<?php

session_start();

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
				<li><a href="index.php?r=jugadores">Jugadores</a></li>
				<li><a href="index.php?r=contacto">Contacto</a></li>
				<li><a href="index.php?r=noticias">Noticias</a></li>
			</ul>
			<img src="css/imagenes/logo.png" class="logo-navbar">

			<!-- AL INICIAR SESION MUESTRA EL BOTON PARA SALIR SESION -->
			<?php
			if (isset($_SESSION['usuario'])) {
				echo "<a href='logout.php' class='btn red accent-4 waves-effect waves-light modal-trigger'><i class='fa-solid fa-user-astronaut left botonIniciarSesion'></i>Salir Sesion</a>";
			}
			?>
		</div>
	</div>
	<main>
		<div>
			<?php include("router.php"); ?>
		</div>
	</main>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>