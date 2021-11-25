CREATE TABLE `colaboradorservicio` (
  `idServicio` int(11) DEFAULT NULL,
  `idColaborador` int(11) DEFAULT NULL,
  `fechaAsignacion` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;