-- MySQL Workbench Synchronization
-- Generated: 2017-01-16 18:33
-- Model: DAW2-Actividades
-- Version: 1.0
-- Project: EPSZ-DAW2_Actividades
-- Author: Dionisio Tomás R.B.
-- Proyecto en Grupo - Actividades y Eventos.
-- Desarrollo de Aplicaciones Web II.
-- Escuela Politécnica Superior de Zamora.
-- Universidad de Salamanca.
--

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

ALTER TABLE `daw2_actividades`.`actividad_comentarios` 
ADD INDEX `fk_actividad_comentarios_actividades_idx` (`actividad_id` ASC),
ADD INDEX `fk_actividad_comentarios_usuarios_1_idx` (`crea_usuario_id` ASC),
ADD INDEX `fk_actividad_comentarios_usuarios_modi_idx` (`modi_usuario_id` ASC),
ADD INDEX `fk_actividad_comentarios_parent_idx` (`comentario_id` ASC);

ALTER TABLE `daw2_actividades`.`actividad_etiquetas` 
ADD INDEX `fk_actividad_etiquetas_actividades_idx` (`actividad_id` ASC),
ADD INDEX `fk_actividad_etiquetas_etiquetas_idx` (`etiqueta_id` ASC);

ALTER TABLE `daw2_actividades`.`actividad_imagenes` 
ADD INDEX `fk_actividad_imagenes_actividades_idx` (`actividad_id` ASC);

ALTER TABLE `daw2_actividades`.`actividad_participantes` 
ADD INDEX `fk_actividad_participantes_actividades_idx` (`actividad_id` ASC),
ADD INDEX `fk_actividad_participantes_usuarios_idx` (`usuario_id` ASC);

ALTER TABLE `daw2_actividades`.`actividad_seguimientos` 
ADD INDEX `fk_actividad_seguimientos_actividades_idx` (`actividad_id` ASC),
ADD INDEX `fk_actividad_seguimientos_usuarios_idx` (`usuario_id` ASC);

ALTER TABLE `daw2_actividades`.`actividades` 
ADD INDEX `fk_actividades_areas_idx` (`area_id` ASC);

ALTER TABLE `daw2_actividades`.`clasificacion_etiquetas` 
ADD INDEX `fk_clasificacion_etiquetas_etiquetas_idx` (`etiqueta_id` ASC),
ADD INDEX `fk_clasificacion_etiquetas_clasificaciones_idx` (`clasificacion_id` ASC),
ADD INDEX `fk_clasificacion_etiquetas_parent_idx` (`clasificacion_etiqueta_id` ASC);

ALTER TABLE `daw2_actividades`.`usuario_avisos` 
ADD INDEX `fk_usuario_avisos_usuarios_dest_idx` (`destino_usuario_id` ASC),
ADD INDEX `fk_usuario_avisos_usuarios_origen_idx` (`origen_usuario_id` ASC),
ADD INDEX `fk_usuario_avisos_actividades_idx` (`actividad_id` ASC),
ADD INDEX `fk_usuario_avisos_comentarios_idx` (`comentario_id` ASC);

ALTER TABLE `daw2_actividades`.`usuarios` 
ADD INDEX `fk_usuarios_areas_idx` (`area_id` ASC);

ALTER TABLE `daw2_actividades`.`areas` 
CHANGE COLUMN `id` `id` INT(12) UNSIGNED NOT NULL AUTO_INCREMENT ,
ADD INDEX `fk_areas_areas_idx` (`area_id` ASC);

ALTER TABLE `daw2_actividades`.`actividad_patrocinios` 
CHANGE COLUMN `id` `id` INT(12) UNSIGNED NOT NULL AUTO_INCREMENT ,
ADD INDEX `fk_patrocinios_actividades_idx` (`actividad_id` ASC),
ADD INDEX `fk_patrocinios_anuncios_idx` (`anuncio_id` ASC);

ALTER TABLE `daw2_actividades`.`anuncios` 
CHANGE COLUMN `id` `id` INT(12) UNSIGNED NOT NULL AUTO_INCREMENT ,
ADD INDEX `fk_anuncios_usuarios_idx` (`crea_usuario_id` ASC),
ADD INDEX `fk_anuncios_usuarios_modi_idx` (`modi_usuario_id` ASC);

ALTER TABLE `daw2_actividades`.`usuarios_area_moderacion` 
CHANGE COLUMN `id` `id` INT(12) UNSIGNED NOT NULL AUTO_INCREMENT ,
ADD INDEX `fk_usuarios_area_usuarios_idx` (`usuario_id` ASC),
ADD INDEX `fk_usuarios_area_areas_idx` (`area_id` ASC);

ALTER TABLE `daw2_actividades`.`anuncios_etiquetas` 
ADD INDEX `fk_anuncios_etiquetas_anuncios_idx` (`anuncio_id` ASC),
ADD INDEX `fk_actividad_etiquetas_etiquetas_idx` (`etiqueta_id` ASC);

ALTER TABLE `daw2_actividades`.`logs` 
CHANGE COLUMN `id` `id` INT(12) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE COLUMN `fecha` `fecha` DATETIME NOT NULL COMMENT 'Fecha y Hora del mensaje de LOG.' ;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
