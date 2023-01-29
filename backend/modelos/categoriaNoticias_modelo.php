<?php

	require_once("modelos/generico_modelo.php");

	class categoriaNoticias_modelo extends generico_modelo{

		protected $nombre;

		protected $codigo;

		public $totalEnLista = 3;

		public function obtenerNombre(){
			return $this->nombre;
		}

		public function obtenerCodigo(){
			return $this->codigo;
		}


		public function constructor($data = array()){

			$this->nombre 				= $data['nombre'];
			$this->codigo 				= $data['codigo'];

		}


		public function cargar($codigo){
	
			$sql = "SELECT * FROM categoriasNoticias WHERE codigo = :codigo";
			$arrayDatos = array("codigo" => $codigo);
			$lista = $this->traerListado($sql, $arrayDatos);
			if(isset($lista[0])){
				$this->nombre 				= $lista[0]['nombre'];
				$this->codigo 				= $lista[0]['codigo'];
			}
	
		}


		public function agregarCategoriaNoticia(){

			$sql = "INSERT INTO categoriasNoticias SET 
								nombre = :nombre,
								estado = 1;";

			$arraySQL = array(
			        "nombre" => $this->nombre,
			);

			$respuesta = $this->ejecutarConsulta($sql, $arraySQL);
	
			if($respuesta){
				$arrayRespuesta['codigo'] = "Exito";
				$arrayRespuesta['mensaje'] = "Se ingreso la categoria noticia correctamente";
			}else{
				$arrayRespuesta['codigo'] = "Error";
				$arrayRespuesta['mensaje'] = "Error al ingresar la categoria noticia";
			}
			return $arrayRespuesta;


		}

		public function borrar(){

			$sql = "UPDATE categoriasNoticias SET estado = 0 WHERE codigo = :codigo";
			$arraySQL = array("codigo" => $this->codigo);
			$respuesta = $this->ejecutarConsulta($sql, $arraySQL);

			if($respuesta){
				$arrayRespuesta['codigo'] = "Exito";
				$arrayRespuesta['mensaje'] = "Se borro la categoria correctamente";
			}else{
				$arrayRespuesta['codigo'] = "Error";
				$arrayRespuesta['mensaje'] = "Error al borrar la categoria";
			}
			return $arrayRespuesta;

		}

		public function editar(){

			$sql = "UPDATE categoriasNoticias SET
						nombre 		= :nombre
					WHERE codigo = :codigo;";
			$arrayDatos = array(				
				"nombre" 	=> $this->nombre,
				"codigo" 	=> $this->codigo,
			);
			$respuesta = $this->ejecutarConsulta($sql, $arrayDatos);

			if($respuesta){
				$arrayRespuesta['codigo'] = "OK";
				$arrayRespuesta['mensaje'] = "Se Edito la categoria correctamente";
			}else{
				$arrayRespuesta['codigo'] = "Error";
				$arrayRespuesta['mensaje'] = "Error al editar la categoria";
			}
			return $arrayRespuesta;


		}



		public function listar($filtros = array()){

			$sql = "SELECT * FROM categoriasNoticias WHERE estado = 1";
			
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


		public function listaSelect(){

			$sql = "SELECT codigo, nombre
						FROM categoriasNoticias 
						WHERE estado = 1 ";

			$lista = $this->traerListado($sql);
			return $lista;


		}



		public function totalPaginas($filtros = array()){
	
			$sql = "SELECT count(*) as total FROM categoriasNoticias
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
