<?php

require_once("modelos/noticias_modelo.php");
require_once("modelos/categoriaNoticias_modelo.php");

$objNoticias = new noticias_modelo();

$objCategoriaNoticias = new categoriaNoticias_modelo();

$rutaPagina = "noticias";

@session_start();

if (isset($_SESSION['usuario']) && $_SESSION['usuario'] != "") {
} else {
	header("Location:login.php");
}


$noticiasPrincipales = $objNoticias->listarNoticias();
$NotisCostado = $objNoticias->masNoticasCostado();


?>
<html>

<head>
	<title>Manchester United</title>
	<meta name="viewport" content="with-device-width, initial-scale=1.0">
	<link rel="stylesheet" href="frontend/css/styles.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;1,100;1,200&family=Roboto:wght@300&display=swap">
</head>

<body style="background-image: linear-gradient(rgba(0,0,0,0.55),rgba(0,0,0,0.55)),url(css/imagenes/fondoNoticias5.jpg);">


	<!-- PARALLAX SUPERIOR -->

	<div class="parallax-container">
		<div class="parallax"><img src="css/imagenes/aver.jpg"></div>
		<h1 class="center white-text tituloNoticias">Noticias</h1>
	</div>



	<br>
	<div class="cuerpoNoticias">
		<div class="contenidoNoticias">

			<!-- LAS NOTICIAS QUE SE MUESTRAN EN PRIMER PLANO AL ENTRAR -->

			<?php
			foreach ($noticiasPrincipales as $noticias) {
			?>

				<h1><?= $noticias['titulo'] ?></h1>
				<p> <?= $noticias['descripcion1'] ?></p>
				<h6 class="right"><?= $noticias['fechaPublicacion'] ?></h6>
				<img src="http://localhost/Sebastián_Rodriguez_cur2140_EntregaFinal/backend/archivos/imagenes/<?= $noticias['imagen'] ?>" class="imagenesNoticias">
				<p><?= $noticias['descripcion2'] ?></p>
				<br>

			<?php
			}
			?>
		</div>

		<!-- NOTICIAS QUE SE CARGAN EN EL COSTADO DE LA PAGINA PARA NO SATURARLA -->

		<div class="fondoCategorias">
			<div class="center">
			</div>
			<h2 class="white-text center">Mas noticias</h2>

			<?php
			foreach ($NotisCostado as $costado) {
			?>

				<div class="noticiasLado">
					<img src="http://localhost/Sebastián_Rodriguez_cur2140_EntregaFinal/proyecto/probando/backend/archivos/imagenes/<?= $costado['imagen'] ?>">
					<a class="modal-trigger" href="#modal_<?= $costado['id'] ?>">
						<h6 class="white-text"><?= $costado['titulo'] ?></h6>
						<p class="white-text"><?= $costado['nombre'] ?></p>
					</a>
				</div>
			<?php
			}
			?>
		</div>
	</div>


	<!-- MODALS DE LAS NOTICIAS DEL COSTADO -->


	<?php
	foreach ($NotisCostado as $costado) {
	?>
		<div id="modal_<?= $costado['id'] ?>" class="modal grey darken-4">
			<div class="modal-content white-text">
				<h1 class="center"><?= $costado['titulo'] ?></h1>
				<div class="center">
					<h6><?= $costado['fechaPublicacion'] ?></h6>
					<div class="conteiner">
						<img src="http://localhost/Sebastián_Rodriguez_cur2140_EntregaFinal/proyecto/probando/backend/archivos/imagenes/<?= $costado['imagen'] ?>" style="width: 100%;">
					</div>
				</div>
				<div class="noticiasFichajes">
					<p><?= $costado['descripcion1'] ?></p>
					<br>
					<p><?= $costado['descripcion2'] ?></p>
				</div>
			</div>
		</div>

	<?php
	}
	?>

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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			M.AutoInit();
		});
	</script>
</body>

</html>