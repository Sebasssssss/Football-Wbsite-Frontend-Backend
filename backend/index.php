<?php

session_start();

@session_start();

if (isset($_SESSION['usuario']) && $_SESSION['usuario'] != "") {
} else {
	header("Location:login.php");
}

function pintarNavbar($pintar)
{
	$miRuta = isset($_GET['r']) ? $_GET['r'] : "";
	$retorno = "";
	if ($pintar == $miRuta) {
		$retorno = "active";
	}
	return $retorno;
}

?>





<!DOCTYPE html>
<html>

<head>
	<title>Manchester United</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;1,100;1,200&family=Roboto:wght@300&display=swap">
</head>

<body>
	<style>
		body {
			display: flex;
			min-height: 100vh;
			flex-direction: column;
			background-color: #520C0C;
			font-family: 'Montserrat', sans-serif;
		}

		main {
			flex: 1 0 auto;
		}

		.textoInicio {
			width: 100%;
			position: absolute;
			top: 35%;
			transform: translateY(-50%);
			text-align: center;
			color: #fff;
			display: block;
			margin: auto;
		}
	</style>

	</style>

	<nav class="grey lighten-2">
		<div class="nav-wrapper">
			<a href="#!" class="brand-logo center black-text">MAN UTD</a>
			<ul class="right hide-on-med-and-down">
				<li class="<?= pintarNavbar("noticias") ?>"><a class="black-text" href="index.php?r=noticias">Noticias</a></li>
				<li class="<?= pintarNavbar("categorias") ?>"><a class="black-text" href="index.php?r=categorias">Categorias</a></li>
				<li class="<?= pintarNavbar("jugadores") ?>"><a class="black-text" href="index.php?r=jugadores">Jugadores</a></li>
				<li class="<?= pintarNavbar("contacto") ?>"><a class="black-text" href="index.php?r=contacto">Contacto</a></li>
				<li class="<?= pintarNavbar("administradores") ?>"><a class="black-text" href="index.php?r=administradores">Admins</a></li>
			</ul>

			<!-- AL INICIAR SESION MUESTRA EL BOTON PARA SALIR SESION -->

			<?php
			if (isset($_SESSION['usuario'])) {
				echo "<a href='logout.php' class='btn waves-effect waves-light red darken-4 modal-trigger black-text'></i>Salir Sesion</a>";
			}
			?>
		</div>
	</nav>
	<main>
		<div>
			<?php include("router.php"); ?>
		</div>
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

	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	<script>
		function ocultar() {
			document.getElementById('mensaje').style.display = "none";
		}
	</script>
</body>

</html>