<?php

require_once("modelos/modelo_contacto.php");
$rutaPagina = "contacto";
$objContacto = new contacto_modelo();


if (isset($_POST['accion']) && $_POST['accion'] == "contactanos") {

	$datos = array();
	$datos['nombre'] 	= isset($_POST['contactoNombre']) ? $_POST['contactoNombre'] : "";
	$datos['email'] 	= isset($_POST['contactoEmail']) ? $_POST['contactoEmail'] : "";
	$datos['tema'] 		= isset($_POST['contactoTema']) ? $_POST['contactoTema'] : "";
	$datos['mensaje'] 	= isset($_POST['contactoMensaje']) ? $_POST['contactoMensaje'] : "";

	$objContacto->constructor($datos);
	$respuesta = $objContacto->enviarMensaje();
}


?>

<html>

<head>
	<title>Manchester United</title>
	<link rel="stylesheet" href="frontend/css/styles.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;1,100;1,200&family=Roboto:wght@300&display=swap" rel="stylesheet">
</head>

<body class="bodyContacto2">
	<style>
		body {
			display: flex;
			min-height: 100vh;
			flex-direction: column;
		}

		main {
			flex: 1 0 auto;
		}
	</style>
	<main>
		<section id="sectionContacto" style="background-image: url(css/imagenes/background2.jpg);background-attachment: fixed;">

			<!-- FORMULARIO PARA CONTACTAR -->
			<div class="conteiner center formulario">
				<img src="css/imagenes/logo.png" style="width: 200px;">
				<br>
				<div class="row">
					<form action="index.php?r=<?= $rutaPagina ?>" enctype="multipart/form-data" method="POST" class="col s12">
						<div class="row">
							<div class="input-field col s4">
								<input type="text" name="contactoNombre" class="white-text" required>
								<label for="nombre">Nombre</label>
							</div>
							<div class="input-field col s4">
								<input type="email" name="contactoEmail" class="white-text" required>
								<label for="email">Email</label>
							</div>
							<div class="input-field col s4">
								<input type="text" name="contactoTema" class="white-text" required>
								<label for="Tema">Tema</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<textarea id="textarea1" class="materialize-textarea" cols="30" rows="10" placeholder="Su mensaje" name="contactoMensaje" required></textarea>
								<label for="mensaje">Mensaje</label>
							</div>
						</div>
						<button type="sumbit" name="accion" value="contactanos" class="btn waves-effecct waves-light red accent-4">Enviar</button>
					</form>
				</div>
			</div>
		</section>
	</main>

	<!-- FOOTER -->

	<footer class="page-footer black">
		<div class="container">
			<div class="row">
				<div class="col l6 s12">
					<h5 class="white-text">Manchester United</h5>
					<p class="grey-text text-lighten-4">Visita nuestras redes sociales para estar mas al tanto de lo que publicamos.</p>
				</div>
				<div class="col l4 offset-l2 s12">
					<h5 class="white-text">Links</h5>
					<ul>
						<li><a class="grey-text text-lighten-3" href="https://twitter.com/ManUtd"><i class="fa-brands fa-twitter"></i> Twitter</a></li>
						<li><a class="grey-text text-lighten-3" href="https://www.instagram.com/manchesterunited/"><i class="fa-brands fa-instagram"></i> Instagram</a></li>
						<li><a class="grey-text text-lighten-3" href="https://www.facebook.com/manchesterunited/"><i class="fa-brands fa-facebook-f"></i> Facebook</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="footer-copyright">
			<div class="container">
				© 2014 Copyright Sebass
				<a class="grey-text text-lighten-4 right" href="https://www.manutd.com/es">Oficial</a>
			</div>
		</div>
	</footer>

</body>

</html>