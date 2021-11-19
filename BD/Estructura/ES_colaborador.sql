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
-- Table structure for table `colaborador`
--

DROP TABLE IF EXISTS `colaborador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `colaborador` (
  `idColaborador` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `a_paterno` varchar(50) DEFAULT NULL,
  `a_materno` varchar(45) DEFAULT NULL,
  `correoElectronico` varchar(120) DEFAULT NULL,
  `idGradoEstudio` int DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `idTipoTelefono` int DEFAULT NULL,
  `telefono2` varchar(10) DEFAULT NULL,
  `idTipoTelefono2` int DEFAULT NULL,
  `foto` blob,
  `fotoNombre` varchar(70) DEFAULT NULL,
  `idCalificacion` int DEFAULT NULL,
  `idTipoColaborador` int DEFAULT NULL,
  `observaciones` text,
  `rfc` varchar(15) DEFAULT NULL,
  `nss` varchar(20) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `idPaisNacimiento` int DEFAULT NULL,
  `idEstadoNacimiento` int DEFAULT NULL,
  `idCiudadNacimiento` int DEFAULT NULL,
  `comprobanteDomicilio` blob,
  `comprobanteNombre` varchar(70) DEFAULT NULL,
  `idSexo` int DEFAULT NULL,
  `peso` decimal(10,2) DEFAULT NULL,
  `estatura` double(10,2) DEFAULT NULL,
  `idEstadoCivil` int DEFAULT NULL,
  `idTez` int DEFAULT NULL,
  `sgmm` varchar(30) DEFAULT NULL,
  `atiendeCovid` bit(1) DEFAULT NULL,
  `antecedentePenales` bit(1) DEFAULT NULL,
  `autoPropio` bit(1) DEFAULT NULL,
  `dispuestoViajar` bit(1) DEFAULT NULL,
  `visa` bit(1) DEFAULT NULL,
  `visaNumero` varchar(45) DEFAULT NULL,
  `tipoVisa` varchar(45) DEFAULT NULL,
  `expiracionVisa` date DEFAULT NULL,
  `visaImagen` blob,
  `visaNombre` varchar(70) DEFAULT NULL,
  `pasaporte` bit(1) DEFAULT NULL,
  `pasaporteNumero` varchar(45) DEFAULT NULL,
  `expiracionPasaporte` date DEFAULT NULL,
  `pasaporteImagen` blob,
  `pasaporteNombre` varchar(70) DEFAULT NULL,
  `ine1` blob,
  `ine1Nombre` varchar(70) DEFAULT NULL,
  `ine2` blob,
  `ine2Nombre` varchar(70) DEFAULT NULL,
  `idPermanencia` int DEFAULT NULL,
  `idEstatus` int DEFAULT NULL,
  `calle1` varchar(100) DEFAULT NULL,
  `calle2` varchar(45) DEFAULT NULL,
  `codigoPostal` int DEFAULT NULL,
  `idPais` int DEFAULT NULL,
  `idEstado` int DEFAULT NULL,
  `idCiudad` int DEFAULT NULL,
  `idColonia` int DEFAULT NULL,
  `noExt` varchar(5) DEFAULT NULL,
  `noInt` varchar(5) DEFAULT NULL,
  `horario` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `especialidades` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `habilidades` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `hijos` bit(1) DEFAULT NULL,
  `hijosViven` bit(1) DEFAULT NULL,
  `hacerComer` bit(1) DEFAULT NULL,
  `limpiarUtensiliosCocina` bit(1) DEFAULT NULL,
  `limpiarDormitorio` bit(1) DEFAULT NULL,
  `limpiarBano` bit(1) DEFAULT NULL,
  `ayudaPaciente` bit(1) DEFAULT NULL,
  `licenciaManejar` bit(1) DEFAULT NULL,
  `fechaCreacion` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idColaborador`),
  KEY `colaborador_sexo_idx` (`idSexo`),
  KEY `colaborador_esciv_idx` (`idEstadoCivil`),
  KEY `colaborador_tez_idx` (`idTez`),
  KEY `colaborador_estatus_idx` (`idEstatus`),
  KEY `colaborador_pais_idx` (`idPais`),
  KEY `colaborador_estado_idx` (`idEstado`),
  KEY `colaborador_ciudad_idx` (`idCiudad`),
  KEY `colaborador_colonia_idx` (`idColonia`),
  CONSTRAINT `colaborador_ciudad` FOREIGN KEY (`idCiudad`) REFERENCES `ciudad` (`idCiudad`),
  CONSTRAINT `colaborador_colonia` FOREIGN KEY (`idColonia`) REFERENCES `colonia` (`idColonia`),
  CONSTRAINT `colaborador_esciv` FOREIGN KEY (`idEstadoCivil`) REFERENCES `estadocivilcat` (`idEstadoCivil`),
  CONSTRAINT `colaborador_estado` FOREIGN KEY (`idEstado`) REFERENCES `estado` (`idEstado`),
  CONSTRAINT `colaborador_estatus` FOREIGN KEY (`idEstatus`) REFERENCES `estatus` (`idEstatus`),
  CONSTRAINT `colaborador_pais` FOREIGN KEY (`idPais`) REFERENCES `pais` (`idPais`),
  CONSTRAINT `colaborador_sexo` FOREIGN KEY (`idSexo`) REFERENCES `sexocat` (`idSexo`),
  CONSTRAINT `colaborador_tez` FOREIGN KEY (`idTez`) REFERENCES `tezcat` (`idTez`),
  CONSTRAINT `colaborador_chk_1` CHECK (json_valid(`horario`))
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-11-19 10:12:29
