<?php

	if(isset($_GET['r']) && $_GET['r'] != ""){

		$ruta = $_GET['r'];

		if($ruta == "noticias"){
			include("vistas/noticias_vistas.php");

		}elseif($ruta =="jugadores"){

			include("vistas/vistas_jugadores.php");

		}elseif($ruta =="contacto"){

			include("vistas/contacto2_vistas.php");

		}elseif($ruta =="inicio"){

			include("vistas/inicio_vistas.php");

		}




	}else{

		echo "<div class='Fondo-Inicio'>
					<div class='textoInicio'>
						<h1>Manchester United</h1>
						<p>Bienvenido a la pagina de Manchester United</p>
					</div>
			</div>";

	}
