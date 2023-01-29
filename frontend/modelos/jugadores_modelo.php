<?php
	
	require_once("modelos/modelo_generico.php");

	class jugadores_modelo extends modelo_generico{

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


	public function listarBanca($filtros = array()){

		$sql = "SELECT * FROM jugadoresBanca WHERE estado = 1";
		
		$lista = $this->traerListado($sql);
		return $lista;

	}


	}


?>
