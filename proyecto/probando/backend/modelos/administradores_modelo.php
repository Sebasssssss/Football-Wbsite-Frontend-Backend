<?php

	require_once("modelos/generico_modelo.php");

	class administradores_modelo extends generico_modelo{
		
		protected $id;

		protected $nombre;

		protected $mail;

		protected $clave;

		protected $estado;
	
		private $totalEnLista = 3;

		public function obtenerId(){

			return $this->id;
		}

		public function obtenerNombre(){

			return $this->nombre;
		}

		public function obtenerMail(){

			return $this->mail;
		}

		public function constructor($data = array()){

			$this->id 		= $data['id'];
			$this->nombre 	= $data['nombre'];
			$this->mail 	= $data['mail'];
			$this->clave 	= md5($data['clave']);

		}


		public function cargar($id){
			

			$sql = "SELECT * FROM administradores WHERE id = :id";
			$arrayDatos = array("id" => $id);
			$lista = $this->traerListado($sql, $arrayDatos);

			if(isset($lista[0])){
				$this->id 		= $lista[0]['id'];
				$this->nombre 	= $lista[0]['nombre'];
				$this->mail 	= $lista[0]['mail'];
				$this->estado 	= $lista[0]['estado'];	
			}

		}

		public function login($nombre, $clave){

			$sql = "SELECT * FROM administradores 
							WHERE nombre = :nombre
							AND clave = :clave";

			$nombreMinuscula = strtolower($nombre);
			$claveMD5 = md5($clave);
			$arraySQL = array("nombre" =>$nombreMinuscula, "clave" =>$claveMD5);

			$administrador = $this->traerListado($sql, $arraySQL);

			if(isset($administrador[0])){
				return true;
			}
			return false;

		}


		public function ingresar(){

			$sql = "INSERT INTO administradores SET

			nombre 		= :nombre,
			mail 		= :mail,
			clave 		= :clave,
			estado 		= 1;";

			$arraySQL = array(
			"nombre" 		=> $this->nombre,
			"mail" 			=> $this->mail,
			"clave" 		=> $this->clave,
			);

			$respuesta = $this->ejecutarConsulta($sql, $arraySQL);
	
			if($respuesta){
				$arrayRespuesta['codigo'] = "Exito";
				$arrayRespuesta['mensaje'] = "Se agrego un administrador correctamente";
			}else{
				$arrayRespuesta['codigo'] = "Error";
				$arrayRespuesta['mensaje'] = "Error al agregar al administrador";
			}
			return $arrayRespuesta;


		}


		public function enlistar($filtros = array()){
			$sql = "SELECT * FROM administradores WHERE estado = 1";
			
			if(isset($filtros['buscar']) && $filtros['buscar'] != ""){
	
				$sql .= " AND nombre LIKE ('%".$filtros['buscar']."%')";
			}
	
	
			if(isset($filtros['pagina']) && $filtros['pagina'] != ""){
				$pagina = $filtros['pagina'] * $this->totalEnLista;
				$sql .= " LIMIT ".$pagina.",".$this->totalEnLista."";
			}else{
				$sql .= " LIMIT 0,".$this->totalEnLista;
			}
			$lista = $this->traerListado($sql);
			return $lista;

		}
		
		public function editar(){


				$sql = "UPDATE administradores SET
						nombre 	= :nombre,
						mail 	= :mail,
						clave 	= :clave
					WHERE id = :id;";
				$arraySQL = array(
					"nombre" 	=> $this->nombre,
					"mail" 		=> $this->mail,
					"clave" 	=> $this->clave,
					"id" 		=> $this->id,
				);	

			$respuesta = $this->ejecutarConsulta($sql, $arraySQL);

			if($respuesta){
				$arrayRespuesta['codigo'] = "Exito";
				$arrayRespuesta['mensaje'] = "Se edito al administrador correctamente";
			}else{
				$arrayRespuesta['codigo'] = "Error";
				$arrayRespuesta['mensaje'] = "Error al editar al administrador";
			}
			return $arrayRespuesta;	
		}


		public function borrar(){
				
			$sql = "UPDATE administradores SET estado = 0 WHERE id = :id";
			$arrayDatos = array("id" => $this->id);
			$respuesta = $this->ejecutarConsulta($sql, $arrayDatos);
			
			if($respuesta){
				$arrayRespuesta['codigo'] = "Exito";
				$arrayRespuesta['mensaje'] = "Se borro el jugador correctamente";
			}else{
				$arrayRespuesta['codigo'] = "Error";
				$arrayRespuesta['mensaje'] = "Error al borrar al jugador";
			}
			return $arrayRespuesta;

		}



		public function totalPaginas($filtros = array()){
	
			$sql = "SELECT count(*) as total FROM administradores
			WHERE estado = 1";
	
			if(isset($filtros['buscar']) && $filtros['buscar'] != ""){
	
				$sql .= " AND nombre LIKE ('%".$filtros['buscar']."%')";
			}
	
	
			$lista = $this->traerListado($sql);
	
			$totalRegistros = $lista[0]['total'];
			$totalPaginas = ceil($totalRegistros/$this->totalEnLista);
			
			return $totalPaginas;
	
		}



	} 






?>
