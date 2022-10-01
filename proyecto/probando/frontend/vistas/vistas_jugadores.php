<?php

	require_once("modelos/jugadores_modelo.php");
	$rutaPagina = "jugadores";

	$objJugadores = new jugadores_modelo();

	$listaJugadores = $objJugadores->listarBanca();

?>

<html>
	<head>
		<title>Manchester United</title>
		<meta name="viewport" content="with-device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/styles.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">  
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> 
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;1,100;1,200&family=Roboto:wght@300&display=swap" rel="stylesheet">
	</head>

	<body>
<style>
	.bancaJugadores{
	background: rgba( 0, 0, 0, 0.3 );
	box-shadow: 0 8px 32px 0 rgba(27, 27, 27, 0.37);
	backdrop-filter: blur( 7px );
	-webkit-backdrop-filter: blur( 7px );
	border-radius: 20px;
}
</style>

		<!-- MODAL INFERIOR DE LOS JUGADORES QUE CONECTA CON EL BACKEND -->

		<div class="FondoJugadores"> 
			<div class="BotonBanca">
				<a class="waves-effect waves-light btn red accent-4 modal-trigger" href="#modal12">Banca</a>
				<div id="modal12" class="modal bottom-sheet bancaJugadores">
					<div class="modal-content">						
					<table class="white-text centered">
						<thead>
						<tr>
								<th>Imagen</th>
								<th>Nombre</th>
								<th>Apellido</th>
								<th>Fecha de Naciemiento</th>
								<th>Sexo</th>
								<th>Numero camiseta</th>
						</tr>
						</thead>

						<tbody>
						<?php 
								foreach ($listaJugadores as $Jugadores){
							?>
							<tr>							
								<td>
									<img class="circle" src="http://localhost/Sebastián_Rodriguez_cur2140_EntregaFinal/proyecto/probando/backend/archivos/imagenes/<?=$Jugadores['imagen']?>">
								</td>
								<td><?=$Jugadores['nombre']?></td>
								<td><?=$Jugadores['apellido']?></td>
								<td><?=$Jugadores['fechaNacimiento']?></td>
								<td><?=$Jugadores['sexo']?></td>
								<td><?=$Jugadores['numCamiseta']?></td>
							</tr>

							<?php
						}
							?>
						</tbody>
					</table>
					</div>
				</div>
			</div>

		<!--  TODA LA FORMACION DE LOS JUGADORES CON SUS MODALS-->

				<div class="formacion">
					<img src="css/imagenes/formacionJugadores.jpg">
				</div>
					<div class="Cristiano">
						<img src="css/imagenes/jugadores/cardCristiano.png" class="modal-trigger" href="#modal1">
							<div id="modal1" class="modal bancaJugadores">
								<div class="modal-content center white-text">
									<h1>Cristiano Ronaldo</h1>
									<img src="css/imagenes/jugadores/modalCristiano.png">
									<h4 class="center">5 de febrero de 1985</h4>
									<p>Considerado uno de los mejores futbolistas del mundo y uno de los deportistas mas mediaticos. 
										Ronaldo fue distinguido con el premio al Mejor jugador de la Premier League en 2007 y 2008, asi como Deportista portugues del Año. 
										En la temporada 2007-08 se hizo acreedor de la Bota de Oro, el Balon de Oro, y el FIFA World Player en 2008.</p>
								</div>
							</div>
					</div>
					<div class="DeGea">
					<img src="css/imagenes/jugadores/cardDegeaNew.png" class="modal-trigger" href="#modal2">
					<div id="modal2" class="modal bancaJugadores">
						<div class="modal-content center white-text">
							<h1>David de Gea</h1>
							<img src="css/imagenes/jugadores/modalDegea.png">
							<h4 class="center">7 de noviembre de 1990</h4>
							<p>Formado en las categorias inferiores del Atletico de Madrid, De Gea debuto con el primer equipo en 2009. 
								Un año despues gano la Liga Europa y la Supercopa de Europa. En junio de 2011, se convirtio en el traspaso mas caro 
								de un portero en la Premier League, al fichar por el Manchester United que pago al Atletico de Madrid aproximadamente 
								23 millones de euros. Con el equipo ingles ha logrado siete titulos hasta la fecha, incluida la Premier League 2012-13 y 
								la Liga Europa 2016-17.</p>
						</div>
					</div>
					</div>
					<div class="Wan-Bissaka">
						<img src="css/imagenes/jugadores/cardWan.png" class="modal-trigger" href="#modal3">
							<div id="modal3" class="modal bancaJugadores">
								<div class="modal-content center white-text">
									<h1>Wan Bissaka</h1>
									<img src="css/imagenes/jugadores/modalWanBissaka.png">
									<h4 class="center">26 de noviembre de 1997</h4>
									<p>El 29 de junio de 2019 llegó a un acuerdo con el Manchester United y fichó por el club por 50 millones de libras.
										Debutó con los diablos rojos el 11 de agosto en la victoria por 4-0 sobre el Chelsea F. C. jugando los 90 minutos.
										En su segunda temporada marcó su primer gol en su 50.º partido para el club. Fue en un triunfo en campo del Newcastle United F. C. 
										por 1-4.8 Coincidiendo con el último encuentro de la campaña, la final de la Liga Europa de la UEFA, alcanzó los cien partidos 
										con el equipo mancuniano</p>
								</div>
							</div>
					</div>
					<div class="Raphael">
						<img src="css/imagenes/jugadores/cardVerane.png" class="modal-trigger" href="#modal4">
							<div id="modal4" class="modal bancaJugadores">
								<div class="modal-content center white-text">
									<h1>Raphael Verane</h1>
									<img src="css/imagenes/jugadores/modalVerane.png">
									<h4 class="center">25 de abril de 1993</h4>
									<p>Raphael Varane es un futbolista frances que juega como defensa en el Manchester United F. C. 
										de la Premier League de Inglaterra. Formado en las categorías inferiores del Racing Club de Lens, 
										debuto en 2010 con el equipo del Paso de Calais en la Ligue 1, con apenas 17 años.</p>
								</div>
							</div>
					</div>
					<div class="Luke-Shaw">
						<img src="css/imagenes/jugadores/cardLuke.png" class="modal-trigger" href="#modal5">
							<div id="modal5" class="modal bancaJugadores">
								<div class="modal-content center white-text">
									<h1>Luke Shaw</h1>
									<img src="css/imagenes/jugadores/modalLuke.png">
									<h4 class="center">12 de julio de 1995</h4>
									<p>Luke Shaw, quien llego al Manchester United proveniente del Southampton en junio de 2014, 
										sigue siendo uno de los jugadores con mayor potencial del futbol ingles.</p>
								</div>
							</div>
					</div>
					<div class="Harry-Maguire">
						<img src="css/imagenes/jugadores/cardMaguire.png" class="modal-trigger" href="#modal6">
							<div id="modal6" class="modal bancaJugadores">
								<div class="modal-content center white-text">
									<h1>Harry Maguire</h1>
									<img src="css/imagenes/jugadores/modalMaguire.png">
									<h4 class="center">5 de marzo de 1993</h4>
									<p>Maguire se formo en el Sheffield United, equipo con el que debuto profesionalmente en abril de 2011, 
										en un encuentro correspondiente a la Championship, la segunda categoria del futbol de Inglaterra. 
										En aquel club estuvo hasta el 2014, jugando durante tres temporadas en la League One (la tercera division).</p>
								</div>
							</div>
					</div>
					<div class="Pogba">
						<img src="css/imagenes/jugadores/cardPogba.png" class="modal-trigger" href="#modal7">
							<div id="modal7" class="modal bancaJugadores">
								<div class="modal-content center white-text">
									<h1>Paul Pogba</h1>
									<img src="css/imagenes/jugadores/modalPogba.png">
									<h4 class="center">15 de marzo de 1993</h4>
									<p>En diciembre, Pogba gano el Premio Golden Boy al mejor jugador joven en Europa. Haber ganado la liga por 
										primera vez, alcanzar los cuartos de final en la Liga de Campeones, ganar el Mundial sub-20 y ser promovido 
										al primer equipo por Didier Deschamps, 2013, realmente fue un año de oro para mí.</p>
								</div>
							</div>
					</div>
					<div class="Tominay">
						<img src="css/imagenes/jugadores/cardMctominay.png" class="modal-trigger" href="#modal8">
							<div id="modal8" class="modal bancaJugadores">
								<div class="modal-content center white-text">
									<h1>Scott McTominay</h1>
									<img src="css/imagenes/jugadores/modalTominay.png">
									<h4 class="center">8 de diciembre de 1996</h4>
									<p>Scott Francis McTominay (Lancaster, Inglaterra, Reino Unido, 8 de diciembre de 1996) es un futbolista 
										britanico que juega como centrocampista en el Manchester United F. C. de la Premier League de Inglaterra.</p>
								</div>
							</div>
					</div>	
					<div class="Sancho">
						<img src="css/imagenes/jugadores/cardSancho.png" class="modal-trigger" href="#modal9">
							<div id="modal9" class="modal bancaJugadores">
								<div class="modal-content center white-text">
									<h1>Jadon Sancho</h1>
									<img src="css/imagenes/jugadores/modalSancho.png">
									<h4 class="center">25 de marzo de 2000</h4>
									<p>Jadon Malik Sancho (Camberwell, Inglaterra, Reino Unido, 25 de marzo de 2000), conocido como Jadon Sancho, 
										es un futbolista británico que juega como centrocampista o delantero en el Manchester United F. C. 
										de la Premier League de Inglaterra.</p>
								</div>
							</div>
					</div>
					<div class="Rashford">
						<img src="css/imagenes/jugadores/cardRashford.png" class="modal-trigger" href="#modal10">
							<div id="modal10" class="modal bancaJugadores">
								<div class="modal-content center white-text">
									<h1>Marcus Rashford</h1>
									<img src="css/imagenes/jugadores/modalRashford.png">
									<h4 class="center">31 de octubre de 1997</h4>
									<p>Anoto en su debut con la seleccion de Inglaterra en mayo de 2016, convirtiendose en el jugador ingles mas 
										joven en anotar en su primer partido internacional. Participo en la Eurocopa 2016 como el jugador mas joven del torneo, 
										y la Copa del Mundo 2018. Anoto en su debut con la seleccion de Inglaterra en mayo de 2016, convirtiendose en el jugador 
										ingles mas joven en anotar en su primer partido internacional.</p>
								</div>
							</div>
					</div>		
					<div class="Cavani">
						<img src="css/imagenes/jugadores/cardCavani.png" class="modal-trigger" href="#modal11">
							<div id="modal11" class="modal bancaJugadores">
								<div class="modal-content center white-text">
									<h1>Edinson Cavani</h1>
									<img src="css/imagenes/jugadores/modalCavani.png">
									<h4 class="center">14 de febrero de 1987</h4>
									<p>Es segun los portales expertos en estadisticas historicas de Rec.Sport.Soccer Statistics Foundation y 
										Federacion Internacional de Historia y Estadistica de Futbol (IFFHS), el Cuarto maximo goleador sudamericano 
										de toda la historia en los campeonatos de Primera Division de Europa con 262 goles y es el cuarto sudamericano 
										con mas goles en competiciones europeas (Champions League y Europa League), con 55 tantos.</p>
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
		<script>
			document.addEventListener('DOMContentLoaded', function() {
				M.AutoInit();
			});
			
			</script>
	</body>
</html>
