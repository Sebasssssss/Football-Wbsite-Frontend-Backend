<?php

	require_once("modelos/generico_modelo.php");

	class noticias_modelo extends generico_modelo{

		public $titulo;

		public $fechaPublicacion;

		public $imagen;

		public $categoriaNoticia;

		public $descripcion1;

		public $descripcion2;

		public $id;

		public $totalEnLista = 3;

		public function obtenerTitulo(){
			return $this->titulo;
		}

		public function obtenerFechaPublicacion(){
			return $this->fechaPublicacion;
		}

		public function obtenerImagen(){
			return $this->imagen;
		}

		public function obtenerCategoriaNoticia(){
			return $this->categoriaNoticia;
		}

		public function obtenerDescripcion1(){
			return $this->descripcion1;
		}

		public function obtenerDescripcion2(){
			return $this->descripcion2;
		}

		public function obtenerId(){
			return $this->id;
		}



		public function constructor($data = array()){

			$this->titulo 				= $data['titulo'];
			$this->fechaPublicacion 	= $data['fechaPublicacion'];
			$this->imagen 				= $data['imagen'];
			$this->categoriaNoticia 	= $data['categoriaNoticia'];
			$this->descripcion1			= $data['descripcion1'];
			$this->descripcion2 		= $data['descripcion2'];
			$this->id 					= isset($data['id'])?$data['id']:"";

		}


		public function cargar($id){
	
			$sql = "SELECT * FROM noticias WHERE id = :id";
			$arrayDatos = array("id" => $id);
			$lista = $this->traerListado($sql, $arrayDatos);
			if(isset($lista[0])){
				$this->titulo 				= $lista[0]['titulo'];
				$this->fechaPublicacion 	= $lista[0]['fechaPublicacion'];
				$this->imagen 				= $lista[0]['imagen'];	
				$this->categoriaNoticia 	= $lista[0]['categoriaNoticia'];
				$this->descripcion1 		= $lista[0]['descripcion1'];
				$this->descripcion2 		= $lista[0]['descripcion2'];
				$this->id 					= $lista[0]['id'];	
			}
	
		}


		public function agregarNoticia(){

			$sql = "INSERT INTO noticias SET

			titulo 				= :titulo,
			fechaPublicacion 	= :fechaPublicacion,
			imagen 				= :imagen,
			categoriaNoticia 	= :categoriaNoticia,
			descripcion1		= :descripcion1,
			descripcion2 		= :descripcion2,
			estado = 1;";

			$arraySQL = array(
			"titulo" 			=> $this->titulo,
			"fechaPublicacion" 	=> $this->fechaPublicacion,
			"imagen" 			=> $this->imagen,
			"categoriaNoticia" 	=> $this->categoriaNoticia,
			"descripcion1"		=> $this->descripcion1,
			"descripcion2" 		=> $this->descripcion2,
			);

			$respuesta = $this->ejecutarConsulta($sql, $arraySQL);
	
			if($respuesta){
				$arrayRespuesta['codigo'] = "Exito";
				$arrayRespuesta['mensaje'] = "Se ingreso la noticia correctamente";
			}else{
				$arrayRespuesta['codigo'] = "Error";
				$arrayRespuesta['mensaje'] = "Error al ingresar la noticia";
			}
			return $arrayRespuesta;


		}



		public function listarNoticias($filtros = array()){

			$sql = "SELECT 	n.imagen,
					n.titulo,
					n.fechaPublicacion,
					c.nombre,
					n.descripcion1,
					n.id,
					n.descripcion2
					FROM noticias n
					INNER JOIN categoriasnoticias c ON c.codigo = n.categoriaNoticia
					WHERE n.estado = 1";
		
			if(isset($filtros['buscar']) && $filtros['buscar'] != ""){

					$sql .= " AND (titulo LIKE ('%".$filtros['buscar']."%')
							OR descripcion1 LIKE ('%".$filtros['buscar']."%')
							OR descripcion2 LIKE ('%".$filtros['buscar']."%')
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

		public function borrar(){

			$sql = "UPDATE noticias SET estado = 0 WHERE id = :id";
			$arraySQL = array("id" => $this->id);
			$respuesta = $this->ejecutarConsulta($sql, $arraySQL);

			if($respuesta){
				$arrayRespuesta['codigo'] = "Exito";
				$arrayRespuesta['mensaje'] = "Se borro el curso correctamente";
			}else{
				$arrayRespuesta['codigo'] = "Error";
				$arrayRespuesta['mensaje'] = "Error al borrar el curso";
			}
			return $arrayRespuesta;

		}

		public function editar(){


			if($this->imagen != ""){
				$sql = "UPDATE noticias SET
						titulo 				= :titulo,
						fechaPublicacion 	= :fechaPublicacion,
						imagen 				= :imagen,
						categoriaNoticia 	= :categoriaNoticia,
						descripcion1		= :descripcion1,
						descripcion2 		= :descripcion2
					WHERE id = :id;";
				$arraySQL = array(
					"titulo" 			=> $this->titulo,
					"fechaPublicacion" 	=> $this->fechaPublicacion,
					"imagen" 			=> $this->imagen,
					"categoriaNoticia" 	=> $this->categoriaNoticia,
					"descripcion1"		=> $this->descripcion1,
					"descripcion2" 		=> $this->descripcion2,
					"id" 				=> $this->id,
				);	

			}else{
				$sql = "UPDATE noticias SET
							titulo 				= :titulo,
							fechaPublicacion 	= :fechaPublicacion,
							categoriaNoticia 	= :categoriaNoticia,
							descripcion1		= :descripcion1,
							descripcion2 		= :descripcion2
						WHERE id = :id;";
				$arraySQL = array(
					"titulo" 			=> $this->titulo,
					"fechaPublicacion" 	=> $this->fechaPublicacion,
					"categoriaNoticia" 	=> $this->categoriaNoticia,
					"descripcion1"		=> $this->descripcion1,
					"descripcion2" 		=> $this->descripcion2,
					"id" 				=> $this->id,
				);	

			}
			$respuesta = $this->ejecutarConsulta($sql, $arraySQL);

			if($respuesta){
				$arrayRespuesta['codigo'] = "Exito";
				$arrayRespuesta['mensaje'] = "Se edito la noticia correctamente";
			}else{
				$arrayRespuesta['codigo'] = "Error";
				$arrayRespuesta['mensaje'] = "Error la editar la noticia";
			}
			return $arrayRespuesta;	
		}



		public function totalPaginas($filtros = array()){
	
			$sql = "SELECT count(*) as total FROM noticias
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
