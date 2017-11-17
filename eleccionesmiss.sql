-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema eleccionmiss
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema eleccionmiss
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `eleccionmiss` DEFAULT CHARACTER SET utf8 ;
USE `eleccionmiss` ;

-- -----------------------------------------------------
-- Table `eleccionmiss`.`jurado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `eleccionmiss`.`jurado` (
  `idjurado` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(255) NOT NULL DEFAULT 'jurado',
  `estado` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idjurado`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `eleccionmiss`.`pasarela`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `eleccionmiss`.`pasarela` (
  `idpasarela` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(255) NOT NULL,
  `ponderacion` DECIMAL(5,2) NOT NULL,
  PRIMARY KEY (`idpasarela`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `eleccionmiss`.`participante`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `eleccionmiss`.`participante` (
  `idparticipante` INT NOT NULL AUTO_INCREMENT,
  `apellidos` VARCHAR(255) NOT NULL,
  `nombres` VARCHAR(255) NOT NULL,
  `hobies` TEXT NULL,
  PRIMARY KEY (`idparticipante`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `eleccionmiss`.`calificacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `eleccionmiss`.`calificacion` (
  `idcalificacion` INT NOT NULL AUTO_INCREMENT,
  `calificacion` INT NOT NULL DEFAULT 0,
  `idjurado` INT NOT NULL,
  `idparticipante` INT NOT NULL,
  `idpasarela` INT NOT NULL,
  PRIMARY KEY (`idcalificacion`),
  INDEX `fk_calificacion_jurado_idx` (`idjurado` ASC),
  INDEX `fk_calificacion_participante1_idx` (`idparticipante` ASC),
  INDEX `fk_calificacion_pasarela1_idx` (`idpasarela` ASC),
  CONSTRAINT `fk_calificacion_jurado`
    FOREIGN KEY (`idjurado`)
    REFERENCES `eleccionmiss`.`jurado` (`idjurado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_calificacion_participante1`
    FOREIGN KEY (`idparticipante`)
    REFERENCES `eleccionmiss`.`participante` (`idparticipante`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_calificacion_pasarela1`
    FOREIGN KEY (`idpasarela`)
    REFERENCES `eleccionmiss`.`pasarela` (`idpasarela`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `eleccionmiss`.`foto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `eleccionmiss`.`foto` (
  `idfoto` INT NOT NULL AUTO_INCREMENT,
  `nombre_archivo` VARCHAR(45) NOT NULL,
  `extension` VARCHAR(4) NOT NULL DEFAULT '.jpg',
  `idparticipante` INT NOT NULL,
  PRIMARY KEY (`idfoto`),
  INDEX `fk_foto_participante1_idx` (`idparticipante` ASC),
  CONSTRAINT `fk_foto_participante1`
    FOREIGN KEY (`idparticipante`)
    REFERENCES `eleccionmiss`.`participante` (`idparticipante`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
