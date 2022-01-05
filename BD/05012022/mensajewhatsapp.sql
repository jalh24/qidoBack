CREATE TABLE `mensajewhatsapp` (
  `idMensaje` int(11) NOT NULL AUTO_INCREMENT,
  `mensaje` text DEFAULT NULL,
  `fechaEnvio` timestamp NULL DEFAULT NULL,
  `fechaActualizacion` datetime DEFAULT NULL,
  PRIMARY KEY (`idMensaje`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
