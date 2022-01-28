ALTER TABLE `contactowhatsapp` 
ADD COLUMN `estatus` INT NULL AFTER `fechaEnvio`,
ADD COLUMN `updated` DATETIME NULL AFTER `estatus`;
