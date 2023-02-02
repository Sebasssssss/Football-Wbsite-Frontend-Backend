<?php

	require_once("modelos/modelo_generico.php");

	class categoriaNoticias_modelo extends modelo_generico{

		protected $nombre;

		protected $codigo;

		public function obtenerNombre(){
			return $this->nombre;
		}

		public function obtenerCodigo(){
			return $this->codigo;
		}


		public function constructor($data = array()){

			$this->nombre 				= $data['nombre'];

		}


		public function cargar($codigo){
	
			$sql = "SELECT * FROM categoriasNoticias WHERE codigo = :codigo";
			$arrayDatos = array("codigo" => $codigo);
			$lista = $this->traerListado($sql, $arrayDatos);
			if(isset($lista[0])){
				$this->nombre 				= $lista[0]['nombre'];
			}
	
		}

	}
?>