<?php

require_once("consola/consola.php");
require_once("modelos/administradores_modelo.php");


	class instalador extends consola{
	
	public function arrancar(){

		parent::arrancar();

		$this->instalar();

		return "ok";
	}

	public function instalar(){

	$arraySQL = array();
	$arraySQL[] = "
			SET FOREIGN_KEY_CHECKS=0;
			DROP TABLE IF EXISTS noticias;
			DROP TABLE IF EXISTS jugadoresBanca;
			DROP TABLE IF EXISTS administradores;
			DROP TABLE IF EXISTS categoriasnoticias;
			DROP TABLE IF EXISTS contacto;
			DROP TABLE IF EXISTS usuarios;
			SET FOREIGN_KEY_CHECKS=1;
	";

		$arraySQL[] = "CREATE TABLE `jugadoresBanca` (
				`nombre` varchar(50) DEFAULT NULL,
				`apellido` varchar(50) DEFAULT NULL,
				`fechaNacimiento` date DEFAULT NULL,
				`sexo` varchar(10) DEFAULT NULL,
				`numCamiseta` int(2) NOT NULL,
				`estado` tinyint(1) DEFAULT NULL,
				`imagen` char(36) DEFAULT NULL,
				PRIMARY KEY (`numCamiseta`)
				);";

		$arraySQL[] = "CREATE TABLE `administradores` (
						`id` int(5) NOT NULL AUTO_INCREMENT,
						`nombre` varchar(50) DEFAULT NULL,
						`mail` text,
						`clave` varchar(100) DEFAULT NULL,
						`estado` tinyint(1) DEFAULT NULL,
						PRIMARY KEY (`id`)
					);";

		$arraySQL[] = "CREATE TABLE `contacto` (
			`id` int(5) NOT NULL AUTO_INCREMENT,
			`nombre` varchar(50) DEFAULT NULL,
			`email` varchar(50) NOT NULL,
			`tema` varchar(50) DEFAULT NULL,
			`mensaje` tinytext,
			`estado` tinyint(1) DEFAULT NULL,
			PRIMARY KEY (`id`)
		  )";

		$arraySQL[] = "CREATE TABLE `usuarios` (
			`id` int(5) NOT NULL AUTO_INCREMENT,
			`nombre` varchar(50) DEFAULT NULL,
			`mail` text,
			`clave` varchar(100) DEFAULT NULL,
			`estado` tinyint(1) DEFAULT NULL,
			PRIMARY KEY (`id`)
		);";


		$arraySQL[] = "CREATE TABLE `categoriasnoticias` (
			`nombre` varchar(50) DEFAULT NULL,
			`codigo` int(5) NOT NULL AUTO_INCREMENT,
			`estado` tinyint(1) DEFAULT NULL,
			PRIMARY KEY (`codigo`)
		  )";

		$arraySQL[] = "CREATE TABLE `noticias` (
			`titulo` varchar(100) DEFAULT NULL,
			`fechaPublicacion` date DEFAULT NULL,
			`imagen` varchar(50) DEFAULT NULL,
			`categoriaNoticia` int(5) DEFAULT NULL,
			`descripcion1` text,
			`descripcion2` text,
			`id` int(5) NOT NULL AUTO_INCREMENT,
			`estado` tinyint(1) DEFAULT NULL,
			PRIMARY KEY (`id`),
			KEY `not_categoriaNoticia` (`categoriaNoticia`),
			CONSTRAINT `cur_categoriaNoticia_fk1` FOREIGN KEY (`categoriaNoticia`) REFERENCES `categoriasnoticias` (`codigo`)
		  )";

		$arraySQL[] = "INSERT INTO administradores (nombre,mail,clave,estado) VALUES
		('Admin','mail@mail.com','fbc71ce36cc20790f2eeed2197898e71',1);";
	   

	   $arraySQL[] = "INSERT INTO jugadoresbanca (nombre,apellido,fechaNacimiento,sexo,numCamiseta,estado,imagen) VALUES
								('Dean','Henderson','1997-03-12','Masculino',1,1,'631e395117637.jpg'),
								('Victor','Lindelof','1994-07-17','Masculino',2,1,'631e39561a29a.jpg'),
								('Phill','Jones','1992-02-21','Masculino',4,1,'631e395cd6351.jpg'),
								('Anthony','Martial','1995-12-05','Masculino',9,1,'631e3965cf7f6.jpg'),
								('Amad','Diallo','2002-07-11','Masculino',16,1,'631e396cc568b.jpg');";

		$arraySQL[] = "INSERT INTO contacto (nombre,email,tema,mensaje,estado) VALUES
		('asdadasd','asdadsa@gmail.com','asdasdas','dasdasdasd',1),
		('asdadasd','asdasdasd@gmail.com','asdadasd','asdadsad',1);
		";


		$arraySQL[] = "INSERT INTO categoriasnoticias (nombre,estado) VALUES
							('Fichajes',1),
							('Entrevistas',1),
							('probando',0),
							('Ultimas Noticias',1);";	

		$arraySQL[] = "INSERT INTO noticias (titulo,fechaPublicacion,imagen,categoriaNoticia,descripcion1,descripcion2,estado) VALUES
		('Cristiano Ronaldo ficha por el Manchester United!','2022-09-08','631e392572777.jpg',1,'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum tempore, sequi tenetur quam perferendis a consequatur ut animi aliquam recusandae possimus illum! Quos sit veniam vel. In voluptas modi labore nihil pariatur molestias, ad molestiae quod asperiores iusto minima alias. Aut quisquam distinctio nemo dolore magni ea! Quod ea eum, exercitationem pariatur numquam esse ','sit amet vel expedita dignissimos magnam porro dolore reiciendis quis minus, dolores accusamus nihil! Corrupti, adipisci consectetur necessitatibus quaerat quae aspernatur doloribus sunt laboriosam, cupiditate fuga hic modi dignissimos omnis sapiente quasi similique ratione quibusdam dolore accusantium id architecto at repellat? Autem iste dicta animi accusamus?',1),
		('Las palabras de De gea frente al ultimo partido','2022-09-08','631e392d35d1c.jpg',1,'sit amet vel expedita dignissimos magnam porro dolore reiciendis quis minus, dolores accusamus nihil! Corrupti, adipisci consectetur necessitatibus quaerat quae aspernatur doloribus sunt laboriosam, cupiditate fuga hic modi dignissimos omnis sapiente quasi similique ratione quibusdam dolore accusantium id architecto at repellat? Autem iste dicta animi accusamus?','sit amet vel expedita dignissimos magnam porro dolore reiciendis quis minus, dolores accusamus nihil! Corrupti, adipisci consectetur necessitatibus quaerat quae aspernatur doloribus sunt laboriosam, cupiditate fuga hic modi dignissimos omnis sapiente quasi similique ratione quibusdam dolore accusantium id architecto at repellat? Autem iste dicta animi accusamus?',1),
		('Cristiano Ronaldo ficha por el Manchester United!','2022-09-08','631a2047c1455.jpg',1,'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Totam porro quis minus nobis atque dolores ratione, nam soluta assumenda dolorum tempora eaque nesciunt quo esse non nemo similique accusamus mollitia, recusandae, iure laboriosam minima modi? Perferendis earum alias iusto necessitatibus eveniet id consectetur hic autem. Provident porro asperiores soluta saepe.','Lorem ipsum dolor, sit amet consectetur adipisicing elit. Totam porro quis minus nobis atque dolores ratione, nam soluta assumenda dolorum tempora eaque nesciunt quo esse non nemo similique accusamus mollitia, recusandae, iure laboriosam minima modi? Perferendis earum alias iusto necessitatibus eveniet id consectetur hic autem. Provident porro asperiores soluta saepe.',0),
		('Las palabras de De gea frente al ultimo partido','2022-09-08','631e3935ef01c.jpg',1,'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Totam porro quis minus nobis atque dolores ratione, nam soluta assumenda dolorum tempora eaque nesciunt quo esse non nemo similique accusamus mollitia, recusandae, iure laboriosam minima modi? Perferendis earum alias iusto necessitatibus eveniet id consectetur hic autem. Provident porro asperiores soluta saepe.','Lorem ipsum dolor, sit amet consectetur adipisicing elit. Totam porro quis minus nobis atque dolores ratione, nam soluta assumenda dolorum tempora eaque nesciunt quo esse non nemo similique accusamus mollitia, recusandae, iure laboriosam minima modi? Perferendis earum alias iusto necessitatibus eveniet id consectetur hic autem. Provident porro asperiores soluta saepe.',1),
		('Casemiro apunta al manchester united','2022-09-08','631e393e1e345.jpg',1,'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Magnam asperiores placeat non libero rerum accusamus eveniet impedit corporis aut voluptatibus totam architecto maiores, ad provident fuga reiciendis debitis illo, exercitationem vitae ab repudiandae consectetur? Maiores qui saepe delectus deleniti minima possimus quo numquam magni velit, maxime similique natus, reprehenderit beatae!','Lorem ipsum dolor, sit amet consectetur adipisicing elit. Magnam asperiores placeat non libero rerum accusamus eveniet impedit corporis aut voluptatibus totam architecto maiores, ad provident fuga reiciendis debitis illo, exercitationem vitae ab repudiandae consectetur? Maiores qui saepe delectus deleniti minima possimus quo numquam magni velit, maxime similique natus, reprehenderit beatae!',1);   
   
	";

			foreach($arraySQL as $sql){
				print_r($sql);
				$this->ejecutarConsulta($sql);	
			}



	}


	}



?>
