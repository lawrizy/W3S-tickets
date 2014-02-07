SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `db_ticketing` DEFAULT CHARACTER SET utf8 ;
USE `db_ticketing` ;

-- -----------------------------------------------------
-- Table `db_ticketing`.`w3sys_categorie_incident`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_ticketing`.`w3sys_categorie_incident` (
  `id_categorie_incident` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `label` VARCHAR(64) NOT NULL,
  `fk_parent` INT(10) UNSIGNED NULL,
  PRIMARY KEY (`id_categorie_incident`),
  UNIQUE INDEX `nomCategorieIncident_UNIQUE` (`label` ASC),
  INDEX `fk_w3sys_categorie_incident_w3sys_categorie_incident1_idx` (`fk_parent` ASC))
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `db_ticketing`.`w3sys_statut_ticket`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_ticketing`.`w3sys_statut_ticket` (
  `id_statut_ticket` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `label` VARCHAR(64) NULL DEFAULT NULL,
  PRIMARY KEY (`id_statut_ticket`),
  UNIQUE INDEX `nomStatutTicket_UNIQUE` (`label` ASC))
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
  PRIMARY KEY (`id_locataire`))
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `db_ticketing`.`w3sys_lieu`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_ticketing`.`w3sys_lieu` (
  `id_lieu` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `adresse` VARCHAR(64) NOT NULL,
  `ville` VARCHAR(64) NOT NULL,
  `fk_locataire` INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id_lieu`),
  INDEX `fk_w3sys_lieu_w3sys_locataire1_idx` (`fk_locataire` ASC))
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `db_ticketing`.`w3sys_user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_ticketing`.`w3sys_user` (
  `id_user` INT(10) NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(64) NOT NULL,
  `prenom` VARCHAR(64) NOT NULL,
  `email` VARCHAR(64) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id_user`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_ticketing`.`w3sys_ticket`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_ticketing`.`w3sys_ticket` (
  `id_ticket` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fk_statut` INT(10) UNSIGNED NOT NULL,
  `fk_categorie` INT(10) UNSIGNED NOT NULL,
  `fk_lieu` INT(10) UNSIGNED NOT NULL,
  `fk_user` INT(10) UNSIGNED NOT NULL,
  `version` INT(2) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_ticket`),
  INDEX `fk_w3sys_ticket_w3sys_statut_ticket1_idx` (`fk_statut` ASC),
  INDEX `fk_w3sys_ticket_w3sys_categorie_incident1_idx` (`fk_categorie` ASC),
  INDEX `fk_w3sys_ticket_w3sys_lieu1_idx` (`fk_lieu` ASC),
  INDEX `fk_w3sys_ticket_w3sys_user1_idx` (`fk_user` ASC))
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `db_ticketing`.`w3sys_historique_ticket`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_ticketing`.`w3sys_historique_ticket` (
  `id_historique_ticket` INT(11) NOT NULL AUTO_INCREMENT,
  `date_update` DATETIME NOT NULL,
  `commentaire` TEXT NULL DEFAULT NULL,
  `fk_ticket` INT(10) UNSIGNED NOT NULL,
  `fk_statut_ticket` INT(10) UNSIGNED NOT NULL,
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


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
