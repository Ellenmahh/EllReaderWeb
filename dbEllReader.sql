-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: localhost    Database: dbellreader
-- ------------------------------------------------------
-- Server version	5.6.10-log

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
-- Table structure for table `tblfavoritos`
--

DROP TABLE IF EXISTS `tblfavoritos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblfavoritos` (
  `idFavorito` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) NOT NULL,
  `idLivro` int(11) NOT NULL,
  `favoritos` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`idFavorito`),
  KEY `idUsuario_idx` (`idUsuario`),
  KEY `idLivro_idx` (`idLivro`),
  CONSTRAINT `idLivro` FOREIGN KEY (`idLivro`) REFERENCES `tbllivro` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `idUsuario` FOREIGN KEY (`idUsuario`) REFERENCES `tbllogin` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblfavoritos`
--

LOCK TABLES `tblfavoritos` WRITE;
/*!40000 ALTER TABLE `tblfavoritos` DISABLE KEYS */;
INSERT INTO `tblfavoritos` VALUES (1,1,3,1),(3,2,10,1),(23,2,4,0),(24,2,3,1),(25,2,2,1);
/*!40000 ALTER TABLE `tblfavoritos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblgenero`
--

DROP TABLE IF EXISTS `tblgenero`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblgenero` (
  `idgenero` int(11) NOT NULL AUTO_INCREMENT,
  `genero` varchar(45) NOT NULL,
  PRIMARY KEY (`idgenero`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblgenero`
--

LOCK TABLES `tblgenero` WRITE;
/*!40000 ALTER TABLE `tblgenero` DISABLE KEYS */;
INSERT INTO `tblgenero` VALUES (1,'aventura'),(2,'drama'),(3,'ficção científica'),(4,'romance'),(5,'terror');
/*!40000 ALTER TABLE `tblgenero` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbllivro`
--

DROP TABLE IF EXISTS `tbllivro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbllivro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `capa` varchar(45) NOT NULL,
  `titulo` varchar(45) NOT NULL,
  `pdf` varchar(100) NOT NULL,
  `idgenero` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idgenero_idx` (`idgenero`),
  CONSTRAINT `idgenero` FOREIGN KEY (`idgenero`) REFERENCES `tblgenero` (`idgenero`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbllivro`
--

LOCK TABLES `tbllivro` WRITE;
/*!40000 ALTER TABLE `tbllivro` DISABLE KEYS */;
INSERT INTO `tbllivro` VALUES (2,'capas/ruby.png','Ruby o guia comovente','livros/ruby.pdf',2),(3,'capas/php.png','Curso da Linguagem PHP','livros/php.pdf',1),(4,'capas/funda.jpg','Fundamentos de Banco de dados','livros/fundamentos.pdf',4),(10,'capas/banco.jpg','Banco de dados','livros/apostilabd.pdf',4),(11,'capas/android.png','Apostila Android ','livros/apostila-android.pdf',5);
/*!40000 ALTER TABLE `tbllivro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbllogin`
--

DROP TABLE IF EXISTS `tbllogin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbllogin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` text,
  `senha` int(11) DEFAULT NULL,
  `email` text,
  `telefone` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbllogin`
--

LOCK TABLES `tbllogin` WRITE;
/*!40000 ALTER TABLE `tbllogin` DISABLE KEYS */;
INSERT INTO `tbllogin` VALUES (1,'teste',123,'use@mail','45612374'),(2,'asd',321,'asd@aaa','224455');
/*!40000 ALTER TABLE `tbllogin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'dbellreader'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-31 15:57:04
