ALTER TABLE `optica421`.`op_historias` 
ADD COLUMN `historias_acudiente_responsable_v` VARCHAR(255) NULL DEFAULT NULL AFTER `historia_excavacion_oi_v`,
ADD COLUMN `historias_telefono_acudiente_responsable_v` VARCHAR(25) NULL DEFAULT NULL AFTER `historias_acudiente_responsable_v`,
ADD COLUMN `historia_prentesco_responsable_v` VARCHAR(255) NULL DEFAULT NULL AFTER `historias_telefono_acudiente_responsable_v`;
