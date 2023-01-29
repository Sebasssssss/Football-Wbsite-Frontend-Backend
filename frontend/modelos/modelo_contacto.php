<?php
	
	require_once("modelos/modelo_generico.php");

	class contacto_modelo extends modelo_generico{

		protected $nombre;

		protected $email;

		protected $tema;

		protected $mensaje;

		protected $totalEnLista = 3;
		
		public function obtenerNombre(){

			return $this->nombre;

		}

		public function obtenerEmail(){

			return $this->email;

		}

		public function obtenerTema(){

			return $this->tema;

		}

		public function obtenerMensaje(){

			return $this->mensaje;

		}


		public function constructor($data = array()){

			$this->nombre	= $data['nombre'];
			$this->email    = $data['email'];
			$this->tema	    = $data['tema'];
			$this->mensaje	= $data['mensaje'];


		}

		public function enviarMensaje(){

			$sql = "INSERT INTO contacto SET 

				nombre 		= :nombre,
				email 		= :email,
				tema 		= :tema,
				mensaje 	= :mensaje,
				estado = 1;";
				
		$arrayDatos = array(
			"nombre"			=> $this->nombre, 
			"email" 			=> $this->email, 
			"tema"				=> $this->tema,
			"mensaje" 			=> $this->mensaje,
		);

		$respuesta = $this->ejecutarConsulta($sql, $arrayDatos);

	}

















	}


?>