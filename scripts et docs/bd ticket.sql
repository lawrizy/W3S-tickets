SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `db_ticketing` DEFAULT CHARACTER SET utf8 ;
USE `db_ticketing` ;

-- -----------------------------------------------------
-- Table `db_ticketing`.`w3sys_priorite`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_ticketing`.`w3sys_priorite` (
  `id_priorite` INT(10) NOT NULL AUTO_INCREMENT,
  `label` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_priorite`),
  UNIQUE INDEX `label_UNIQUE` (`label` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_ticketing`.`w3sys_categorie_incident`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_ticketing`.`w3sys_categorie_incident` (
  `id_categorie_incident` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `label` VARCHAR(64) NOT NULL,
  `fk_parent` INT(10) UNSIGNED NULL,
  `fk_priorite` INT(10) NOT NULL,
  PRIMARY KEY (`id_categorie_incident`),
  UNIQUE INDEX `nomCategorieIncident_UNIQUE` (`label` ASC),
  INDEX `fk_w3sys_categorie_incident_w3sys_categorie_incident1_idx` (`fk_parent` ASC),
  INDEX `fk_w3sys_categorie_incident_w3sys_priorite1_idx` (`fk_priorite` ASC))
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `db_ticketing`.`w3sys_statut_ticket`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_ticketing`.`w3sys_statut_ticket` (
  `id_statut_ticket` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `label` VARCHAR(64) NOT NULL,
  PRIMARY KEY (`id_statut_ticket`),
  UNIQUE INDEX `label_UNIQUE` (`label` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 8;


-- -----------------------------------------------------
-- Table `db_ticketing`.`w3sys_locataire`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_ticketing`.`w3sys_locataire` (
  `id_locataire` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(64) NOT NULL,
  `email` VARCHAR(64) NOT NULL,
  `password` VARCHAR(32) NOT NULL,
  PRIMARY KEY (`id_locataire`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `db_ticketing`.`w3sys_batiment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_ticketing`.`w3sys_batiment` (
  `id_batiment` INT(10) NOT NULL AUTO_INCREMENT,
  `adresse` VARCHAR(45) NOT NULL,
  `commune` VARCHAR(45) NOT NULL,
  `cp` INT(5) NOT NULL,
  PRIMARY KEY (`id_batiment`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_ticketing`.`w3sys_lieu`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_ticketing`.`w3sys_lieu` (
  `id_lieu` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `etage` INT NULL,
  `appartement` VARCHAR(5) NULL,
  `fk_locataire` INT(10) UNSIGNED NOT NULL,
  `fk_batiment` INT(10) NOT NULL,
  PRIMARY KEY (`id_lieu`),
  INDEX `fk_w3sys_lieu_w3sys_locataire1_idx` (`fk_locataire` ASC),
  INDEX `fk_w3sys_lieu_w3sys_batiment1_idx` (`fk_batiment` ASC))
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `db_ticketing`.`w3sys_fonction`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_ticketing`.`w3sys_fonction` (
  `id_fonction` INT(10) NOT NULL AUTO_INCREMENT,
  `label` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_fonction`),
  UNIQUE INDEX `label_UNIQUE` (`label` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_ticketing`.`w3sys_user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_ticketing`.`w3sys_user` (
  `id_user` INT(10) NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(64) NOT NULL,
  `email` VARCHAR(64) NOT NULL,
  `password` VARCHAR(32) NOT NULL,
  `fk_fonction` INT(10) NOT NULL,
  PRIMARY KEY (`id_user`),
  INDEX `fk_w3sys_user_w3sys_fonction1_idx` (`fk_fonction` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  CONSTRAINT `fk_w3sys_user_w3sys_fonction1`
    FOREIGN KEY (`fk_fonction`)
    REFERENCES `db_ticketing`.`w3sys_fonction` (`id_fonction`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_ticketing`.`w3sys_canal`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_ticketing`.`w3sys_canal` (
  `id_canal` INT(10) NOT NULL AUTO_INCREMENT,
  `label` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_canal`),
  UNIQUE INDEX `label_UNIQUE` (`label` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_ticketing`.`w3sys_ticket`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_ticketing`.`w3sys_ticket` (
  `id_ticket` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fk_statut` INT(10) UNSIGNED NOT NULL DEFAULT 1,
  `fk_categorie` INT(10) UNSIGNED NOT NULL,
  `fk_lieu` INT(10) UNSIGNED NOT NULL,
  `fk_user` INT(10) UNSIGNED NULL,
  `version` INT(2) UNSIGNED NULL DEFAULT 0,
  `commentaire` TEXT NULL,
  `fk_canal` INT(10) NOT NULL,
  PRIMARY KEY (`id_ticket`),
  INDEX `fk_w3sys_ticket_w3sys_statut_ticket1_idx` (`fk_statut` ASC),
  INDEX `fk_w3sys_ticket_w3sys_categorie_incident1_idx` (`fk_categorie` ASC),
  INDEX `fk_w3sys_ticket_w3sys_lieu1_idx` (`fk_lieu` ASC),
  INDEX `fk_w3sys_ticket_w3sys_user1_idx` (`fk_user` ASC),
  INDEX `fk_w3sys_ticket_w3sys_canal1_idx` (`fk_canal` ASC))
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `db_ticketing`.`w3sys_historique_ticket`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_ticketing`.`w3sys_historique_ticket` (
  `id_historique_ticket` INT(11) NOT NULL AUTO_INCREMENT,
  `date_update` DATETIME NOT NULL,
  `fk_ticket` INT(10) NOT NULL,
  `fk_statut_ticket` INT(10) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_historique_ticket`),
  INDEX `fk_w3sys_historique_ticket_w3sys_ticket_idx` (`fk_ticket` ASC),
  INDEX `fk_w3sys_historique_ticket_w3sys_statut_ticket1_idx` (`fk_statut_ticket` ASC),
  CONSTRAINT `fk_w3sys_historique_ticket_w3sys_ticket`
    FOREIGN KEY (`fk_ticket`)
    REFERENCES `db_ticketing`.`w3sys_ticket` (`id_ticket`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_w3sys_historique_ticket_w3sys_statut_ticket1`
    FOREIGN KEY (`fk_statut_ticket`)
    REFERENCES `db_ticketing`.`w3sys_statut_ticket` (`id_statut_ticket`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_ticketing`.`w3sys_entreprise`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_ticketing`.`w3sys_entreprise` (
  `id_entreprise` INT(10) NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NOT NULL,
  `adresse` VARCHAR(45) NOT NULL,
  `tva` VARCHAR(45) NOT NULL,
  `commune` VARCHAR(45) NOT NULL,
  `cp` INT(5) NOT NULL,
  `tel` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_entreprise`),
  UNIQUE INDEX `tva_UNIQUE` (`tva` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_ticketing`.`w3sys_secteur`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_ticketing`.`w3sys_secteur` (
  `fk_entreprise` INT(10) NOT NULL,
  `fk_batiment` INT(10) NOT NULL,
  `id_secteur` INT(10) NOT NULL AUTO_INCREMENT,
  `fk_categorie` INT(10) NOT NULL,
  INDEX `fk_w3sys_secteur_w3sys_entreprise1_idx` (`fk_entreprise` ASC),
  INDEX `fk_w3sys_secteur_w3sys_batiment1_idx` (`fk_batiment` ASC),
  PRIMARY KEY (`id_secteur`),
  INDEX `fk_w3sys_secteur_w3sys_categorie_incident1_idx` (`fk_categorie` ASC),
  CONSTRAINT `fk_w3sys_secteur_w3sys_entreprise1`
    FOREIGN KEY (`fk_entreprise`)
    REFERENCES `db_ticketing`.`w3sys_entreprise` (`id_entreprise`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_w3sys_secteur_w3sys_batiment1`
    FOREIGN KEY (`fk_batiment`)
    REFERENCES `db_ticketing`.`w3sys_batiment` (`id_batiment`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_w3sys_secteur_w3sys_categorie_incident1`
    FOREIGN KEY (`fk_categorie`)
    REFERENCES `db_ticketing`.`w3sys_categorie_incident` (`id_categorie_incident`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
