<?php

	require_once("modelos/modelo_generico.php");

	class usuarios_modelo extends modelo_generico{

		protected $nombre;

		protected $mail;

		protected $clave;

		protected $id;


		public function obtenerNombre(){

			$this->nombre;
			
		}

		public function obtenerMail(){

			$this->mail;
			
		}

		public function obtenerId(){

			$this->id;
			
		}
		
		public function constructor($data = array()){

			$this->id 			= $data['id'];
			$this->nombre		= $data['nombre'];
			$this->mail 		= $data['mail'];
			$this->clave 		= md5($data['clave']);


		}

		public function cargar($id){
			
			$sql = "SELECT * FROM usuarios WHERE id = :id";
			$arrayDatos = array("id" => $id);
			$lista = $this->traerListado($sql, $arrayDatos);

			if(isset($lista[0])){
				$this->nombre 	= $lista[0]['nombre'];
				$this->mail 	= $lista[0]['mail'];
				$this->id 		= $lista[0]['id'];
				$this->estado 	= $lista[0]['estado'];	
			}

		}

		public function registrar(){

			$sql = "INSERT INTO usuarios SET 

				nombre 	= :nombre,
				mail 	= :mail,
				clave 	= :clave,
				estado 	= 1;";
				
		$arrayDatos = array(
			"nombre"	=> $this->nombre, 
			"mail" 		=> $this->mail,
			"clave" 	=> $this->clave,
		);
		$respuesta = $this->ejecutarConsulta($sql, $arrayDatos);
		return $respuesta;
		}


		public function logueando($nombre, $clave){
			$sql = "SELECT * FROM usuarios 
					WHERE nombre = :nombre 
					AND clave = :clave";

			$nombreMinuscula = strtolower($nombre);
			$claveMD5 = md5($clave);
			$arraySQL = array("nombre" =>$nombreMinuscula, "clave" => $claveMD5);

			$usuario = $this->traerListado($sql, $arraySQL);

			if(isset($usuario[0])){
				return true;
			}
			return false;
		}

	}

?>
