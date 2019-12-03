CREATE TABLE `optica421`.`op_nota_historia` (
  `nota_historia_id` INT NOT NULL AUTO_INCREMENT,
  `nota_historia_historias_id_i` INT NULL,
  `nota_historia_fecha` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `nota_historia_nota` TEXT NULL,
  `nota_historia_usuario_id` INT NULL,
  `nota_historia_acompanante_nombre` VARCHAR(255) NULL DEFAULT NULL,
  `nota_historia_acompanante_parentesco` VARCHAR(255) NULL DEFAULT NULL,
  `nota_historia_acompanante_telefono` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`nota_historia_id`));
