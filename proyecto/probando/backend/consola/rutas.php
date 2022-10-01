<?php

	/*
		Es el enrutador generico
	*/

	require_once("consola/instalador.php"); 

	if(isset($_SERVER['argv'][1]) && $_SERVER['argv'][1] != ""){

		if($_SERVER['argv'][1] == "instalar"){

			$objInstlador = new instalador();
			$retorno = $objInstlador->arrancar();

		}

	}


	


?>
