<?php

	require_once("modelos/modelo_generico.php");

	class noticias_modelo extends modelo_generico{

		public $titulo;

		public $fechaPublicacion;

		public $imagen;

		public $categoriaNoticia;

		public $descripcion1;

		public $descripcion2;

		public $id;

		public $totalEnLista = 2;

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



		public function listarNoticias($filtros = array()){

			$sql = "SELECT * FROM noticias WHERE estado = 1";
		
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

		public function masNoticasCostado(){
			$sql= $sql = "SELECT		n.titulo,
										n.fechaPublicacion,
										n.id,
										n.imagen,
										c.nombre,
										n.descripcion1,
										n.descripcion2
							FROM 		noticias n
							INNER JOIN	categoriasnoticias c ON c.codigo = n.categoriaNoticia
							WHERE 		n.estado = 1
							AND 		c.estado = 1;";
							
			$lista = $this->traerListado($sql);
			return $lista;
		}

		













	}

?>
