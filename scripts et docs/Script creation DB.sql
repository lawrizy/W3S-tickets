SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `db_ticketing` ;
CREATE SCHEMA IF NOT EXISTS `db_ticketing` DEFAULT CHARACTER SET utf8 ;
USE `db_ticketing` ;

-- -----------------------------------------------------
-- Table `db_ticketing`.`categorie_incident`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_ticketing`.`categorie_incident` ;

CREATE TABLE IF NOT EXISTS `db_ticketing`.`categorie_incident` (
  `idTypeIncident` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nomCategorieIncident` VARCHAR(64) NOT NULL,
  `fk_sous_categorie_reflexive` INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`idTypeIncident`),
  INDEX `fk_categorie_incident_categorie_incident1_idx` (`fk_sous_categorie_reflexive` ASC),
  UNIQUE INDEX `nomCategorieIncident_UNIQUE` (`nomCategorieIncident` ASC))
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `db_ticketing`.`lieu`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_ticketing`.`lieu` ;

CREATE TABLE IF NOT EXISTS `db_ticketing`.`lieu` (
  `idLieu` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `adresse` VARCHAR(64) NOT NULL,
  `ville` VARCHAR(64) NOT NULL,
  PRIMARY KEY (`idLieu`))
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `db_ticketing`.`locataire`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_ticketing`.`locataire` ;

CREATE TABLE IF NOT EXISTS `db_ticketing`.`locataire` (
  `idLocataire` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Nom` VARCHAR(64) NOT NULL,
  `Email` VARCHAR(64) NOT NULL,
  `MotDePasse` VARCHAR(32) NOT NULL,
  `fk_idLieu` INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`idLocataire`),
  INDEX `fk_locataire_lieu_idx` (`fk_idLieu` ASC))
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `db_ticketing`.`statut_ticket`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_ticketing`.`statut_ticket` ;

CREATE TABLE IF NOT EXISTS `db_ticketing`.`statut_ticket` (
  `idStatutTicket` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nomStatutTicket` VARCHAR(64) NULL,
  PRIMARY KEY (`idStatutTicket`),
  UNIQUE INDEX `nomStatutTicket_UNIQUE` (`nomStatutTicket` ASC))
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `db_ticketing`.`ticket`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_ticketing`.`ticket` ;

CREATE TABLE IF NOT EXISTS `db_ticketing`.`ticket` (
  `idTicket` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fk_idsousCategorieIncident` INT(10) UNSIGNED NULL,
  `fk_idTypeIncident` INT(10) UNSIGNED NOT NULL,
  `fk_idLocataire` INT(10) UNSIGNED NOT NULL,
  `fk_idStatutTicket` INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`idTicket`),
  INDEX `fk_ticket_categorieincident1_idx` (`fk_idTypeIncident` ASC),
  INDEX `fk_ticket_locataire1_idx` (`fk_idLocataire` ASC),
  INDEX `fk_ticket_statutticket1_idx` (`fk_idStatutTicket` ASC))
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `db_ticketing`.`historique_ticket`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_ticketing`.`historique_ticket` ;

CREATE TABLE IF NOT EXISTS `db_ticketing`.`historique_ticket` (
  `idhistoriqueTicket` INT NOT NULL,
  `dateUpdate` DATETIME NOT NULL,
  `fk_idTicket` INT(10) UNSIGNED NOT NULL,
  `commentaire` TEXT NULL,
  PRIMARY KEY (`idhistoriqueTicket`),
  INDEX `fk_historiqueTicket_ticket1_idx` (`fk_idTicket` ASC),
  CONSTRAINT `fk_historiqueTicket_ticket1`
    FOREIGN KEY (`fk_idTicket`)
    REFERENCES `db_ticketing`.`ticket` (`idTicket`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `db_ticketing`.`statut_ticket`
-- -----------------------------------------------------
START TRANSACTION;
USE `db_ticketing`;
INSERT INTO `db_ticketing`.`statut_ticket` (`idStatutTicket`, `nomStatutTicket`) VALUES (NULL, 'Ouvert');
INSERT INTO `db_ticketing`.`statut_ticket` (`idStatutTicket`, `nomStatutTicket`) VALUES (NULL, 'En attente');
INSERT INTO `db_ticketing`.`statut_ticket` (`idStatutTicket`, `nomStatutTicket`) VALUES (NULL, 'En cours');
INSERT INTO `db_ticketing`.`statut_ticket` (`idStatutTicket`, `nomStatutTicket`) VALUES (NULL, 'Recontacter locataire');
INSERT INTO `db_ticketing`.`statut_ticket` (`idStatutTicket`, `nomStatutTicket`) VALUES (NULL, 'Recontacter prestataire');
INSERT INTO `db_ticketing`.`statut_ticket` (`idStatutTicket`, `nomStatutTicket`) VALUES (NULL, 'Vérification');
INSERT INTO `db_ticketing`.`statut_ticket` (`idStatutTicket`, `nomStatutTicket`) VALUES (NULL, 'Terminé');

COMMIT;

USE `db_ticketing`;

DELIMITER $$

USE `db_ticketing`$$
DROP TRIGGER IF EXISTS `db_ticketing`.`ticket_insert_first_historique` $$
USE `db_ticketing`$$
CREATE TRIGGER `ticket_insert_first_historique` BEFORE INSERT ON `ticket` FOR EACH ROW
	INSERT INTO historique_ticket VALUES('', NOW(), idTicket);
$$


USE `db_ticketing`$$
DROP TRIGGER IF EXISTS `db_ticketing`.`ticket_before_status_update` $$
USE `db_ticketing`$$
CREATE TRIGGER `ticket_before_status_update` BEFORE UPDATE ON `ticket` FOR EACH ROW
	IF NEW.fk_idStatutTicket <> OLD.fk_idStatutTicket THEN
		INSERT INTO historique_ticket VALUES('', NOW(), idTicket);
	END IF;
$$


DELIMITER ;
