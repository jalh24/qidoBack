CREATE TABLE `contactowhatsapp` (
  `idMensaje` int(11) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `fechaEnvio` varchar(45) DEFAULT NULL,
  KEY `mensaje_whatsappfk_idx` (`idMensaje`),
  CONSTRAINT `mensaje_whatsappfk` FOREIGN KEY (`idMensaje`) REFERENCES `mensajewhatsapp` (`idMensaje`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
