<?php

require_once("modelos/contacto_modelo.php");
$rutaPagina = "contacto";
$objContacto = new contacto_modelo();


if (isset($_POST["accion"]) && $_POST['accion'] == "borrar" && isset($_POST["id"]) && $_POST['id'] != "") {

	$id = $_POST['id'];
	$objContacto->cargar($id);
	$respuesta = $objContacto->borrar();
}


$buscar = isset($_POST['buscador']) ? $_POST['buscador'] : "";
if ($buscar == "" && isset($_GET['buscador']) && ($_GET['buscador']) != "") {
	$buscar = $_GET['buscador'];
}

$arrayFiltros = array("buscar" => $buscar);
$totalMaximo = $objContacto->totalPaginas();
if (isset($_GET['pagina']) && $_GET['pagina'] != "") {
	$pagina = (int)$_GET['pagina'];

	if ($pagina < 1) {
		$pagina = 1;
	} elseif ($pagina > $totalMaximo) {
		$pagina = $totalMaximo;
	} elseif (!is_int($pagina)) {
	}

	$paginaAnterior = $pagina - 1;
	if ($paginaAnterior < 1) {
		$paginaAnterior = 1;
	}

	$paginaSiguiente = $pagina + 1;
	if ($paginaSiguiente > $totalMaximo) {
		$paginaSiguiente = $totalMaximo;
	}
} else {
	$pagina 			= 1;
	$paginaAnterior	 	= 1;
	$paginaSiguiente	= 2;
}


$arrayFiltros['pagina'] = $pagina - 1;
$mensajeContacto = $objContacto->listar($arrayFiltros);



?>

<html>

<head>
	<title>Manchester United</title>
	<link rel="stylesheet" href="C:/laragon/www/proyecto/probando/frontend/css/styles.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;1,100;1,200&family=Roboto:wght@300&display=swap" rel="stylesheet">
</head>

<body>
	<style>
		.cartelError {
			background-color: red;
			height: 110px;
			width: 650px;
			margin-left: 35%;
			border-radius: 10px;
			font-family: 'Montserrat', sans-serif;
		}

		.cartelError h3 {
			padding: 5px;
		}

		.cartelExito {
			background-color: green;
			height: 110px;
			width: 650px;
			margin-left: 35%;
			border-radius: 10px;
			font-family: 'Montserrat', sans-serif;
		}

		.cartelExito h3 {
			padding: 5px;
		}

		.BuscarJugador {
			width: 30%;
			margin-left: 71vh;
			background: rgba(0, 0, 0, 0.3);
			box-shadow: 0 8px 32px 0 rgba(27, 27, 27, 0.37);
			backdrop-filter: blur(7px);
			-webkit-backdrop-filter: blur(7px);
		}

		.botonReiniciar {
			margin-right: 33%;
		}
	</style>

	<main>
		<section>
			<h3 class="center white-text">Contacto</h3>
			<div class="botonReiniciar">
				<a href="index.php?r=<?= $rutaPagina ?>" class="right"><i class="material-icons white-text">restore</i></a>
			</div>
			<nav style="width: 30%; margin-left: 35%;" class="BuscarJugador"> <!-- BUSCADOR -->
				<div class="nav-wrapper">
					<form action="index.php?r=<?= $rutaPagina ?>" method="POST">
						<div class="input-field">
							<input id="search" type="search" name="buscador" required>
							<label class="label-icon" for="search"><i class="material-icons">search</i></label>
							<i class="material-icons">close</i>
						</div>
					</form>
				</div>
			</nav>


			<!-- TABLA DE MENSAJES DE CONTACTO -->

			<table class="white-text centered">


				<!-- CARTELES DE ERROR O EXITO -->
				<?PHP
				if (isset($respuesta['codigo']) && $respuesta['codigo'] == "Error") {
				?>
					<div id="mensaje" class="cartelError center-align white-text" onclick="ocultar()">
						<h3><i class="material-icons">error</i><?= $respuesta['codigo'] ?></h3>
						<h6><?= $respuesta['mensaje'] ?></h6>
					</div>
				<?PHP
				}
				?>
				<?PHP
				if (isset($respuesta['codigo']) && $respuesta['codigo'] == "Exito") {
				?>
					<div id="mensaje" class="cartelExito center-align white-text" onclick="ocultar()">
						<h3><i class="material-icons">check</i><?= $respuesta['codigo'] ?>!</h3>
						<h6><?= $respuesta['mensaje'] ?></h6>
					</div>
				<?PHP
				}
				?>

				<thead>
					<tr>
						<th>Nombre</th>
						<th>email</th>
						<th>tema</th>
						<th>mensaje</th>
						<th>Botones</th>
					</tr>
				</thead>

				<tbody>

					<?php
					foreach ($mensajeContacto as $contacto) {
					?>
						<tr>
							<td><?= $contacto['nombre'] ?></td>
							<td><?= $contacto['email'] ?></td>
							<td><?= $contacto['tema'] ?></td>
							<td><?= $contacto['mensaje'] ?></td>
							<td>
								<div>
									<a href="index.php?r=<?= $rutaPagina ?>&accion=borrar&contacto=<?= $contacto['id'] ?>" class="waves-effect waves-light btn red accent-4">
										<i class="material-icons left">delete</i>
									</a>
								</div>
							</td>
						</tr>

					<?php
					}
					?>
					<tr>
						<td colspan="8">
							<ul class="pagination conteiner center">
								<li class="waves-effect"><a href="index.php?r=<?= $rutaPagina ?>&pagina=<?= $paginaAnterior ?>&buscador=<?= $buscar ?>" class=""><i class="material-icons white-text">chevron_left</i></a></li>
								<?php
								for ($i = 1; $i <= $totalMaximo; $i++) {
									$class = "waves-effect";
									if ($i == $pagina) {
										$class = "active yellow darken-3";
									}
								?>
									<li class="<?= $class ?>">
										<a href="index.php?r=<?= $rutaPagina ?>&pagina=<?= $i ?>&buscador=<?= $buscar ?>" class="white-text waves-effect"><?= $i ?></a>
									</li>
								<?php
								}
								?>


								<li class="waves-effect"><a href="index.php?r=<?= $rutaPagina ?>&pagina=<?= $paginaSiguiente ?>&buscador=<?= $buscar ?>" class=""><i class="material-icons white-text">chevron_right</i></a></li>
							</ul>
						</td>
					</tr>
				</tbody>
			</table>



			<!-- BORRAR MENSAJE -->
			<?PHP
			if (isset($_GET['accion']) && $_GET['accion'] == "borrar" && isset($_GET['contacto']) && $_GET['contacto'] != "") {
			?>
				<div class="borrarJugador center-align white-text">
					<form action="index.php?r=<?= $rutaPagina ?>" method="POST" class="col s12">
						<h3>Borrar Mensaje</h3>
						<h4>Desea borrar el mensaje de <?= $_GET['contacto'] ?>?</h4>
						<input type="hidden" name="id" value="<?= $_GET['contacto'] ?>">
						<button class="btn waves-effect waves-light red darken-4" type="submit" name="accion" value="borrar">Eliminar
							<i class="material-icons right">deleted</i>
						</button>
						<button class="btn waves-effect waves-light yellow darken-3" type="submit" name="" value="cancelar">Cancelar
							<i class="material-icons right">cancel</i>
						</button>
					</form>
				</div>
			<?php
			}
			?>

		</section>
	</main>
	<script>
		function ocultar() {
			document.getElementById('mensaje').style.display = "none";
		}
	</script>
</body>

</html>