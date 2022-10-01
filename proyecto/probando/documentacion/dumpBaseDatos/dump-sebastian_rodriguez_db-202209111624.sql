-- MySQL dump 10.13  Distrib 5.5.62, for Win64 (AMD64)
--
-- Host: localhost    Database: sebastian_rodriguez_db
-- ------------------------------------------------------
-- Server version	5.7.33

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `administradores`
--

DROP TABLE IF EXISTS `administradores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `administradores` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `mail` text,
  `clave` varchar(100) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administradores`
--

LOCK TABLES `administradores` WRITE;
/*!40000 ALTER TABLE `administradores` DISABLE KEYS */;
INSERT INTO `administradores` VALUES (1,'Admin','mail@mail.com','fbc71ce36cc20790f2eeed2197898e71',1),(2,'asd','asdadsa@gmail.com','7815696ecbf1c96e6894b779456d330e',0);
/*!40000 ALTER TABLE `administradores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoriasnoticias`
--

DROP TABLE IF EXISTS `categoriasnoticias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoriasnoticias` (
  `nombre` varchar(50) DEFAULT NULL,
  `codigo` int(5) NOT NULL AUTO_INCREMENT,
  `estado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoriasnoticias`
--

LOCK TABLES `categoriasnoticias` WRITE;
/*!40000 ALTER TABLE `categoriasnoticias` DISABLE KEYS */;
INSERT INTO `categoriasnoticias` VALUES ('Fichajes',1,1),('Entrevistas',2,1),('probando',3,0),('Ultimas Noticias',4,1);
/*!40000 ALTER TABLE `categoriasnoticias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacto`
--

DROP TABLE IF EXISTS `contacto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacto` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `tema` varchar(50) DEFAULT NULL,
  `mensaje` tinytext,
  `estado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacto`
--

LOCK TABLES `contacto` WRITE;
/*!40000 ALTER TABLE `contacto` DISABLE KEYS */;
INSERT INTO `contacto` VALUES (1,'asdadasd','asdadsa@gmail.com','asdasdas','dasdasdasd',1),(2,'asdadasd','asdasdasd@gmail.com','asdadasd','asdadsad',1),(3,'awdawdawd','asdadsa@gmail.com','awdawd','awdawdawdawd',0),(4,'probando','asdadsa@gmail.com','asdasd','adsada',1);
/*!40000 ALTER TABLE `contacto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jugadoresbanca`
--

DROP TABLE IF EXISTS `jugadoresbanca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jugadoresbanca` (
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  `sexo` varchar(10) DEFAULT NULL,
  `numCamiseta` int(2) NOT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `imagen` char(36) DEFAULT NULL,
  PRIMARY KEY (`numCamiseta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jugadoresbanca`
--

LOCK TABLES `jugadoresbanca` WRITE;
/*!40000 ALTER TABLE `jugadoresbanca` DISABLE KEYS */;
INSERT INTO `jugadoresbanca` VALUES ('Dean','Henderson','1997-03-12','Masculino',1,1,'631a6dbb8fcd7.jpg'),('Victor','Lindelof','1994-07-17','Masculino',2,1,'631a41d20ec35.jpg'),('Phill','Jones','1992-02-21','Masculino',4,1,'631a6ddd3c1f2.jpg'),('Anthony','Martial','1995-12-05','Masculino',9,1,'631a6e31967cf.jpg'),('Amad','Diallo','2002-07-11','Masculino',16,1,'631a6dfceb41c.jpg');
/*!40000 ALTER TABLE `jugadoresbanca` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `noticias`
--

DROP TABLE IF EXISTS `noticias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `noticias` (
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `noticias`
--

LOCK TABLES `noticias` WRITE;
/*!40000 ALTER TABLE `noticias` DISABLE KEYS */;
INSERT INTO `noticias` VALUES ('Cristiano Ronaldo ficha por el Manchester United!','2022-09-08','631a1e9176410.jpg',1,'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum tempore, sequi tenetur quam perferendis a consequatur ut animi aliquam recusandae possimus illum! Quos sit veniam vel. In voluptas modi labore nihil pariatur molestias, ad molestiae quod asperiores iusto minima alias. Aut quisquam distinctio nemo dolore magni ea! Quod ea eum, exercitationem pariatur numquam esse ','sit amet vel expedita dignissimos magnam porro dolore reiciendis quis minus, dolores accusamus nihil! Corrupti, adipisci consectetur necessitatibus quaerat quae aspernatur doloribus sunt laboriosam, cupiditate fuga hic modi dignissimos omnis sapiente quasi similique ratione quibusdam dolore accusantium id architecto at repellat? Autem iste dicta animi accusamus?',1,1),('Las palabras de De gea frente al ultimo partido','2022-09-08','631a1e8910b71.jpg',1,'sit amet vel expedita dignissimos magnam porro dolore reiciendis quis minus, dolores accusamus nihil! Corrupti, adipisci consectetur necessitatibus quaerat quae aspernatur doloribus sunt laboriosam, cupiditate fuga hic modi dignissimos omnis sapiente quasi similique ratione quibusdam dolore accusantium id architecto at repellat? Autem iste dicta animi accusamus?','sit amet vel expedita dignissimos magnam porro dolore reiciendis quis minus, dolores accusamus nihil! Corrupti, adipisci consectetur necessitatibus quaerat quae aspernatur doloribus sunt laboriosam, cupiditate fuga hic modi dignissimos omnis sapiente quasi similique ratione quibusdam dolore accusantium id architecto at repellat? Autem iste dicta animi accusamus?',2,1),('Cristiano Ronaldo ficha por el Manchester United!','2022-09-08','631a2047c1455.jpg',1,'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Totam porro quis minus nobis atque dolores ratione, nam soluta assumenda dolorum tempora eaque nesciunt quo esse non nemo similique accusamus mollitia, recusandae, iure laboriosam minima modi? Perferendis earum alias iusto necessitatibus eveniet id consectetur hic autem. Provident porro asperiores soluta saepe.','Lorem ipsum dolor, sit amet consectetur adipisicing elit. Totam porro quis minus nobis atque dolores ratione, nam soluta assumenda dolorum tempora eaque nesciunt quo esse non nemo similique accusamus mollitia, recusandae, iure laboriosam minima modi? Perferendis earum alias iusto necessitatibus eveniet id consectetur hic autem. Provident porro asperiores soluta saepe.',3,0),('Las palabras de De gea frente al ultimo partido','2022-09-08','631a20592328a.jpg',2,'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Totam porro quis minus nobis atque dolores ratione, nam soluta assumenda dolorum tempora eaque nesciunt quo esse non nemo similique accusamus mollitia, recusandae, iure laboriosam minima modi? Perferendis earum alias iusto necessitatibus eveniet id consectetur hic autem. Provident porro asperiores soluta saepe.','Lorem ipsum dolor, sit amet consectetur adipisicing elit. Totam porro quis minus nobis atque dolores ratione, nam soluta assumenda dolorum tempora eaque nesciunt quo esse non nemo similique accusamus mollitia, recusandae, iure laboriosam minima modi? Perferendis earum alias iusto necessitatibus eveniet id consectetur hic autem. Provident porro asperiores soluta saepe.',4,1),('Casemiro apunta al manchester united','2022-09-08','631a4087bbfc3.jpg',4,'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Magnam asperiores placeat non libero rerum accusamus eveniet impedit corporis aut voluptatibus totam architecto maiores, ad provident fuga reiciendis debitis illo, exercitationem vitae ab repudiandae consectetur? Maiores qui saepe delectus deleniti minima possimus quo numquam magni velit, maxime similique natus, reprehenderit beatae!','Lorem ipsum dolor, sit amet consectetur adipisicing elit. Magnam asperiores placeat non libero rerum accusamus eveniet impedit corporis aut voluptatibus totam architecto maiores, ad provident fuga reiciendis debitis illo, exercitationem vitae ab repudiandae consectetur? Maiores qui saepe delectus deleniti minima possimus quo numquam magni velit, maxime similique natus, reprehenderit beatae!',5,1);
/*!40000 ALTER TABLE `noticias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `mail` text,
  `clave` varchar(100) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'sebastian_rodriguez_db'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-09-11 16:24:06
