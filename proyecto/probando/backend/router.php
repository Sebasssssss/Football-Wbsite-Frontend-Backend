<?php

	if(isset($_GET['r']) && $_GET['r'] != ""){

		$ruta = $_GET['r'];

		if($ruta == "noticias"){
			include("vistas/noticias_vistas.php");

		}elseif($ruta =="jugadores"){

			include("vistas/jugadores_vistas.php");

		}elseif($ruta =="categorias"){

			include("vistas/categorias_vistas.php");

		}elseif($ruta =="contacto"){

			include("vistas/contacto_vistas.php");

		}elseif($ruta =="administradores"){

			include("vistas/administradores_vistas.php");

		}




	}else{

		echo "	<div class='textoInicio'>
					<h1>Manchester United</h1>
					<p>Bienvenido al Backend</p>
				</div>";

	}





?>
