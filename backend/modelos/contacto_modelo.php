<?php
	
	require_once("modelos/generico_modelo.php");

	class contacto_modelo extends generico_modelo{

		protected $nombre;

		protected $email;

		protected $tema;

		protected $mensaje;

		protected $id;

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

		public function obtenerId(){

			return $this->id;

		}


		public function constructor($data = array()){

			$this->nombre	= $data['nombre'];
			$this->email    = $data['email'];
			$this->tema	    = $data['tema'];
			$this->mensaje	= $data['mensaje'];
			$this->id 					= isset($data['id'])?$data['id']:"";


		}

		public function cargar($id){
				
	
			$sql = "SELECT * FROM contacto WHERE id = :id";
			$arrayDatos = array("id" => $id);
			$lista = $this->traerListado($sql, $arrayDatos);
	
			if(isset($lista[0])){
				$this->nombre 	= $lista[0]['nombre'];
				$this->email 	= $lista[0]['email'];
				$this->tema 	= $lista[0]['tema'];
				$this->mensaje 	= $lista[0]['mensaje'];
				$this->estado 	= $lista[0]['estado'];
				$this->id 		= $lista[0]['id'];	
			}
	
		}


	public function borrar(){
				
		$sql = "UPDATE contacto SET estado = 0 WHERE id = :id";
		$arrayDatos = array("id" => $this->id);
		$respuesta = $this->ejecutarConsulta($sql, $arrayDatos);
		
		if($respuesta){
			$arrayRespuesta['codigo'] = "Exito";
			$arrayRespuesta['mensaje'] = "Se borro el mensaje correctamente";
		}else{
			$arrayRespuesta['codigo'] = "Error";
			$arrayRespuesta['mensaje'] = "Error al borrar el mensaje";
		}
		return $arrayRespuesta;

	}
	


	public function listar($filtros = array()){

		$sql = "SELECT * FROM contacto WHERE estado = 1";
		if(isset($filtros['buscar']) && $filtros['buscar'] != ""){

			$sql .= " AND (nombre LIKE ('%".$filtros['buscar']."%')
							OR email LIKE ('%".$filtros['buscar']."%')
							OR tema LIKE ('%".$filtros['buscar']."%')
						)
					";
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



	public function totalPaginas($filtros = array()){

		$sql = "SELECT count(*) as total FROM contacto
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
