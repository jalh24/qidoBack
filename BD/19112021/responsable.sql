CREATE TABLE `responsable` (
  `idResponsable` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idResponsable`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `responsable` (`idResponsable`, `nombre`) VALUES
(1, 'Jesus Viramontes'),
(2, 'Veronica Viramontes');