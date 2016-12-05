
-- -----------------------------------------------------
-- Table `daw2_actividades`.`configuracion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `daw2_actividades`.`configuracion` ;
CREATE TABLE IF NOT EXISTS `configuracion` (
  `campo` varchar(50) NOT NULL,
  `valor` TEXT NOT NULL,
  PRIMARY KEY (`campo`)
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Volcado de datos para la tabla `configuracion`
-- -----------------------------------------------------
INSERT INTO `configuracion` (`campo`, `valor`) VALUES
('LineasPagina', '10'),
('LineasPagina.Portada', '15'),
('LineasPagina.Avisos', '50');
