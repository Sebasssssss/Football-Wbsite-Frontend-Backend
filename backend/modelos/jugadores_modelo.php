<?php
	
	require_once("modelos/generico_modelo.php");

	class jugadores_modelo extends generico_modelo{

		protected $nombre;

		protected $apellido;

		protected $fechaNacimiento;

		protected $sexo;

		protected $numCamiseta;

		protected $imagen;

		protected $estado;

		protected $totalEnLista = 4;

		public function obtenerNombre(){

			return $this->nombre;

		}

		public function obtenerApellido(){

			return $this->apellido;

		}

		public function obtenerFechaNacimiento(){

			return $this->fechaNacimiento;

		}

		public function obtenerSexo(){

			return $this->sexo;

		}

		public function obtenerNumCamiseta(){

			return $this->numCamiseta;

		}

		public function obtenerImagen(){

			return $this->imagen;

		}


		public function constructor($data = array()){

			$this->nombre			= $data['nombre'];
			$this->apellido			= $data['apellido'];
			$this->fechaNacimiento	= $data['fechaNacimiento'];
			$this->sexo				= $data['sexo'];
			$this->numCamiseta		= $data['numCamiseta'];
			$this->imagen			= $data['imagen'];


		}

		public function cargar($numCamiseta){
	
			$sql = "SELECT * FROM jugadoresBanca WHERE numCamiseta = :numCamiseta";
			$arrayDatos = array("numCamiseta" => $numCamiseta);
			$lista = $this->traerListado($sql, $arrayDatos);
			if(isset($lista[0])){
				$this->nombre 			= $lista[0]['nombre'];
				$this->apellido 		= $lista[0]['apellido'];
				$this->fechaNacimiento 	= $lista[0]['fechaNacimiento'];	
				$this->sexo 			= $lista[0]['sexo'];
				$this->numCamiseta 		= $lista[0]['numCamiseta'];
				$this->estado 			= $lista[0]['estado'];	
				$this->imagen 			= $lista[0]['imagen'];	
			}
	
		}

		public function ingresar(){

			$sql = "INSERT INTO jugadoresBanca SET 

				nombre 			= :nombre,
				apellido 		= :apellido,
				fechaNacimiento = :fechaNacimiento,
				sexo 			= :sexo,
				numCamiseta		= :numCamiseta,
				imagen			= :imagen,
				estado 			= 1;";
				
		$arrayDatos = array(
			"nombre"			=> $this->nombre, 
			"apellido" 			=> $this->apellido, 
			"fechaNacimiento"	=> $this->fechaNacimiento,
			"sexo" 				=> $this->sexo,
			"numCamiseta" 		=> $this->numCamiseta,
			"imagen" 			=> $this->imagen,
		);

		$respuesta = $this->ejecutarConsulta($sql, $arrayDatos);

		if($respuesta){
			$arrayRespuesta['codigo'] = "Exito";
			$arrayRespuesta['mensaje'] = "Se ingreso el jugador correctamente";
		}else{
			$arrayRespuesta['codigo'] = "Error";
			$arrayRespuesta['mensaje'] = "Error al ingresar al jugador";
		}
		return $arrayRespuesta;

	}


	public function listar($filtros = array()){

		$sql = "SELECT * FROM jugadoresBanca WHERE estado = 1";
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

		if($this->imagen != ""){
			$sql = "UPDATE jugadoresBanca SET
						imagen 			= :imagen,
						nombre  		= :nombre,
						apellido		= :apellido,
						fechaNacimiento = :fechaNacimiento,
						sexo 			= :sexo
					WHERE numCamiseta 	= :numCamiseta";
			$arraySQL = array(
				"numCamiseta" 		=> $this->numCamiseta,
				"nombre" 			=> $this->nombre,
				"apellido" 			=> $this->apellido,
				"fechaNacimiento" 	=> $this->fechaNacimiento,
				"sexo" 				=> $this->sexo,
				"imagen" 			=> $this->imagen,
			);	

			}else{
				$sql = "UPDATE jugadoresBanca SET
								nombre  		= :nombre,
								apellido		= :apellido,
								fechaNacimiento = :fechaNacimiento,
								sexo 			= :sexo
						WHERE numCamiseta 		= :numCamiseta";
				$arraySQL = array(
					"numCamiseta" 		=> $this->numCamiseta,
					"nombre" 			=> $this->nombre,
					"apellido" 			=> $this->apellido,
					"fechaNacimiento" 	=> $this->fechaNacimiento,
					"sexo" 				=> $this->sexo,
				);	

		}

		
		$respuesta = $this->ejecutarConsulta($sql, $arraySQL);

		if($respuesta){
			$arrayRespuesta['codigo'] = "Exito";
			$arrayRespuesta['mensaje'] = "Se Edito al jugador correctamente";
		}else{
			$arrayRespuesta['codigo'] = "Error";
			$arrayRespuesta['mensaje'] = "Error al editar al jugador";
		}
		return $arrayRespuesta;

	}



	public function borrar(){
			
		$sql = "UPDATE jugadoresBanca SET estado = 0 WHERE numCamiseta = :numCamiseta";
		$arrayDatos = array("numCamiseta" => $this->numCamiseta);
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

		$sql = "SELECT count(*) as total FROM jugadoresBanca
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
