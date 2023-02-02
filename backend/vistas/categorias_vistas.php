<?php

require_once("modelos/categoriaNoticias_modelo.php");


$objCategoriaNoticias = new categoriaNoticias_modelo();

$rutaPagina = "categorias";


if (isset($_POST['accion']) && $_POST['accion'] == "agregarCategoria") {

	$datos = array();
	$datos['nombre']	= isset($_POST['txtNombre']) ? $_POST['txtNombre'] : "";
	$datos['codigo']	= "";

	$objCategoriaNoticias->constructor($datos);
	$respuesta = $objCategoriaNoticias->agregarCategoriaNoticia();
}

if (isset($_POST["accion"]) && $_POST['accion'] == "borrar" && isset($_POST["codigo"]) && $_POST['codigo'] != "") {

	$codigo = $_POST['codigo'];
	$objCategoriaNoticias->cargar($codigo);
	$respuesta = $objCategoriaNoticias->borrar();
}


if (isset($_POST["accion"]) && $_POST['accion'] == "editar") {


	$datos = array();
	$datos['nombre']	= isset($_POST['txtNombre']) ? $_POST['txtNombre'] : "";
	$datos['codigo']	= isset($_POST['txtCodigo']) ? $_POST['txtCodigo'] : "";

	$objCategoriaNoticias->constructor($datos);
	$respuesta = $objCategoriaNoticias->editar();
}

$buscar = isset($_POST['buscador']) ? $_POST['buscador'] : "";
if ($buscar == "" && isset($_GET['buscador']) && ($_GET['buscador']) != "") {
	$buscar = $_GET['buscador'];
}

$arrayFiltros = array("buscar" => $buscar);
$totalMaximo = $objCategoriaNoticias->totalPaginas();
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
$categoriaNoticiasSelect = $objCategoriaNoticias->listar($arrayFiltros);

?>
<html>

<head>
	<title>Manchester United</title>
	<meta name="viewport" content="with-device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;1,100;1,200&family=Roboto:wght@300&display=swap">
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

		.trasnparencia {
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




		<!-- CARTELES DE ERROR O EXITO -->
		<?PHP
		if (isset($respuesta['codigo']) && $respuesta['codigo'] == "Error") {
		?>
			<div id="mensaje" class="cartelError white-text center-align" onclick="ocultar()">
				<h3><i class="material-icons">error</i><?= $respuesta['codigo'] ?></h3>
				<h6><?= $respuesta['mensaje'] ?></h6>
			</div>
		<?PHP
		}
		?>
		<?PHP
		if (isset($respuesta['codigo']) && $respuesta['codigo'] == "Exito") {
		?>
			<div id="mensaje" class="cartelExito white-text center-align" onclick="ocultar()">
				<h3><i class="material-icons">check</i><?= $respuesta['codigo'] ?>!</h3>
				<h6><?= $respuesta['mensaje'] ?></h6>
			</div>
		<?PHP
		}
		?>


		<h3 class="center white-text">Categorias Noticias</h3>
		<div class="botonReiniciar">
			<a href="index.php?r=categorias" class="right"><i class="material-icons white-text">restore</i></a>
		</div>
		<div class="left"> <!-- AGREGAR UNA CATEGORIA DE NOTICIA -->
			<a href="#modalAgregarCategoriaNoticia" class="waves-effect waves-light btn yellow darken-3 modal-trigger"><i class="material-icons left">group_add</i>Agregar</a>
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


		<!-- TABLA DE NOTICICAS -->
		<table class="white-text centered">
			<thead>
				<tr>
					<th>nombre</th>
					<th>Codigo</th>
					<th>Botones</th>
				</tr>
			</thead>

			<tbody>

				<?php
				foreach ($categoriaNoticiasSelect as $categorias) {
				?>
					<tr>
						<td><?= $categorias['nombre'] ?></td>
						<td><?= $categorias['codigo'] ?></td>
						<td>
							<div>
								<a href="index.php?r=<?= $rutaPagina ?>&accion=editar&categorias=<?= $categorias['codigo'] ?>" class="waves-effect waves-light modal-trigger btn yellow darken-3">
									<i class="material-icons left">edit</i>
								</a>
								<a href="index.php?r=<?= $rutaPagina ?>&accion=borrar&categorias=<?= $categorias['codigo'] ?>" class="waves-effect waves-light btn red accent-4">
									<i class="material-icons left">delete</i>
								</a>
							</div>
						</td>
					</tr>

					<!-- PAGINADOR -->
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




		<!-- BORRAR CATEGORIA NOTICIA -->
		<?PHP
		if (isset($_GET['accion']) && $_GET['accion'] == "borrar" && isset($_GET['categorias']) && $_GET['categorias'] != "") {
		?>
			<div class="borrarJugador center-align white-text">
				<form action="index.php?r=<?= $rutaPagina ?>" method="POST" class="col s12">
					<h3>Eliminar Categoria Noticia</h3>
					<h4>Desea borrar la categoria <?= $_GET['categorias'] ?>?</h4>
					<input type="hidden" name="codigo" value="<?= $_GET['categorias'] ?>">
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


		<!-- EDITAR CATEGORIA NOTICIA -->
		<?PHP
		if (isset($_GET['accion']) && $_GET['accion'] == "editar" && isset($_GET['categorias']) && $_GET['categorias'] != "") {
			$objCategoriaNoticias->cargar($_GET['categorias']);
		?>

			<div class="center-align white-text editarNoticia container">
				<h3>Editar Noticia</h3>
				<form action="index.php?r=<?= $rutaPagina ?>" method="POST" class="col s12">
					<div class="row">
						<div class="input-field col s12">
							<input id="nombre" type="text" placeholder="Nombre" class="validate white-text" name="txtNombre" value="<?= $objCategoriaNoticias->obtenerNombre() ?>">
						</div>
						<div class="input-field col s12">
							<input id="codigo" type="hidden" name="txtCodigo" value="<?= $objCategoriaNoticias->obtenerCodigo() ?>">
						</div>
						<button class="btn waves-effect waves-light red darken-4" type="submit" name="accion" value="editar">Enviar
							<i class="material-icons right">send</i>
						</button>
						<button class="btn waves-effect waves-light yellow darken-3" type="submit" name="" value="cancelar">Cancelar
							<i class="material-icons right">cancel</i>
						</button>
				</form>
			</div>
		<?php
		}
		?>


		<!-- MODAL AGREGAR CATEGORIA NOTICIA -->
		<div id="modalAgregarCategoriaNoticia" class="modal">
			<div class="modal-content">
				<h4 class="center">Agregar Categoria Noticia</h4>
				<br>
				<div class="row">
					<form action="index.php?r=<?= $rutaPagina ?>" method="POST" class="col s12">
						<div class="row">
							<div class="input-field col s12">
								<input id="nombre" type="text" class="validate" name="txtNombre">
								<label for="nombre">Nombre</label>
							</div>
							<button class="btn red darken-4 waves-effect waves-light" type="submit" name="accion" value="agregarCategoria">Enviar
								<i class="material-icons right">send</i>
							</button>
					</form>
				</div>
			</div>
		</div>
	</main>


	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			M.AutoInit();
		});

		function ocultar() {
			document.getElementById('mensaje').style.display = "none";
		}
	</script>
</body>

</html>