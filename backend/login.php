<?php
require_once("modelos/administradores_modelo.php");
@session_start();

$nombre = isset($_POST['txtNombre']) ? $_POST['txtNombre'] : "";
$clave = isset($_POST['txtClave']) ? $_POST['txtClave'] : "";

if ($nombre != "" && $clave != "") {
	$objAdministradores = new administradores_modelo();
	$respuesta = $objAdministradores->login($nombre, $clave);

	if ($respuesta) {
		$_SESSION['usuario'] = $nombre;
		header("Location:index.php");
	} else {
		unset($_SESSION['usuario']);
		session_destroy();
	}
} else {
	unset($_SESSION['usuario']);
	session_destroy();
}

?>


<!DOCTYPE html>
<html>

<head>
	<meta name="viewport" content="with-device-width, initial-scale=1.0">
	<link rel="stylesheet" href="frontend/css/styles.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<title>Manchester United</title>
</head>

<body class="red darken-4">
	<style>
		body {
			display: flex;
			min-height: 100vh;
			flex-direction: column;
			background-image: linear-gradient(rgba(0, 0, 0, 0.55), rgba(0, 0, 0, 0.55));
		}

		main {
			flex: 1 0 auto;
		}

		.form-box {
			width: 380px;
			height: 500px;
			position: relative;
			margin: 6% auto;
			background: rgba(0, 0, 0, 0.3);
			box-shadow: 0 8px 32px 0 rgba(27, 27, 27, 0.37);
			backdrop-filter: blur(5px);
			-webkit-backdrop-filter: blur(5px);
			border-radius: 10px;
			overflow: hidden;
		}

		.input-group {
			top: 160px;
			position: absolute;
			width: 280px;
			background: transparent;
			margin-left: 40px;
		}


		.sumbit-btn {
			width: 85%;
			padding: 10px 30px;
			display: block;
			margin-top: 16px;
			margin-left: 16px;
			background-color: #aa0000;
			border: 0;
			outline: none;
			border-radius: 5px;
			color: #fff;
			box-shadow: 1px 6px 25px 11px rgba(0, 0, 0, 0.75) inset;
			-webkit-box-shadow: 1px 6px 25px 11px rgba(0, 0, 0, 0.75) inset;
			-moz-box-shadow: 1px 6px 25px 11px rgba(0, 0, 0, 0.75) inset;
		}
	</style>


	<!-- FORMULARIO PARA INCIAR SESION -->


	<main>
		<section class="sub-header">
			<nav class="grey lighten-2">
				<div class="nav-wrapper">
					<a href="#!" class="brand-logo center black-text">MAN UTD</a>
					<ul class="right hide-on-med-and-down">
						<li><a class="black-text" href="index.php?r=noticias">Noticias</a></li>
						<li><a class="black-text" href="index.php?r=jugadores">Jugadores</a></li>
						<li><a class="black-text" href="index.php?r=contacto">Contacto</a></li>
					</ul>
				</div>
			</nav>
			<div class="hero">
				<div class="form-box">
					<h2 class="white-text center">Iniciar Sesion</h2>
					<form id="iniSesion" class="input-group" action="login.php?" method="POST">
						<div class="row">
							<div class="input-field white-text">
								<i class="material-icons prefix">account_circle</i>
								<input placeholder="nombre" id="nombre" type="text" class="validate white-text" name="txtNombre">
							</div>
						</div>
						<div class="row">
							<div class="input-field">
								<i class="material-icons prefix white-text">lock</i>
								<input placeholder="Contrasenha" id="clave" type="password" class="validate white-text" name="txtClave">
							</div>
						</div>
						<button type="submit" class="sumbit-btn">Iniciar sesion</button>
					</form>
				</div>
			</div>
		</section>
	</main>




	<!-- FOOTER -->

	<footer class="page-footer grey lighten-2 black-text">
		<div class="container">
			<div class="row">
				<div class="col l6 s12">
					<h5 class="">Manchester United</h5>
					<p class="black-text">Visita nuestras redes sociales para estar mas al tanto de lo que publicamos.</p>
				</div>
				<div class="col l4 offset-l2 s12">
					<h5 class="">Links</h5>
					<ul>
						<li><a class="grey-text black-text" href="https://twitter.com/ManUtd"><i class="fa-brands fa-twitter black-text"></i> Twitter</a></li>
						<li><a class="grey-text black-text" href="https://www.instagram.com/manchesterunited/"><i class="fa-brands fa-instagram black-text"></i> Instagram</a></li>
						<li><a class="grey-text black-text" href="https://www.facebook.com/manchesterunited/"><i class="fa-brands fa-facebook-f black-text"></i> Facebook</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="footer-copyright">
			<div class="container black-text">
				© 2014 Copyright Sebass
				<a class="black-text right" href="https://www.manutd.com/es">Oficial</a>
			</div>
		</div>
	</footer>
</body>

</html>