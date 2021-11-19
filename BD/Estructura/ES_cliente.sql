-- MySQL dump 10.13  Distrib 8.0.26, for Win64 (x86_64)
--
-- Host: localhost    Database: quinoDev
-- ------------------------------------------------------
-- Server version	8.0.25-0ubuntu0.20.10.1

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
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cliente` (
  `idCliente` int NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `a_paterno` varchar(60) DEFAULT NULL,
  `a_materno` varchar(60) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `rfc` varchar(11) DEFAULT NULL,
  `idPaisNacimiento` int DEFAULT NULL,
  `idEstadoNacimiento` int DEFAULT NULL,
  `idCiudadNacimiento` int DEFAULT NULL,
  `calle1` varchar(100) DEFAULT NULL,
  `calle2` varchar(100) DEFAULT NULL,
  `noExt` int DEFAULT NULL,
  `noInt` int DEFAULT NULL,
  `idColonia` int DEFAULT NULL,
  `idCiudad` int DEFAULT NULL,
  `idEstado` int DEFAULT NULL,
  `idPais` int DEFAULT NULL,
  `codigoPostal` int DEFAULT NULL,
  `referencia` text,
  `idSexo` int DEFAULT NULL,
  `imss` int DEFAULT NULL,
  `sgmm` int DEFAULT NULL,
  `idComplexion` int DEFAULT NULL,
  `peso` int DEFAULT NULL,
  `estatura` int DEFAULT NULL,
  `idEstadoCivil` int DEFAULT NULL,
  `telefono` int DEFAULT NULL,
  `idTipoTelefono` int DEFAULT NULL,
  `telefono2` int DEFAULT NULL,
  `idTipoTelefono2` int DEFAULT NULL,
  `correoElectronico` varchar(80) DEFAULT NULL,
  `nombreContacto` varchar(100) DEFAULT NULL,
  `idParentescoContacto` int DEFAULT NULL,
  `telefonoContacto` int DEFAULT NULL,
  `correoContacto` varchar(60) DEFAULT NULL,
  `nombreContacto2` varchar(100) DEFAULT NULL,
  `idParentescoContacto2` int DEFAULT NULL,
  `telefonoContacto2` int DEFAULT NULL,
  `correoContacto2` varchar(60) DEFAULT NULL,
  `nombreMedico` varchar(100) DEFAULT NULL,
  `especialidadesMedico` varchar(80) DEFAULT NULL,
  `telefonoMedico` int DEFAULT NULL,
  `correoMedico` varchar(60) DEFAULT NULL,
  `enfermedadesActuales` text,
  `enfermedadesRecientes` text,
  `cirugiasRecientes` text,
  `accidentesRecientes` text,
  `alzheimer` tinyint(1) DEFAULT NULL,
  `fechaCreacion` date DEFAULT NULL,
  `idTipoCliente` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-11-19 10:13:22
