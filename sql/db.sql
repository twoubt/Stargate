-- MySQL Script generated by MySQL Workbench
-- Tue Dec 22 18:10:18 2015
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema stargate
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema stargate
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `stargate` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `stargate` ;

-- -----------------------------------------------------
-- Table `stargate`.`JOUEUR`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stargate`.`JOUEUR` ;

CREATE TABLE IF NOT EXISTS `stargate`.`JOUEUR` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(45) NULL,
  `password` VARCHAR(150) NULL,
  `mail` VARCHAR(100) NULL,
  `ip` VARCHAR(45) NULL,
  `lastconnexion` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `stargate`.`GALAXIES`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stargate`.`GALAXIES` ;

CREATE TABLE IF NOT EXISTS `stargate`.`GALAXIES` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `libelle` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `stargate`.`SYSTEMES_SOLAIRE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stargate`.`SYSTEMES_SOLAIRE` ;

CREATE TABLE IF NOT EXISTS `stargate`.`SYSTEMES_SOLAIRE` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `g_id` INT NOT NULL,
  `nom` VARCHAR(45) NULL,
  `pos_x` INT NULL,
  `pos_y` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_SYSTEMES_SOLAIRE_GALAXIES_idx` (`g_id` ASC),
  CONSTRAINT `fk_SYSTEMES_SOLAIRE_GALAXIES`
    FOREIGN KEY (`g_id`)
    REFERENCES `stargate`.`GALAXIES` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `stargate`.`PLANETES`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stargate`.`PLANETES` ;

CREATE TABLE IF NOT EXISTS `stargate`.`PLANETES` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `j_id` INT NOT NULL,
  `s_id` INT NOT NULL,
  `position` INT NULL,
  `nom` VARCHAR(45) NULL,
  `naquadah` DECIMAL NULL,
  `neutronium` DECIMAL NULL,
  `fer` DECIMAL NULL,
  `neutronium` DECIMAL NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_PLANETES_JOUEUR1_idx` (`j_id` ASC),
  INDEX `fk_PLANETES_SYSTEMES_SOLAIRE1_idx` (`s_id` ASC),
  CONSTRAINT `fk_PLANETES_JOUEUR1`
    FOREIGN KEY (`j_id`)
    REFERENCES `stargate`.`JOUEUR` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_PLANETES_SYSTEMES_SOLAIRE1`
    FOREIGN KEY (`s_id`)
    REFERENCES `stargate`.`SYSTEMES_SOLAIRE` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `stargate`.`CONNECTER`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stargate`.`CONNECTER` ;

CREATE TABLE IF NOT EXISTS `stargate`.`CONNECTER` (
  `j_id` INT NOT NULL,
  `dateconnexion` DATETIME NULL,
  PRIMARY KEY (`j_id`),
  INDEX `fk_CONNECTER_JOUEUR1_idx` (`j_id` ASC),
  CONSTRAINT `fk_CONNECTER_JOUEUR1`
    FOREIGN KEY (`j_id`)
    REFERENCES `stargate`.`JOUEUR` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `stargate`.`BATIMENTS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stargate`.`BATIMENTS` ;

CREATE TABLE IF NOT EXISTS `stargate`.`BATIMENTS` (
  `id` INT NOT NULL,
  `nom` VARCHAR(45) NULL,
  `description` TEXT NULL,
  `image` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `stargate`.`CONSTRUIT`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stargate`.`CONSTRUIT` ;

CREATE TABLE IF NOT EXISTS `stargate`.`CONSTRUIT` (
  `p_id` INT NOT NULL,
  `b_id` INT NOT NULL,
  `niveau` INT NULL,
  INDEX `fk_CONSTRUIT_PLANETES1_idx` (`p_id` ASC),
  INDEX `fk_CONSTRUIT_BATIMENTS1_idx` (`b_id` ASC),
  PRIMARY KEY (`p_id`, `b_id`),
  CONSTRAINT `fk_CONSTRUIT_PLANETES1`
    FOREIGN KEY (`p_id`)
    REFERENCES `stargate`.`PLANETES` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_CONSTRUIT_BATIMENTS1`
    FOREIGN KEY (`b_id`)
    REFERENCES `stargate`.`BATIMENTS` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `stargate`.`FILE_BATIMENT`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stargate`.`FILE_BATIMENT` ;

CREATE TABLE IF NOT EXISTS `stargate`.`FILE_BATIMENT` (
  `p_id` INT NOT NULL,
  `b_id` INT NOT NULL,
  `datefin` DATETIME NULL,
  INDEX `fk_FILE_BATIMENT_PLANETES1_idx` (`p_id` ASC),
  INDEX `fk_FILE_BATIMENT_BATIMENTS1_idx` (`b_id` ASC),
  PRIMARY KEY (`p_id`, `b_id`),
  CONSTRAINT `fk_FILE_BATIMENT_PLANETES1`
    FOREIGN KEY (`p_id`)
    REFERENCES `stargate`.`PLANETES` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_FILE_BATIMENT_BATIMENTS1`
    FOREIGN KEY (`b_id`)
    REFERENCES `stargate`.`BATIMENTS` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `stargate`.`TECHNOLOGIE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stargate`.`TECHNOLOGIE` ;

CREATE TABLE IF NOT EXISTS `stargate`.`TECHNOLOGIE` (
  `id` INT NOT NULL,
  `nom` VARCHAR(45) NULL,
  `description` TEXT NULL,
  `image` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `stargate`.`POSSEDER`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stargate`.`POSSEDER` ;

CREATE TABLE IF NOT EXISTS `stargate`.`POSSEDER` (
  `j_id` INT NOT NULL,
  `t_id` INT NOT NULL,
  `niveau` INT NULL,
  INDEX `fk_POSSEDER_JOUEUR1_idx` (`j_id` ASC),
  INDEX `fk_POSSEDER_TECHNOLOGIE1_idx` (`t_id` ASC),
  CONSTRAINT `fk_POSSEDER_JOUEUR1`
    FOREIGN KEY (`j_id`)
    REFERENCES `stargate`.`JOUEUR` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_POSSEDER_TECHNOLOGIE1`
    FOREIGN KEY (`t_id`)
    REFERENCES `stargate`.`TECHNOLOGIE` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `stargate`.`RECHERCHER`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stargate`.`RECHERCHER` ;

CREATE TABLE IF NOT EXISTS `stargate`.`RECHERCHER` (
  `j_id` INT NOT NULL,
  `t_id` INT NOT NULL,
  `datefin` DATETIME NULL,
  INDEX `fk_RECHERCHER_JOUEUR1_idx` (`j_id` ASC),
  INDEX `fk_RECHERCHER_TECHNOLOGIE1_idx` (`t_id` ASC),
  CONSTRAINT `fk_RECHERCHER_JOUEUR1`
    FOREIGN KEY (`j_id`)
    REFERENCES `stargate`.`JOUEUR` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_RECHERCHER_TECHNOLOGIE1`
    FOREIGN KEY (`t_id`)
    REFERENCES `stargate`.`TECHNOLOGIE` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
