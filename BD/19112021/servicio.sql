-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2021 at 05:59 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qido`
--

-- --------------------------------------------------------

--
-- Table structure for table `servicio`
--

CREATE TABLE `servicio` (
  `idServicio` int(11) NOT NULL,
  `cliente` int(11) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `a_paterno` varchar(50) DEFAULT NULL,
  `a_materno` varchar(45) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `idPaisNacimiento` int(11) DEFAULT NULL,
  `idEstadoNacimiento` int(11) DEFAULT NULL,
  `idCiudadNacimiento` int(11) DEFAULT NULL,
  `calle1` varchar(100) DEFAULT NULL,
  `calle2` varchar(45) DEFAULT NULL,
  `noExt` varchar(5) DEFAULT NULL,
  `noInt` varchar(5) DEFAULT NULL,
  `codigoPostal` int(11) DEFAULT NULL,
  `idColonia` int(11) DEFAULT NULL,
  `idCiudad` int(11) DEFAULT NULL,
  `idEstado` int(11) DEFAULT NULL,
  `idPais` int(11) DEFAULT NULL,
  `referenciaDireccion` text DEFAULT NULL,
  `idSexo` int(11) DEFAULT NULL,
  `idComplexion` int(11) DEFAULT NULL,
  `peso` decimal(10,2) DEFAULT NULL,
  `estatura` double(10,2) DEFAULT NULL,
  `idEstadoCivil` int(11) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `idTipoTelefono` int(11) DEFAULT NULL,
  `correoElectronico` varchar(120) DEFAULT NULL,
  `idParentesco` int(11) DEFAULT NULL,
  `nombreMedico` varchar(50) DEFAULT NULL,
  `especialidadMedico` varchar(50) DEFAULT NULL,
  `telefonoMedico` varchar(10) DEFAULT NULL,
  `correoElectronicoMedico` varchar(120) DEFAULT NULL,
  `enfermedades` text DEFAULT NULL,
  `procedimientos` text DEFAULT NULL,
  `medicamentos` text DEFAULT NULL,
  `notas` text DEFAULT NULL,
  `tieneCovid` bit(1) DEFAULT NULL,
  `tieneAlzheimer` bit(1) DEFAULT NULL,
  `movimiento` bit(1) DEFAULT NULL,
  `idTipoServicio` int(11) DEFAULT NULL,
  `idResponsable` int(11) DEFAULT NULL,
  `precioServicio` decimal(10,2) DEFAULT NULL,
  `cantidadPagada` decimal(10,2) DEFAULT NULL,
  `cantidadPorPagar` decimal(10,2) DEFAULT NULL,
  `colabReq` int(11) DEFAULT NULL,
  `estatus` varchar(45) DEFAULT NULL,
  `fechaCreacion` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`idServicio`),
  ADD KEY `servicio_sexo_idx` (`idSexo`),
  ADD KEY `servicio_esciv_idx` (`idEstadoCivil`),
  ADD KEY `servicio_pais_idx` (`idPais`),
  ADD KEY `servicio_estado_idx` (`idEstado`),
  ADD KEY `servicio_ciudad_idx` (`idCiudad`),
  ADD KEY `servicio_colonia_idx` (`idColonia`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `servicio`
--
ALTER TABLE `servicio`
  MODIFY `idServicio` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `servicio`
--
ALTER TABLE `servicio`
  ADD CONSTRAINT `servicio_ciudad` FOREIGN KEY (`idCiudad`) REFERENCES `ciudad` (`idCiudad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `servicio_colonia` FOREIGN KEY (`idColonia`) REFERENCES `colonia` (`idColonia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `servicio_esciv` FOREIGN KEY (`idEstadoCivil`) REFERENCES `estadocivilcat` (`idEstadoCivil`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `servicio_estado` FOREIGN KEY (`idEstado`) REFERENCES `estado` (`idEstado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `servicio_pais` FOREIGN KEY (`idPais`) REFERENCES `pais` (`idPais`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `servicio_sexo` FOREIGN KEY (`idSexo`) REFERENCES `sexocat` (`idSexo`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
