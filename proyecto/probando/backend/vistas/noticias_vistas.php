<?php

require_once("modelos/noticias_modelo.php");
require_once("modelos/categoriaNoticias_modelo.php");

$objNoticias = new noticias_modelo();

$objCategoriaNoticias = new categoriaNoticias_modelo();

$rutaPagina = "noticias";


	if(isset($_POST['accion']) && $_POST['accion'] == "agregarUnaNoticia"){

		$archivo = $objNoticias->subirImagen($_FILES['imagen'], "620", "1102");
		if($archivo){

			$datos = array();
			$datos['titulo']			= isset($_POST['txtTitulo'])?$_POST['txtTitulo']:"";
			$datos['fechaPublicacion']	= isset($_POST['txtFechaPublicacion'])?$_POST['txtFechaPublicacion']:"";
			$datos['categoriaNoticia']	= isset($_POST['selectCategoria'])?$_POST['selectCategoria']:"";
			$datos['descripcion1']		= isset($_POST['txtDescripcion1'])?$_POST['txtDescripcion1']:"";
			$datos['descripcion2']		= isset($_POST['txtDescripcion2'])?$_POST['txtDescripcion2']:"";
			$datos['imagen']			= $archivo;

			$objNoticias->constructor($datos);
			$respuesta = $objNoticias->agregarNoticia();

		}else{
			$arrayRespuesta = array();
			$arrayRespuesta['codigo'] = "Error";
			$arrayRespuesta['mensaje'] = "Error al subir la imagen";
		}
}

	if(isset($_POST["accion"]) && $_POST['accion'] == "borrar" && isset($_POST["id"]) && $_POST['id'] != ""){

		$id = $_POST['id'];
		$objNoticias->cargar($id);
		$respuesta = $objNoticias->borrar();

	}
	

	if(isset($_POST["accion"]) && $_POST['accion'] == "editar" ){
			

		$datos = array();
			$datos['titulo']			= isset($_POST['txtTitulo'])?$_POST['txtTitulo']:"";
			$datos['fechaPublicacion']	= isset($_POST['txtFechaPublicacion'])?$_POST['txtFechaPublicacion']:"";
			$datos['categoriaNoticia']	= isset($_POST['selectCategoria'])?$_POST['selectCategoria']:"";
			$datos['descripcion1']		= isset($_POST['txtDescripcion1'])?$_POST['txtDescripcion1']:"";
			$datos['descripcion2']		= isset($_POST['txtDescripcion2'])?$_POST['txtDescripcion2']:"";
			$datos['id']		= isset($_POST['txtId'])?$_POST['txtId']:"";


		$archivo = $objNoticias->subirImagen($_FILES['imagen'], "620", "1102");
		if($archivo){
			
			$datos['imagen'] 	= $archivo;
			
		}else{

			$datos['imagen'] 	= "";

		}
		$objNoticias->constructor($datos);
		$respuesta = $objNoticias->editar();

	}
	
	$buscar = isset($_POST['buscador'])?$_POST['buscador']:"";
	if($buscar == "" && isset($_GET['buscador']) && ($_GET['buscador']) != ""){
		$buscar = $_GET['buscador'];
	}

	$arrayFiltros = array("buscar"=>$buscar);
	$totalMaximo = $objNoticias->totalPaginas();
	if(isset($_GET['pagina']) && $_GET['pagina'] !=""){
		$pagina = (int)$_GET['pagina'];

		if($pagina < 1){
			$pagina = 1;
		}elseif($pagina > $totalMaximo){
			$pagina = $totalMaximo;
		}elseif(!is_int($pagina)){

		}

		$paginaAnterior = $pagina - 1;
		if($paginaAnterior < 1){
			$paginaAnterior = 1;
		}

		$paginaSiguiente = $pagina + 1;
		if($paginaSiguiente > $totalMaximo){
			$paginaSiguiente = $totalMaximo;
		}
	}else{
		$pagina 			= 1;
		$paginaAnterior	 	= 1;
		$paginaSiguiente	= 2;
	}


	$arrayFiltros['pagina'] = $pagina - 1;
	$noticiasPrincipales = $objNoticias->listarNoticias($arrayFiltros);
	$categoriaNoticiasSelect = $objCategoriaNoticias->listaSelect();

?>
<html>
	<head>
		<title>Manchester United</title>
		<meta name="viewport" content="with-device-width, initial-scale=1.0">
		<link rel="stylesheet" href="C:/laragon/www/proyecto/probando/frontend/css/styles.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">  
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> 
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;1,100;1,200&family=Roboto:wght@300&display=swap">
	</head>
	<body>
	<style>
		
		.cartelError{
			background-color: red; 
			height: 110px; width: 650px; 
			margin-left: 35%; 
			border-radius: 10px;
			font-family: 'Montserrat', sans-serif;
		}
		.cartelError h3{
			padding: 5px;
		}

		.cartelExito{
			background-color: green; 
			height: 110px; width: 650px; 
			margin-left: 35%; 
			border-radius: 10px; 
			font-family: 'Montserrat', sans-serif;
		}

		.cartelExito h3{
			padding: 5px;
		}

		.BuscarJugador{
			width: 30%;
			margin-left: 71vh;
			background: rgba( 0, 0, 0, 0.3 );
			box-shadow: 0 8px 32px 0 rgba(27, 27, 27, 0.37);
			backdrop-filter: blur( 7px );
			-webkit-backdrop-filter: blur( 7px );
		}

		.trasnparencia{
			background: rgba( 0, 0, 0, 0.3 );
			box-shadow: 0 8px 32px 0 rgba(27, 27, 27, 0.37);
			backdrop-filter: blur( 7px );
			-webkit-backdrop-filter: blur( 7px );
		}

		.botonReiniciar{
			margin-right: 33%;
		}

	</style>
					
<main>	
		



	  		<!-- CARTELES DE ERROR O EXITO -->	
<?PHP 
	if(isset($respuesta['codigo']) && $respuesta['codigo'] == "Error"  ){
?>
	<div id="mensaje" class="cartelError white-text center-align" onclick="ocultar()">
		<h3><i class="material-icons">error</i><?=$respuesta['codigo']?></h3>
		<h6><?=$respuesta['mensaje']?></h6>
	</div>
<?PHP
	}
?>
<?PHP 
	if(isset($respuesta['codigo']) && $respuesta['codigo'] == "Exito"  ){
?>
	<div id="mensaje" class="cartelExito white-text center-align" onclick="ocultar()">
		<h3><i class="material-icons">check</i><?=$respuesta['codigo']?>!</h3>
		<h6><?=$respuesta['mensaje']?></h6>
	</div>
<?PHP
	}
?>
<h3 class="center white-text">Noticias</h3>
	<div class="botonReiniciar">
		<a href="index.php?r=noticias" class="right"><i class="material-icons white-text">restore</i></a>
	</div>
	<div class="left"> 	<!-- AGREGAR NOTICIA -->
		<a href="#modalAgregarNoticia" class="waves-effect waves-light btn yellow darken-3 modal-trigger"><i class="material-icons left">group_add</i>Agregar</a>
	</div>
	<nav style="width: 30%; margin-left: 35%;" class="BuscarJugador"> 	<!-- BUSCADOR -->
		<div class="nav-wrapper">
			<form action="index.php?r=<?=$rutaPagina?>" method="POST">
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
				<th class="circle">Imagen</th>
				<th>titulo</th>
				<th>Fecha de Publicacion</th>
				<th>descripcion1</th>
				<th>descripcion2</th>
				<th>categoriaNoticia</th>
				<th>Botones</th>
			</tr>
		</thead>
		
			<tbody>

				<?php 
					foreach ($noticiasPrincipales as $noticias){
				?>
				<tr>
					<td>
						<img class="circle" src="archivos/imagenes/<?=$noticias['imagen']?>"style="width: 75px;">
					</td>
					<td><?=$noticias['titulo']?></td>
					<td><?=$noticias['fechaPublicacion']?></td>
					<td><?=$noticias['descripcion1']?></td>
					<td><?=$noticias['descripcion2']?></td>
					<td><?=$noticias['nombre']?></td>
					<td>
						<div>
							<a href="index.php?r=<?=$rutaPagina?>&accion=editar&noticias=<?=$noticias['id']?>" class="waves-effect waves-light modal-trigger btn yellow darken-3">
								<i class="material-icons left">edit</i>
							</a>
							<a href="index.php?r=<?=$rutaPagina?>&accion=borrar&noticias=<?=$noticias['id']?>" class="waves-effect waves-light btn red accent-4">
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
								<li class="waves-effect"><a href="index.php?r=<?=$rutaPagina?>&pagina=<?=$paginaAnterior?>&buscador=<?=$buscar?>" class=""><i class="material-icons white-text">chevron_left</i></a></li>									
				<?php
					for($i = 1; $i <= $totalMaximo; $i++){
						$class = "waves-effect";
						if($i == $pagina){
							$class = "active yellow darken-3";
						}
				?>
						<li class="<?=$class?>">
							<a href="index.php?r=<?=$rutaPagina?>&pagina=<?=$i?>&buscador=<?=$buscar?>" class="white-text waves-effect"><?=$i?></a>
						</li>
				<?php
					}
				?>


								<li class="waves-effect"><a href="index.php?r=<?=$rutaPagina?>&pagina=<?=$paginaSiguiente?>&buscador=<?=$buscar?>" class=""><i class="material-icons white-text">chevron_right</i></a></li>
							</ul>
						</td>
					</tr>
			</tbody>
	</table>

		
	
			<!-- BORRAR NOTICIA -->
<?PHP 
	if(isset($_GET['accion']) && $_GET['accion'] == "borrar" && isset($_GET['noticias']) && $_GET['noticias'] != ""  ){
?>
	<div class="borrarJugador center-align white-text">	
		<form action="index.php?r=<?=$rutaPagina?>" method="POST" class="col s12">
			<h3>Eliminar Noticia</h3>
			<h4>Desea borrar la noticia <?=$_GET['noticias']?>?</h4>
			<input type="hidden" name="id" value="<?=$_GET['noticias']?>">
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
	
						
		<!-- EDITAR NOTICIA -->			
<?PHP 
	if(isset($_GET['accion']) && $_GET['accion'] == "editar" && isset($_GET['noticias']) && $_GET['noticias'] != ""  ){
		$objNoticias->cargar($_GET['noticias']);
?>

	<div class="center-align white-text editarNoticia">	
		<h3>Editar Noticia</h3>
		<form action="index.php?r=<?=$rutaPagina?>" enctype="multipart/form-data" method="POST" class="col s12">
			<div class="row">
				<div class="input-field col s6">
					<input id="titulo" type="text" placeholder="Titulo" class="validate white-text" name="txtTitulo" value="<?=$objNoticias->obtenerTitulo()?>">
				</div>
				<div class="input-field col s6">
					<input id="fechaPublicacion" type="date" class="validate white-text" name="txtFechaPublicacion" value="<?=$objNoticias->obtenerFechaPublicacion()?>">
					<label for="fechaPublicacion">Fecha de Publicacion</label>
				</div>
				<div class="input-field col s6">
					<input type="hidden" name="txtId" value="<?=$objNoticias->obtenerId()?>">
				</div>
			</div>
			<div class="row">
				<div class="file-field input-field">
					<div class="btn red darken-4">
						<span>Imagen</span>
						<input type="file" name="imagen" value="<?=$objNoticias->obtenerImagen()?>">
					</div>
					<div class="file-path-wrapper white-text">
						<input class=" white-text file-path validate" type="text">
					</div>
				</div>
				<div class="input-field col s4">
					<select name="selectCategoria" value="<?=$objNoticias->obtenerCategoriaNoticia()?>">
					<?php foreach($categoriaNoticiasSelect as $selectCategorias){	
							?>	
									<option value="<?=$selectCategorias['codigo']?>"><?=$selectCategorias['nombre']?></option>
						<?php
							}
						?>
					</select>
					<label>Categoria Noticia</label>
				</div>
				<div class="input-field col s8">
					<textarea id="descripcion1" type="text" placeholder="Descripcion arriba de la imagen" class="validate materialize-textarea white-text" name="txtDescripcion1" value="<?=$objNoticias->obtenerDescripcion1()?>"><?=$objNoticias->obtenerDescripcion1()?></textarea>
				</div>
			</div>
				<div class="input-field col s12">
					<textarea id="descripcion2" type="text" placeholder="Descripcion debajo de la imagen" class="validate materialize-textarea white-text" name="txtDescripcion2" value="<?=$objNoticias->obtenerDescripcion2()?>"><?=$objNoticias->obtenerDescripcion2()?></textarea>
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



		<!-- MODAL AGREGAR NOTICIA -->
<div id="modalAgregarNoticia" class="modal">
	<div class="modal-content">
		<h4 class="center">Agregar Noticia</h4>
		<br>
		<div class="row">
			<form action="index.php?r=<?=$rutaPagina?>" enctype="multipart/form-data" method="POST" class="col s12">
				<div class="row">
					<div class="input-field col s6">
						<input id="titulo" type="text" class="validate" name="txtTitulo">
						<label for="titulo">Titulo</label>
					</div>
					<div class="input-field col s6">
						<input id="fechaPublicacion" type="date" class="validate" name="txtFechaPublicacion">
						<label for="fechaPublicacion">Fecha de Publicacion</label>
					</div>
				</div>		
				<div class="row">
					<div class="file-field input-field">
						<div class="btn red darken-4">
							<span>Imagen</span>
							<input type="file" name="imagen">
						</div>
						<div class="file-path-wrapper">
							<input class="file-path validate" type="text">
						</div>
					</div>
					<div class="input-field col s4">
							<select name="selectCategoria">
							<option disabled selected>Elija la categoria de la noticia</option>

					<?php foreach($categoriaNoticiasSelect as $selectCategorias){	
						?>	
								<option value="<?=$selectCategorias['codigo']?>"><?=$selectCategorias['nombre']?></option>
					<?php
						}
					?>
							</select>
							<label>Categoria Noticia</label>
					</div>
					<div class="input-field col s4">
					<textarea id="descripcion1" type="text" class="validate materialize-textarea" name="txtDescripcion1"></textarea>
						<label for="descripcion1">Descripcion arriba de la imagen</label>
					</div>
					<div class="input-field col s4">
						<textarea id="descripcion2" type="text" class="validate materialize-textarea" name="txtDescripcion2"></textarea>
						<label for="descripcion2">Descripcion debajo de la imagen</label>
					</div>
				</div>
				<button class="btn red darken-4 waves-effect waves-light" type="submit" name="accion" value="agregarUnaNoticia">Enviar
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
	function ocultar(){
	document.getElementById('mensaje').style.display = "none";
}
			</script>
	</body>
</html>
