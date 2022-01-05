SET FOREIGN_KEY_CHECKS=0;
UPDATE `estado` SET `idEstado` = '33' WHERE (`idEstado` = '5');
UPDATE `estado` SET `idEstado` = '5' WHERE (`idEstado` = '7');
UPDATE `estado` SET `idEstado` = '7' WHERE (`idEstado` = '33');
SET FOREIGN_KEY_CHECKS=1;