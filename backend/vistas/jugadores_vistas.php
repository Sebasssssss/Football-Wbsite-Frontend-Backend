<?php

	require_once("modelos/jugadores_modelo.php");
	$rutaPagina = "jugadores";

	$objJugadores = new jugadores_modelo();

	if(isset($_POST['accion']) && isset($_POST['accion']) == "ingresar"){

		$archivo = $objJugadores->subirImagen($_FILES['imagen'], "48", "48");
		if($archivo){

			$datos = array();
			$datos['nombre']			= isset($_POST['txtNombre'])?$_POST['txtNombre']:"";
			$datos['apellido']			= isset($_POST['txtApellido'])?$_POST['txtApellido']:"";
			$datos['fechaNacimiento']	= isset($_POST['txtFechaNacimiento'])?$_POST['txtFechaNacimiento']:"";
			$datos['sexo']				= isset($_POST['selectSexo'])?$_POST['selectSexo']:"";
			$datos['numCamiseta']		= isset($_POST['txtNumCamiseta'])?$_POST['txtNumCamiseta']:"";
			$datos['imagen']			= $archivo;

			$objJugadores->constructor($datos);
			$respuesta = $objJugadores->ingresar();

		}else{
			$arrayRespuesta = array();
			$arrayRespuesta['codigo'] = "Error";
			$arrayRespuesta['mensaje'] = "Error al subir la imagen";
		}
		
	}

	if(isset($_POST["accion"]) && $_POST['accion'] == "editar" ){

		$datos = array();	
		$datos['nombre'] 			= isset($_POST['txtNombre'])?$_POST['txtNombre']:"";
		$datos['apellido']			= isset($_POST['txtApellido'])?$_POST['txtApellido']:"";
		$datos['fechaNacimiento'] 	= isset($_POST['txtFechaNacimiento'])?$_POST['txtFechaNacimiento']:"";
		$datos['sexo'] 				= isset($_POST['selectSexo'])?$_POST['selectSexo']:"";
		$datos['numCamiseta'] 		= isset($_POST['txtNumCamiseta'])?$_POST['txtNumCamiseta']:"";

		$archivo = $objJugadores->subirImagen($_FILES['imagen'], "48", "48");
		if($archivo){

			$datos['imagen'] = $archivo;

		}else{

			$datos['imagen'] = "";

		}

		$objJugadores->constructor($datos);
		$respuesta = $objJugadores->editar();
	}	

	if(isset($_POST["accion"]) && $_POST['accion'] == "borrar" && isset($_POST["numCamiseta"]) && $_POST['numCamiseta'] != ""){

		$numCamiseta = $_POST['numCamiseta'];
		$objJugadores->cargar($numCamiseta);
		$respuesta = $objJugadores->borrar();

	}


	$buscar = isset($_POST['buscador'])?$_POST['buscador']:"";
	if($buscar == "" && isset($_GET['buscador']) && ($_GET['buscador']) != ""){
		$buscar = $_GET['buscador'];
	}

	$arrayFiltros = array("buscar"=>$buscar);
	$totalMaximo = $objJugadores->totalPaginas();
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
	$listaJugadores = $objJugadores->listar($arrayFiltros);

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
		<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;1,100;1,200&family=Roboto:wght@300&display=swap" rel="stylesheet">
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

		.botonReiniciar{
			margin-right: 33%;
		}

	</style>





<main>
	<section>
		<div>
			<div>
				<h3 class="center white-text">Banca</h3>
					<div class="botonReiniciar">
						<a href="index.php?r=jugadores" class="right"><i class="material-icons white-text">restore</i></a>
					</div>
					<nav style="width: 30%; margin-left: 35%;" class="BuscarJugador">	<!-- BUSCADOR -->
						<div class="nav-wrapper">
							<form action="index.php?r=<?=$rutaPagina?>" method="POST">
								<div class="input-field">
								<input id="search" type="search" name="buscador" required>
								<label class="label-icon" for="search"><i class="material-icons">search</i></label>
								<i class="material-icons">close</i>
								</div>
							</form>
						</div>
					</nav>			<!-- AGREGAR JUGADOR -->
						<a href="#modal15" class="waves-effect waves-light btn yellow darken-3 modal-trigger" style="margin-left: 10px;"><i class="material-icons left">group_add</i>Ingesar</a>
					
					<!-- MODAL AGREGAR JUGADOR -->
						<div id="modal15" class="modal">
						<div class="modal-content">
							<h4 class="center">Ingresar Jugador</h4>
							<br>
							<div class="row">
								<form action="index.php?r=<?=$rutaPagina?>" enctype="multipart/form-data" method="POST" class="col s12">
									<div class="row">
										<div class="input-field col s6">
											<input id="nombre" type="text" class="validate" name="txtNombre">
											<label for="nombre">Nombre</label>
										</div>
										<div class="input-field col s6">
											<input id="apellido" type="text" class="validate" name="txtApellido">
											<label for="apellido">Apellido</label>
										</div>
									</div>		
									<div class="row">
									<div class="file-field input-field col">
											<div class="btn red darken-4">
												<span>Imagen</span>
												<input type="file" name="imagen">
											</div>
											<div class="file-path-wrapper">
												<input class="file-path validate" type="text">
											</div>
										</div>
										<div class="input-field col s4">
											<input id="fechaNacimiento" type="date" class="validate" name="txtFechaNacimiento">
											<label for="fechaNacimiento">Fecha Nacimiento</label>
										</div>
										<div class="input-field col s4">
												<select name="selectSexo">
												<option disabled selected>Elija el sexo del jugador</option>
												<option>Masculino</option>
												<option>Femenino</option>
												</select>
												<label>Sexo</label>
										</div>
										<div class="input-field col s4">
											<input id="numCamiseta" type="text" class="validate" name="txtNumCamiseta">
											<label for="numCamiseta">Numero Camiseta</label>
										</div>
									</div>
									<button class="btn red darken-4 waves-effect waves-light" type="submit" name="accion" value="ingresar">Enviar
										<i class="material-icons right">send</i>
									</button>
								</form>
							</div>
						</div>
					</div>
				</div>

				<!-- TABLA DE JUGADORES -->
		<table class="white-text centered">
			<thead>
			<tr>
				<th class="circle">Imagen</th>
				<th>Nombre</th>
				<th>Apellido</th>
				<th>Fecha de Naciemiento</th>
				<th>Sexo</th>
				<th>numCamiseta</th>
				<th>Botones</th>
			</tr>
			</thead>
	
			<tbody>

			<?php 
				foreach($listaJugadores as $Jugadores){
			?>
			<tr>
				<td>
					<img class="circle" src="archivos/imagenes/<?=$Jugadores['imagen']?>">
				</td>
				<td><?=$Jugadores['nombre']?></td>
				<td><?=$Jugadores['apellido']?></td>
				<td><?=$Jugadores['fechaNacimiento']?></td>
				<td><?=$Jugadores['sexo']?></td>
				<td><?=$Jugadores['numCamiseta']?></td>
				<td>
					<div>
						<a href="index.php?r=<?=$rutaPagina?>&accion=editar&jugadores=<?=$Jugadores['numCamiseta']?>" class="waves-effect waves-light modal-trigger btn yellow darken-3">
							<i class="material-icons left">edit</i>
						</a>
						<a href="index.php?r=<?=$rutaPagina?>&accion=borrar&jugadores=<?=$Jugadores['numCamiseta']?>" class="waves-effect waves-light btn red accent-4">
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
	</div>
				
		<!-- CARTELES DE ERROR O EXITO -->	
<?PHP 
	if(isset($respuesta['codigo']) && $respuesta['codigo'] == "Error"  ){
?>
	<div id="mensaje" class="cartelError center-align white-text" onclick="ocultar()">
		<h3><i class="material-icons">error</i><?=$respuesta['codigo']?></h3>
		<h6><?=$respuesta['mensaje']?></h6>
	</div>
<?PHP
	}
?>
<?PHP 
	if(isset($respuesta['codigo']) && $respuesta['codigo'] == "Exito"  ){
?>
	<div id="mensaje" class="cartelExito center-align white-text" onclick="ocultar()">
		<h3><i class="material-icons">check</i><?=$respuesta['codigo']?>!</h3>
		<h6><?=$respuesta['mensaje']?></h6>
	</div>
<?PHP
	}
?>


<!-- BORRAR JUGADOR -->
<?PHP 
	if(isset($_GET['accion']) && $_GET['accion'] == "borrar" && isset($_GET['jugadores']) && $_GET['jugadores'] != ""  ){
?>
	<div class="borrarJugador center-align white-text">	
		<form action="index.php?r=<?=$rutaPagina?>" method="POST" class="col s12">
			<h3>Borrar Jugador</h3>
			<h4>Desea borrar al jugador <?=$_GET['jugadores']?>?</h4>
			<input type="hidden" name="numCamiseta" value="<?=$_GET['jugadores']?>">
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

					
	<!-- EDITAR JUGADOR -->				
<?PHP 
	if(isset($_GET['accion']) && $_GET['accion'] == "editar" && isset($_GET['jugadores']) && $_GET['jugadores'] != ""  ){
		$objJugadores->cargar($_GET['jugadores']);
?>

	<div class="center-align  editarJugador white-text">	
		<h3>Editar Jugador</h3>
		<form action="index.php?r=<?=$rutaPagina?>" enctype="multipart/form-data" method="POST" class="container col s10">
			<div class="row">
				<div class="file-field input-field col s4">
					<div class="btn red darken-4">
						<span>Imagen</span>
						<input type="file" name="imagen">
					</div>
					<div class="file-path-wrapper">
						<input class="file-path validate" type="text">
					</div>
				</div>
				<div class="input-field col s4">
					<input placeholder="Nombre" id="nombre" type="text" class="validate white-text" name="txtNombre" value="<?=$objJugadores->obtenerNombre()?>">
					<label for="nombre">Nombre</label>
				</div>
				<div class="input-field col s4">
					<input placeholder="apellido" id="apellido" type="text" class="validate white-text" name="txtApellido" value="<?=$objJugadores->obtenerApellido()?>">
					<label for="apellido">Apellido</label>
				</div>
			</div>
			<div class="row">	
				<div class="input-field col s4">
					<input placeholder="fechaNacimiento" id="fechaNacimiento" type="date" class="validate white-text" name="txtFechaNacimiento" value="<?=$objJugadores->obtenerFechaNacimiento()?>">
					<label for="fechaNacimiento">Fecha Nacimiento</label>
				</div>			
				<div class="input-field col s4">
				<select name="selectSexo">
					<option>Masculino</option>
					<option>Femenino</option>
				</select>
				<label>Sexo del jugador</label>
				</div>
				<div class="input-field col s4">
					<input placeholder="numCamiseta" id="numCamiseta" type="text" class="validate white-text" value="<?=$objJugadores->obtenerNumCamiseta()?>" disabled>
					<input type="hidden" name="txtNumCamiseta" value="<?=$objJugadores->obtenerNumCamiseta()?>">
					<label for="numCamiseta">Numero Camiseta</label>
				</div>
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
				</div>
		</section>
</main>
</html>

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
