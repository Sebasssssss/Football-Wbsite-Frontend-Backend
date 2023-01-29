<?php
	require_once("modelos/usuarios_modelo.php");
	@session_start();
	$objUsuarios = new usuarios_modelo();

	$nombre = isset($_POST['txtNombre'])?$_POST['txtNombre']:"";
	$clave = isset($_POST['txtClave'])?$_POST['txtClave']:"";

	if($nombre != "" && $clave != ""){
		$objUsuarios = new usuarios_modelo();
		$respuesta = $objUsuarios->logueando($nombre, $clave);

		if($respuesta){
			$_SESSION['usuario'] = $nombre;
			header("Location:index.php");
		}else{
			unset($_SESSION['usuario']);
			session_destroy();
		}

	}else{
		unset($_SESSION['usuario']);
		session_destroy();
	}

	if(isset($_POST['accion']) && isset($_POST['accion']) == "registrarUsuario"){

	    $datos = array();
	    $datos['id'] 			= "";
	    $datos['nombre'] 		= isset($_POST['RegistrarNombre'])?$_POST['RegistrarNombre']:"";
	    $datos['mail'] 			= isset($_POST['RegistrarEmail'])?$_POST['RegistrarEmail']:"";
	    $datos['clave'] 		= isset($_POST['RegistrarClave'])?$_POST['RegistrarClave']:"";
	    
	    $objUsuarios->constructor($datos);
	    $respuesta = $objUsuarios->registrar($clave);
	} 


?>


<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="with-device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/styles.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> 
		<title>Manchester United</title>
	</head>
	<body>
		<section class="Fondo-Login">
					<div class="NavbarFondo">
						<div class="navbarInicio">
							<ul>
								<li><a href="index.php?r=inicio">Inicio</a></li>
								<li><a href="index.php?r=inicio">Jugadores</a></li>
								<li><a href="index.php?r=inicio">Contacto</a></li>
							</ul>
							<img src="css/imagenes/logo.png" class="logo-navbar">
						</div>
					</div>


		<!--FORMULARIO PARA INCIAR SESION O REGISTRARSE -->

		<div class="cuadro-login">
			<div class="cuadro-boton">
				<button type="button" class="mover-boton" onclick="login()">Iniciar</button>
				<button type="button" class="mover-boton" onclick="register()">Registrar</button>
			</div>						
				<form id="iniSesion" class="input-group" action="login.php?" method="POST">
					<div class="input-field white-text">
						<i class="material-icons prefix">account_circle</i>
						<input placeholder="nombre" id="nombre" type="text" class="validate white-text" name="txtNombre">
					</div>
					<div class="input-field white-text">
						<i class="material-icons prefix white-text">lock</i>
						<input placeholder="Contrasenha" id="clave" type="password" class="validate white-text" name="txtClave">
					</div>
					<button type="submit" class="sumbit-btn">Iniciar sesion</button>
				</form>
				<form id="Registrar" class="input-group" action="login.php?" method="POST">
					<div class="input-field white-text">
						<i class="material-icons prefix">account_circle</i>
						<input id="text" placeholder="nombre" type="text" class="white-text" name="RegistrarNombre" required>
					</div>
					<div class="input-field">
						<i class="material-icons prefix white-text">email</i>
						<input id="email" placeholder="email" type="email" class="white-text" name="RegistrarEmail" required>
					</div>
					<div class="input-field">
						<i class="material-icons prefix white-text">lock</i>
						<input id="password" placeholder="contraseña" type="password" class="white-text" name="RegistrarClave" required>
					</div>
					<button type="submit" class="sumbit-btn"  name="accion" value="registrarUsuario">Registrar</button>
				</form>
		</div>

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
		</section>

<script>
	var x = document.getElementById("iniSesion");
	var y = document.getElementById("Registrar");

	function register(){
		x.style.left = "-400px";
		y.style.left = "50px";
	}
	function login(){
		x.style.left = "50px";
		y.style.left = "450px";
	}


</script>
	</body>
</html>
