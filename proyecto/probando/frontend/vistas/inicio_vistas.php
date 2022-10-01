<?php

    require_once("modelos/jugadores_modelo.php");
    $rutaPagina = "inicio";

?>


<!DOCTYPE html>
<html>
	<head>
		<title>Manchester United</title>
		<link rel="stylesheet" href="frontend/css/styles.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> 
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;1,100;1,200&family=Roboto:wght@300&display=swap">
	</head>
	<body class="bodyInicio">
				<div class="Fondo-Inicio">
							<div class="textoInicio">
								<h1>Manchester United</h1>
								<p>Bienvenido a la pagina de Manchester United</p>
							</div>
				</div>

			<!-- SECCION PRINCIPAL AL ENTRAR A LA PAGINA -->

				<div id="modal1" class="modal grey darken-4 fondoRegistrar" style="overflow: hidden;">
						<div class="modal-content">
							<div class="form-box">
								<div class="button-box">
									<div id="boton"></div>
									<button type="button" class="toggle-boton" onclick="login()">Iniciar</button>
									<button type="button" class="toggle-boton" onclick="register()">Registrar</button>
								</div>						
									<form id="iniSesion" class="input-group">
										<div class="input-field">
											<input id="email" type="email" class="white-text" required>
											<label for="email">Email</label>
										</div>
										<div class="input-field">
											<input id="password" type="password" class="white-text" required>
											<label for="password">Contrasenha</label>
										</div>
										<button type="submit" class="sumbit-btn">Iniciar sesion</button>
									</form>
							</div>
						</div>
				  </div>
			<br>


			<!-- SEGUNDA SECCION DEL INICIO CON INFORMACION DEL CLUB -->

		<section>			
		<div class="infoManchester">
				<div class="contenidoManchester">
					<div>
						<img src="css/imagenes/ContenidoInicio.jpg" class="ImagenSection">
					</div>
					<div class="textoManchester">
						<h1>Familia <span class="spanInicio">G</span>lazer</h1>
						<p>Los Glazer no solo han invertido en Manchester United en el mercado deportivo. Los estadounidenses tambien son 
							propietarios de la franquicia de la NFL, Tampa Bay Buccaneers. La propiedad de ambos equipos les ha dado el prestigio 
							a nivel mundial como una de las familias mas poderosas del deporte.  
						</p>
					</div>
				</div>
			</div>
			</div>
			<div class="infoManchester2">
				<div class="contenidoManchester2">
					<div class="textoManchester2">
						<h1>Old <span class="spanInicio">T</span>rafford</h1>
						<p>Apodado "El teatro de los sueños" por Sir Bobby Charlton, Old Trafford ha sido el hogar del United desde 1910, 
							aunque desde 1941 hasta 1949 el club compartio el Maine Road con sus rivales locales el Manchester City como resultado 
							del daño de estadio por una bomba en la Segunda Guerra Mundial.<br>
							El estadio ha sido anfitrion de semifinales de la FA Cup, partidos de Inglaterra, partidos en la Copa del Mundo de 1966, 
							Eurocopa 1996 y la Final de la Liga de Campeones de 2003, asi como la Gran Final de la Superliga de la liga de rugby y la
							final de dos Copas del Mundo de la Liga de Rugby. Tambien albergo partidos de futbol en los Juegos Olimpicos de 2012, 
							incluidos duelos del torneo femenino, los primero juegos internacionales de la rama femenil en su historia.
						</p>
					</div>
					<div>
						<img src="css/imagenes/fondoRegistrar.jpg" class="ImagenSection2">
					</div>
				</div>
			</div>
		</section>


			<!-- SECCION DONDE SE VE CONTRA QUIEN JUEGA EL EQUIPO EL SIGUIENTE PARTIDO -->

			<div class="ResultadoFondo">
				<div>
					<div class="PartidoResultado">
						<h1>MAN UTD </h1><h4>vs</h4><h1>MAN CITY</h1>
					</div>
					<div class="logosEquipo">
						<img src="css/imagenes/logo.png" class="unitedLogo">
						<img src="css/imagenes/logoCity.png" class="cityLogo">
					</div>
				</div>
			</div>


			<!-- ULTIMA SECCION CON LOS DISEÑOS DE LAS CAMISETAS -->

			<div class="fondoCards">
				<div class="cuerpoCards">
					<div>
						<div class="cardsAnimacion">
							<div class="cardsInicio">
								<div class="contenidoCards">
									<h2>Camiseta Local</h2>
									<p>Esta camiseta sera la utilizada para los encuentros que se lleven a cabo en el estadio Old Trafford.</p>
								</div>
								<img src="css/imagenes/camiseta.png">
							</div>				
						</div>
					</div>

					<div>
						<div class="cardsAnimacion">
							<div class="cardsInicio">
								<div class="contenidoCards">
									<h2>Camiseta Visitante</h2>
									<p>Estas sera el modelo de camiseta presentada para este anho 2022 
										la cual se utilizara durante los partidos que el equipo juege como visitante.</p>
								</div>
								<img src="css/imagenes/camisetaVisitante.png">
							</div>				
						</div>
					</div>
				</div>
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
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	</body>
</html>