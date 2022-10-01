<?php

require_once("modelos/administradores_modelo.php");

$objAdministradores = new administradores_modelo();

$rutaPagina = "administradores";

	$respuesta = array();
	if(isset($_POST["accion"]) && $_POST['accion'] == "ingresar" ){

		$datos = array();	
		$datos['id'] 			= "";
		$datos['nombre'] 			= isset($_POST['txtNombre'])?$_POST['txtNombre']:"";
		$datos['mail']			= isset($_POST['txtEmail'])?$_POST['txtEmail']:"";
		$datos['clave'] 	= isset($_POST['txtContraseña'])?$_POST['txtContraseña']:"";

		$objAdministradores->constructor($datos);
		$respuesta = $objAdministradores->ingresar();


	}	

	if(isset($_POST["accion"]) && $_POST['accion'] == "borrar" && isset($_POST["id"]) && $_POST['id'] != ""){

		$id = $_POST['id'];
		$objAdministradores->cargar($id);
		$respuesta = $objAdministradores->borrar();

	}
	

	if(isset($_POST["accion"]) && $_POST['accion'] == "editar" ){
			

		$datos = array();
		$datos['nombre']			= isset($_POST['txtNombre'])?$_POST['txtNombre']:"";
		$datos['mail']	= isset($_POST['txtEmail'])?$_POST['txtEmail']:"";
		$datos['id']		= isset($_POST['txtId'])?$_POST['txtId']:"";
		$datos['clave']		= isset($_POST['txtClave'])?$_POST['txtClave']:"";



		$objAdministradores->constructor($datos);
		$respuesta = $objAdministradores->editar();

	}
	
	$buscar = isset($_POST['buscador'])?$_POST['buscador']:"";
	if($buscar == "" && isset($_GET['buscador']) && ($_GET['buscador']) != ""){
		$buscar = $_GET['buscador'];
	}

	$arrayFiltros = array("buscar"=>$buscar);
	$totalMaximo = $objAdministradores->totalPaginas();
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
	$listarAdministradores = $objAdministradores->enlistar($arrayFiltros);

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


<h3 class="center white-text">Administradores</h3>
	<div class="botonReiniciar">
	<a href="index.php?r=<?=$rutaPagina?>" class="right"><i class="material-icons white-text">restore</i></a>
	</div>
	
	<div class="left"> 	<!-- AGREGAR ADMIN -->
		<a href="#modalAdministrador" class="waves-effect waves-light btn yellow darken-3 modal-trigger"><i class="material-icons left">group_add</i>Agregar</a>
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
	</nav>

	
	<!-- TABLA DE ADMINISTRADORES -->
	<table class="white-text centered">
		<thead>
			<tr>
				<th>nombre</th>
				<th>email</th>
				<th>clave</th>
				<th>Botones</th>
			</tr>
		</thead>
		
			<tbody>

				<?php 
					foreach ($listarAdministradores as $admins){
				?>
				<tr>
					<td><?=$admins['nombre']?></td>
					<td><?=$admins['mail']?></td>
					<td><?=$admins['clave']?></td>
					<td>
						<div>
							<a href="index.php?r=<?=$rutaPagina?>&accion=editar&administradores=<?=$admins['id']?>" class="waves-effect waves-light modal-trigger btn yellow darken-3">
								<i class="material-icons left">edit</i>
							</a>
							<a href="index.php?r=<?=$rutaPagina?>&accion=borrar&administradores=<?=$admins['id']?>" class="waves-effect waves-light btn red accent-4">
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
		
	
		<!-- BORRAR ADMINISTRADOR -->
<?PHP 
	if(isset($_GET['accion']) && $_GET['accion'] == "borrar" && isset($_GET['administradores']) && $_GET['administradores'] != ""  ){
?>
	<div class="borrarJugador center-align white-text">	
		<form action="index.php?r=<?=$rutaPagina?>" method="POST" class="col s12">
			<h3>Borrar Administrador</h3>
			<h4>Desea borrar al administrador <?=$_GET['administradores']?>?</h4>
			<input type="hidden" name="id" value="<?=$_GET['administradores']?>">
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
	
						
			<!-- EDITAR ADMINISTRADOR -->				
<?PHP 
	if(isset($_GET['accion']) && $_GET['accion'] == "editar" && isset($_GET['administradores']) && $_GET['administradores'] != ""  ){
		$objAdministradores->cargar($_GET['administradores']);
?>

	<div class="center-align white-text editarNoticia">	
		<h3>Editar Administrador</h3>
		<form action="index.php?r=<?=$rutaPagina?>"  method="POST" class="col s12">
			<div class="row">
				<div class="input-field col s6">
					<input id="clave" type="text" class="validate white-text" name="txtClave">
					<label for="clave">Clave</label>
				</div>
				<div class="input-field col s6">
					<input id="nombre" type="text" class="validate white-text" name="txtNombre" value="<?=$objAdministradores->obtenerNombre()?>">
					<label for="nombre">Nombre</label>
				</div>
				<div class="input-field col s6">
					<input id="email" type="email" class="validate white-text" name="txtEmail" value="<?=$objAdministradores->obtenerMail()?>">
					<label for="email">Email</label>
				</div>
				<div class="input-field col s6">
					<input id="id" type="hidden" name="txtId" value="<?=$objAdministradores->obtenerId()?>">
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
	<div id="modalAdministrador" class="modal">	<!-- MODAL DE AGREGAR ADMIN -->
		<div class="modal-content">
			<h4 class="center">Agregar Admin</h4>
			<br>
			<div class="row">
				<form action="index.php?r=<?=$rutaPagina?>" method="POST" class="col s12">
					<div class="row">
						<div class="input-field col s6">
							<input id="nombre" type="text" class="validate" name="txtNombre">
							<label for="nombre">Nombre</label>
						</div>
						<div class="input-field col s6">
							<input id="contraseña" type="password" class="validate" name="txtContraseña">
							<label for="contraseña">Contraseña</label>
						</div>
						<div class="input-field col s6">
							<input id="email" type="email" class="validate" name="txtEmail">
							<label for="email">Email</label>
						</div>
					</div>		
					<button class="btn red darken-4 waves-effect waves-light" type="submit" name="accion" value="ingresar">Enviar
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
