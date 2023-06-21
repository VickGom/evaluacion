-- MySQL dump 10.13  Distrib 8.0.33, for Win64 (x86_64)
--
-- Host: localhost    Database: crud
-- ------------------------------------------------------
-- Server version	8.0.33

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `articulos`
--

DROP TABLE IF EXISTS `articulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `articulos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sku` int NOT NULL,
  `articulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marca` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modelo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `departamento` int NOT NULL,
  `clase` int NOT NULL,
  `familia` int NOT NULL,
  `stock` int NOT NULL,
  `cantidad` int NOT NULL,
  `descontinuado` int NOT NULL,
  `fechaDeAlta` date NOT NULL,
  `fechaBaja` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articulos`
--

LOCK TABLES `articulos` WRITE;
/*!40000 ALTER TABLE `articulos` DISABLE KEYS */;
INSERT INTO `articulos` VALUES (1,123456,'ejemploooo','ggpp','rtx',1,2,36,15,5,0,'2020-02-02','2020-04-04'),(3,123123,'ff','ff','ff',1,2,2,15,5,0,'2023-06-21','1900-01-01'),(5,2112,'master','master2','master2',1,1,1,20,10,0,'2023-06-21','1900-01-01');
/*!40000 ALTER TABLE `articulos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clases`
--

DROP TABLE IF EXISTS `clases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clases` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `numeroDepartamento` int NOT NULL,
  `numeroClase` int NOT NULL,
  `nombreClase` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clases`
--

LOCK TABLES `clases` WRITE;
/*!40000 ALTER TABLE `clases` DISABLE KEYS */;
INSERT INTO `clases` VALUES (1,1,1,'COMESTIBLES'),(2,1,2,'LICUADORAS'),(3,1,3,'BATIDORAS'),(4,1,4,'CAFETERAS'),(5,2,1,'AMPLIFICADORES CAR AUDIO'),(6,2,2,'AUTO STEREOS'),(7,3,1,'COLCHON'),(8,3,2,'JUEGO BOX'),(9,4,1,'SALAS'),(10,4,2,'COMPLEMENTO PARA SALAS'),(11,4,3,'SOFAS CAMA');
/*!40000 ALTER TABLE `clases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departamentos`
--

DROP TABLE IF EXISTS `departamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departamentos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombreDepartamento` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departamentos`
--

LOCK TABLES `departamentos` WRITE;
/*!40000 ALTER TABLE `departamentos` DISABLE KEYS */;
INSERT INTO `departamentos` VALUES (1,'DOMESTICOS'),(2,'ELECTRONICA'),(3,'MUEBLES SUELTO'),(4,'SALAS, RECAMARAS, COMEDORES');
/*!40000 ALTER TABLE `departamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `familias`
--

DROP TABLE IF EXISTS `familias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `familias` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `numeroClase` int NOT NULL,
  `numeroFamilia` int NOT NULL,
  `nombreFamilia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `familias`
--

LOCK TABLES `familias` WRITE;
/*!40000 ALTER TABLE `familias` DISABLE KEYS */;
INSERT INTO `familias` VALUES (1,1,0,'SIN NOMBRE'),(2,2,1,'LICUADORAS'),(3,2,2,'EXCLUSIVO COPPEL'),(4,3,1,'BATIDORA MANUAL'),(5,3,2,'PROCESADOR'),(6,3,3,'PICADORA'),(7,3,4,'BATIDORA PEDESTAL'),(8,3,5,'BATIDORA FUENTE DE SC'),(9,3,6,'MULTIPRACTICOS'),(10,3,7,'EXCLUSIVO COPPEL'),(11,4,1,'CAFETERAS'),(12,4,2,'PERCOLADORAS'),(13,1,1,'AMPLIFICADOR/RECEPTOR'),(14,1,2,'KIT DE INSTALACION'),(15,1,3,'AMPLIFICADORES COPPEL'),(16,2,1,'AUTOSTEREO CD C/BOD'),(17,2,2,'ACCESORIOS CAR AUDIO'),(18,2,3,'AMPLIFICADOR'),(19,2,4,'ALARMA AUTO/CASA/OFI'),(20,2,5,'SIN MECANISMO'),(21,2,6,'CON CD'),(22,2,7,'MULTIMEDIA'),(23,2,8,'PAQUETE SIN MECANISMO'),(24,2,9,'PAQUETE CON CD'),(25,1,1,'PILLOW TOP KS'),(26,1,2,'PILLOW TOP DOBLE KS'),(27,1,3,'HULE ESPUMA KS'),(28,2,1,'ESTANDAR INDIVIDUAL'),(29,2,2,'PILLOW TOP INDIVIDUAL'),(30,2,3,'PILLOW TOP DOBLE INDIVIDUAL'),(31,1,1,'ESQUINERAS SUPERIORES'),(32,1,2,'TIPO L SECCIONAL'),(33,2,1,'SILLON OCASIONAL'),(34,2,2,'PUFF'),(35,2,3,'BAUL'),(36,2,4,'TABURETE'),(37,3,1,'SOFA CAMA TAPIZADO CON'),(38,3,2,'SOFA CAMA CLASICO'),(39,3,3,'ESTUDIO');
/*!40000 ALTER TABLE `familias` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-21  9:19:52
