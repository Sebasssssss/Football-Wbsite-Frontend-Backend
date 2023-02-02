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
	<link rel="stylesheet" href="frontend/css/styles.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;1,100;1,200&family=Roboto:wght@300&display=swap" rel="stylesheet">
</head>

<body class="bodyContacto" style="overflow: hidden;">
	<section id="sectionContacto" class="contact">

		<!-- IMAGEN LOGO PARA MAS ESTILO A LA PAGINA -->

		<div class="contact-img">
			<img src="css/imagenes/logo.png">
		</div>


		<!-- FORMULARIO PARA CONTACTAR -->

		<div class="contact-form">
			<h1>Contactanos</h1>
			<p>Para estar en contacto con nosotros por favor asegurese de llenar los siguientes formularios con su mensaje correspondiente.</p>
			<form action="index.php?r=<?= $rutaPagina ?>" method="POST">
				<input type="text" placeholder="Nombre" name="contactoNombre" required>
				<input type="email" placeholder="Email" name="contactoEmail" required>
				<input type="" placeholder="Tema" name="contactoTema" required>
				<textarea id="" cols="30" rows="10" placeholder="Su mensaje" name="contactoMensaje" required></textarea>
				<input type="submit" name="accion" value="contactanos" class="btn-Contacto red accent-4">
			</form>
		</div>
	</section>

</body>

</html>