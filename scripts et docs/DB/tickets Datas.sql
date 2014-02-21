/*
SQLyog Community Edition- MySQL GUI v6.52
MySQL - 5.5.23 : Database - websystickets
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

create database if not exists `websystickets`;

USE `websystickets`;

/*Table structure for table `w3sys_batiment` */

DROP TABLE IF EXISTS `w3sys_batiment`;

CREATE TABLE `w3sys_batiment` (
  `id_batiment` int(10) NOT NULL AUTO_INCREMENT,
  `adresse` varchar(64) NOT NULL,
  `commune` varchar(64) NOT NULL,
  `cp` int(5) NOT NULL,
  `nom` varchar(64) NOT NULL,
  `cpt` int(6) NOT NULL DEFAULT '1',
  `code` varchar(4) NOT NULL,
  PRIMARY KEY (`id_batiment`),
  UNIQUE KEY `nom_UNIQUE` (`nom`),
  UNIQUE KEY `code_UNIQUE` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

/*Data for the table `w3sys_batiment` */

insert  into `w3sys_batiment`(`id_batiment`,`adresse`,`commune`,`cp`,`nom`,`cpt`,`code`) values (1,'Boulevard de France 7 & 9','Braine l\'Alleud',1420,'Alliance A & C',40,'ALLA'),(2,'Avenue de Finlande 2','Braine l\'Alleud',1420,'Alliance B',13,'ALLB'),(3,'Place de Luxembourg 1-4','Braine l\'Alleud',1420,'Alliance D & E',13,'ALLD'),(4,'Avenue de Finlande 4-6-8','Braine l\'Alleud',1420,'Alliance F & G',5,'ALLF'),(5,'Avenue de Finlande 5-7-9','Braine l\'Alleud',1420,'Alliance J',3,'ALLJ'),(6,'Boulevard de l\'Angleterre 2-4','Braine l\'Alleud',1420,'Alliance S',3,'ALLS'),(7,'Avenue des Arts 44','Bruxelles',1040,'Arts 44',4,'ARTS'),(8,'Avenue des Arts 58','Bruxelles',1040,'Arts&Lux',2,'ARLU'),(9,'Rue de Genève 1-3','Bruxelles',1140,'ASTRID - EVERE',2,'ASEV'),(10,'Chaussée de Wavre 1789','Bruxelles',1160,'AUDERGHEM',1,'AUDE'),(11,'Av. Beaulieu 1-3','Bruxelles',1160,'BEAULIEU',3,'BEAU'),(12,'Bd. De Waterloo 38','Bruxelles',1050,'BOULEVARD DE WATERLOO',2,'BVDW'),(13,'Bd. de l\'Industrie 14','Bruxelles',1070,'Brussels 1 Office',1,'B1OF'),(14,'Rue des deux gares 150','Bruxelles',1070,'Brussels 2 Office',1,'B2OF'),(15,'Rue de Loxum 25','Bruxelles',1000,'CENTRAL PLAZA',1,'CPLA'),(16,'Rue du Marais 54-56','Bruxelles',1000,'CITEB NEW',2,'CINE'),(17,'Bd. du Jardin Botanique 19','Bruxelles',1000,'CITY CENTER',1,'CICE'),(18,'Avenue du Congo 7','Bruxelles',1000,'CONGO 7',1,'CONG'),(19,'Av . de Cortenbergh 80','Bruxelles',1000,'CORTENBERGH',1,'CORT'),(20,'Av. de Cortenbergh 60','Bruxelles',1000,'CRYSTAL',1,'CRYS'),(21,'Rue Joseph Wauters 63','Hannut',4280,'HANNUT',1,'HANN'),(22,'Guffenslaan 5-7-9','Hasselt',3500,'HASSELT',1,'HASS'),(23,'Rue du Noyer - Pl.Jamblinne de Meux 221','Bruxelles',1030,'JAMBLINNE DE MEUX',1,'JAME'),(24,'Rue de la Loi 102','Bruxelles',1040,'LOI 102',1,'LOII'),(25,'Rue de la Fusée 100','Bruxelles',1130,'Mercure centre',1,'MECE'),(26,'Rue des Bourgeois 7','Namur',5000,'NAMUR - BOURGEOIS',1,'NABO'),(27,'Boulevard Simon Bolivar 34','Bruxelles',1000,'NORTH LIGHT',1,'NOLI'),(28,'Mercuriusstraat 27','Nossegem',1930,'NOSSEGEM - Data Center',1,'NODC'),(29,'Chaussée de la Hulpe 415','Overijse',3090,'OVERIJSE',2,'OVER'),(30,'Pl. de l\'Université 16','Louvain-La-Neuve',1348,'PARC -UNIVERSITE L-L-N (LE)',1,'ULLN'),(31,'Sq. F. Roosevelt 6','Mons',7000,'ROOSEVELT - MONS',2,'ROOM'),(32,'Rue Royale 52','Bruxelles',1000,'ROYALE 52',1,'RO52'),(33,'Rue Royale 54','Bruxelles',1000,'ROYALE 54',1,'RO54'),(34,'Av. Louise 54-60','Bruxelles',1050,'STEPHANIE PLACE I',2,'STPI'),(35,'Avenue Louise 59-69','Bruxelles',1050,'Stéphanie Square',1,'STSQ'),(36,'Av. de Tervuren 2','Bruxelles',1040,'TERVUREN 2',1,'TER2'),(37,'Culliganlaan 1','Diegem',1831,'Twin Square, Madison',1,'SMAD'),(38,'Culliganlaan 1','Diegem',1831,'Twin Square, Vendôme',1,'SVEN'),(39,'Rue Ernest Malvoz 649','Waremme',4300,'WAREMME',2,'WARE'),(40,'Drève de Richelle 161','Waterloo',1410,'Waterloo Office Park, immeuble M',1,'WOPM'),(41,'Drève de Richelle','Waterloo',1410,'Waterloo Office Park, immeuble N',2,'WOPN'),(42,'Bd. de la Woluwe 2','Woluwe Saint Pierre',1150,'WOLUWE GATE',1,'WOGA');



DROP TABLE IF EXISTS `w3sys_canal`;

CREATE TABLE `w3sys_canal` (
  `id_canal` int(10) NOT NULL AUTO_INCREMENT,
  `label` varchar(45) NOT NULL,
  PRIMARY KEY (`id_canal`),
  UNIQUE KEY `label_UNIQUE` (`label`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `w3sys_canal` */

insert  into `w3sys_canal`(`id_canal`,`label`) values (1,'Phone'),(2,'Web');

/*Table structure for table `w3sys_categorie_incident` */

DROP TABLE IF EXISTS `w3sys_categorie_incident`;

CREATE TABLE `w3sys_categorie_incident` (
  `id_categorie_incident` int(10) NOT NULL AUTO_INCREMENT,
  `label` varchar(64) NOT NULL,
  `fk_parent` int(10) DEFAULT NULL,
  `fk_priorite` int(10) NOT NULL,
  PRIMARY KEY (`id_categorie_incident`),
  KEY `fk_w3sys_categorie_incident_w3sys_categorie_incident1_idx` (`fk_parent`),
  KEY `fk_w3sys_categorie_incident_w3sys_priorite1_idx` (`fk_priorite`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

/*Data for the table `w3sys_categorie_incident` */

insert  into `w3sys_categorie_incident`(`id_categorie_incident`,`label`,`fk_parent`,`fk_priorite`) values (1,'Sanitaire',NULL,1),(2,'Electricité',NULL,1),(3,'Ascenseurs',NULL,1),(4,'Chauffage / Climatisation',NULL,1),(5,'Panne d\'électricité',2,1),(6,'Ampoule / néon défectueux',2,1),(7,'Fuite eau',1,1),(8,'WC bouché',1,1),(9,'Ascenseur en panne',3,1),(10,'Arrêt',3,1),(11,'Radiateur en panne',4,1),(12,'Local trop chaud',4,1),(13,'Local trop froid',4,1),(14,'Sécurité',NULL,1),(15,'Divers',NULL,1),(16,'Thermostat défectueux',4,1),(17,'Climatisation en panne',4,1),(18,'Fuite d\'eau au niveau du radiateur',4,1),(19,'Autre',4,1),(20,'Evier bouché',1,1),(21,'Chasse d\'eau défectueuse',1,1),(22,'Robinetterie défectueuse',1,1),(23,'Mauvaise odeur au niveau des canalisations',1,1),(24,'Autre',1,1),(25,'Prise défectueuse',2,1),(26,'Autre',2,1),(27,'Badge défectueux',14,1),(28,'Lecteur de badge défectueux',14,1),(29,'Problème d\'accès au batiment',14,1),(30,'Problème d\'accès au parking',14,1),(31,'Caméra défectueuse',14,1),(32,'Détecteur d\'incendie défectueux',14,1),(33,'Parlophone / visiophone défectueux',14,1),(34,'Porte bloquée',14,1),(35,'Autre',14,1),(36,'Nettoyage',15,1),(37,'Déblayage',15,1),(38,'Papier WC manquant',15,1),(39,'Produit sanitaire manquant',15,1),(40,'Autre',15,1);

/*Table structure for table `w3sys_entreprise` */

DROP TABLE IF EXISTS `w3sys_entreprise`;

CREATE TABLE `w3sys_entreprise` (
  `id_entreprise` int(10) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) NOT NULL,
  `adresse` varchar(45) NOT NULL,
  `tva` varchar(45) NOT NULL,
  `commune` varchar(45) NOT NULL,
  `cp` int(5) NOT NULL,
  `tel` varchar(45) NOT NULL,
  PRIMARY KEY (`id_entreprise`),
  UNIQUE KEY `tva_UNIQUE` (`tva`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `w3sys_entreprise` */

insert  into `w3sys_entreprise`(`id_entreprise`,`nom`,`adresse`,`tva`,`commune`,`cp`,`tel`) values (1,'TEM','1, rue test','1111111111111111','Bruxelles',1000,'02191919'),(2,'DALKIA','33, bvd de la cambre','0000000000000000','Jette',1090,'01234567'),(3,'COFELY','247, rue fransman','2222222222222222','Laeken',1020,'98765432'),(4,'KONE','Rue test, 1','9999999999','Commune test',9999,'02345345345');

/*Table structure for table `w3sys_fonction` */

DROP TABLE IF EXISTS `w3sys_fonction`;

CREATE TABLE `w3sys_fonction` (
  `id_fonction` int(10) NOT NULL AUTO_INCREMENT,
  `label` varchar(45) NOT NULL,
  PRIMARY KEY (`id_fonction`),
  UNIQUE KEY `label_UNIQUE` (`label`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `w3sys_fonction` */

insert  into `w3sys_fonction`(`id_fonction`,`label`) values (2,'Admin'),(1,'User');

/*Table structure for table `w3sys_historique_ticket` */

DROP TABLE IF EXISTS `w3sys_historique_ticket`;

CREATE TABLE `w3sys_historique_ticket` (
  `id_historique_ticket` int(10) NOT NULL AUTO_INCREMENT,
  `date_update` datetime NOT NULL,
  `fk_ticket` int(10) NOT NULL,
  `fk_statut_ticket` int(10) NOT NULL,
  `fk_user` int(10) NOT NULL,
  PRIMARY KEY (`id_historique_ticket`),
  KEY `fk_w3sys_historique_ticket_w3sys_ticket_idx` (`fk_ticket`),
  KEY `fk_w3sys_historique_ticket_w3sys_statut_ticket1_idx` (`fk_statut_ticket`),
  KEY `fk_w3sys_historique_ticket_w3sys_user1_idx` (`fk_user`),
  CONSTRAINT `fk_w3sys_historique_ticket_w3sys_statut_ticket1` FOREIGN KEY (`fk_statut_ticket`) REFERENCES `w3sys_statut_ticket` (`id_statut_ticket`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_w3sys_historique_ticket_w3sys_ticket` FOREIGN KEY (`fk_ticket`) REFERENCES `w3sys_ticket` (`id_ticket`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_w3sys_historique_ticket_w3sys_user1` FOREIGN KEY (`fk_user`) REFERENCES `w3sys_user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=utf8;

/*Data for the table `w3sys_historique_ticket` */

insert  into `w3sys_historique_ticket`(`id_historique_ticket`,`date_update`,`fk_ticket`,`fk_statut_ticket`,`fk_user`) values (1,'2014-02-18 18:23:29',82,1,1),(2,'2014-02-18 18:23:38',83,1,1),(3,'2014-02-18 18:23:50',83,1,1),(4,'2014-02-18 18:24:21',84,1,1),(5,'2014-02-18 19:25:21',91,1,1),(6,'2014-02-18 19:27:54',99,1,1),(7,'2014-02-18 19:29:10',105,1,1),(8,'2014-02-18 19:29:28',106,1,1),(9,'2014-02-18 19:31:48',110,1,1),(10,'2014-02-18 19:32:29',112,1,1),(11,'2014-02-18 19:36:40',114,1,1),(12,'2014-02-19 09:11:39',117,1,3),(13,'2014-02-19 10:22:08',131,1,1),(14,'2014-02-19 10:22:23',133,1,1),(15,'2014-02-19 10:30:39',138,1,1),(16,'2014-02-19 10:32:50',141,1,1),(17,'2014-02-19 11:30:55',4,3,1),(18,'2014-02-19 11:36:46',5,3,1),(19,'2014-02-19 11:41:27',151,1,1),(20,'2014-02-19 11:41:48',152,1,1),(21,'2014-02-19 11:42:07',153,1,1),(22,'2014-02-19 11:43:42',154,1,1),(23,'2014-02-19 11:44:09',155,1,1),(24,'2014-02-19 11:48:38',159,1,1),(25,'2014-02-19 11:48:49',160,1,1),(26,'2014-02-19 11:48:58',160,1,1),(27,'2014-02-19 11:49:22',160,1,1),(28,'2014-02-19 10:50:27',160,1,3),(29,'2014-02-19 11:51:52',160,2,1),(30,'2014-02-19 11:53:17',1,2,1),(31,'2014-02-19 10:54:18',1,2,3),(32,'2014-02-19 11:57:14',161,1,1),(33,'2014-02-19 12:02:49',161,2,1),(34,'2014-02-19 12:03:09',161,2,1),(35,'2014-02-19 11:03:47',1,2,3),(36,'2014-02-19 11:04:27',1,2,3),(37,'2014-02-19 12:04:40',162,1,1),(38,'2014-02-19 11:08:03',1,2,3),(39,'2014-02-19 11:09:51',1,2,3),(40,'2014-02-19 11:10:24',1,2,3),(41,'2014-02-19 12:11:36',2,2,3),(42,'2014-02-19 12:15:30',2,3,3),(43,'2014-02-19 11:20:12',160,2,3),(44,'2014-02-19 11:21:12',160,2,3),(45,'2014-02-19 11:21:33',160,2,3),(46,'2014-02-19 11:29:50',165,1,3),(47,'2014-02-19 11:30:45',166,1,3),(48,'2014-02-19 11:31:24',166,1,3),(49,'2014-02-19 11:32:18',1,2,3),(50,'2014-02-19 11:32:40',1,2,3),(51,'2014-02-19 11:33:30',1,2,3),(52,'2014-02-19 11:34:12',1,2,3),(53,'2014-02-19 12:36:28',1,2,3),(54,'2014-02-19 12:59:24',167,1,3),(55,'2014-02-19 12:23:03',1,2,3),(56,'2014-02-19 12:23:30',1,2,3),(57,'2014-02-19 12:25:07',1,2,3),(58,'2014-02-19 12:25:11',1,2,3),(59,'2014-02-19 12:26:20',1,2,3),(60,'2014-02-19 14:07:26',168,1,1),(61,'2014-02-19 14:08:38',169,1,1),(62,'2014-02-19 14:09:24',169,1,1),(63,'2014-02-19 14:09:50',169,2,1),(64,'2014-02-19 14:10:14',169,3,1),(65,'2014-02-19 14:11:48',170,1,1),(66,'2014-02-19 14:13:04',170,1,3),(67,'2014-02-19 14:14:05',170,2,3),(68,'2014-02-19 14:14:58',170,3,3),(69,'2014-02-19 14:15:40',170,3,3),(70,'2014-02-19 14:16:01',170,3,3),(71,'2014-02-19 14:17:06',169,2,1),(72,'2014-02-19 14:17:09',169,2,1),(73,'2014-02-19 14:17:16',169,3,1),(74,'2014-02-19 14:18:33',169,3,1),(75,'2014-02-19 14:42:26',171,1,1),(76,'2014-02-19 15:02:45',172,1,1),(77,'2014-02-19 14:20:20',1,2,3),(78,'2014-02-19 14:20:49',1,2,3),(79,'2014-02-19 14:21:18',1,3,3),(80,'2014-02-19 14:33:38',173,1,3),(81,'2014-02-19 14:34:11',173,1,3),(82,'2014-02-19 14:34:27',173,1,3),(83,'2014-02-19 14:35:23',174,1,1),(84,'2014-02-19 14:42:22',1,3,3),(85,'2014-02-19 14:45:33',175,1,3),(86,'2014-02-19 16:25:58',1,2,1),(87,'2014-02-19 16:26:09',1,3,1),(88,'2014-02-19 16:28:51',177,1,3),(89,'2014-02-19 16:32:23',177,1,3),(90,'2014-02-19 16:32:31',177,1,3),(91,'2014-02-19 16:32:42',177,2,3),(92,'2014-02-19 16:34:46',177,3,3),(93,'2014-02-19 16:40:35',178,1,1),(94,'2014-02-19 16:41:45',179,1,1),(95,'2014-02-19 16:44:33',180,1,1),(96,'2014-02-19 16:46:03',181,1,1),(97,'2014-02-19 16:49:12',182,1,1),(98,'2014-02-19 17:50:51',183,1,1),(99,'2014-02-19 18:03:31',184,1,1),(100,'2014-02-19 18:04:56',184,2,3),(101,'2014-02-19 18:05:41',184,2,3),(102,'2014-02-19 18:06:05',184,2,3),(103,'2014-02-19 18:06:18',184,3,3),(104,'2014-02-20 14:17:59',185,1,1),(105,'2014-02-20 14:21:07',187,1,1),(106,'2014-02-20 13:21:36',188,1,3),(107,'2014-02-20 14:26:46',189,1,1),(108,'2014-02-20 13:27:40',3,2,3),(109,'2014-02-20 13:30:25',190,1,3),(110,'2014-02-20 13:30:33',190,2,3),(111,'2014-02-20 13:30:49',190,3,3),(112,'2014-02-20 15:11:12',191,1,1),(113,'2014-02-20 15:18:22',6,2,3),(114,'2014-02-20 15:19:54',192,1,1),(115,'2014-02-20 15:22:40',193,1,3),(116,'2014-02-20 15:25:49',7,2,3),(117,'2014-02-20 15:26:28',194,1,1),(118,'2014-02-20 16:26:57',195,1,3),(119,'2014-02-20 16:27:48',195,1,3),(120,'2014-02-20 16:28:16',195,2,3),(121,'2014-02-20 16:29:57',8,2,3),(122,'2014-02-20 16:30:10',8,3,3),(123,'2014-02-20 16:34:07',195,3,3),(124,'2014-02-20 17:18:47',196,1,3),(125,'2014-02-20 18:45:27',9,2,3),(126,'2014-02-20 18:45:38',10,2,3),(127,'2014-02-20 18:54:20',197,1,3),(128,'2014-02-20 18:55:07',83,2,3);

/*Table structure for table `w3sys_lieu` */

DROP TABLE IF EXISTS `w3sys_lieu`;

CREATE TABLE `w3sys_lieu` (
  `id_lieu` int(10) NOT NULL AUTO_INCREMENT,
  `fk_locataire` int(10) NOT NULL,
  `fk_batiment` int(10) NOT NULL,
  PRIMARY KEY (`id_lieu`),
  KEY `fk_w3sys_lieu_w3sys_locataire1_idx` (`fk_locataire`),
  KEY `fk_w3sys_lieu_w3sys_batiment1_idx` (`fk_batiment`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `w3sys_lieu` */

insert  into `w3sys_lieu`(`id_lieu`,`fk_locataire`,`fk_batiment`) values (1,2,1),(2,3,4),(3,2,3),(4,1,3),(5,3,2);

/*Table structure for table `w3sys_locataire` */

DROP TABLE IF EXISTS `w3sys_locataire`;

CREATE TABLE `w3sys_locataire` (
  `id_locataire` int(10) NOT NULL AUTO_INCREMENT,
  `nom` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`id_locataire`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `w3sys_locataire` */

insert  into `w3sys_locataire`(`id_locataire`,`nom`,`email`,`password`) values (1,'Rachid Nokri','abc@def.com','0cc175b9c0f1b6a831c399e269772661'),(2,'Desaedeleer','desaedeleerlionel@hotmail.com','800a0e21225906fe82d141def1a9202d'),(3,'Aziz Lawrizy','def@abc.com','0cc175b9c0f1b6a831c399e269772661'),(4,'locataire','locataire@l.be','f5306c3a951ed90e70d7e3393cf733bc');

/*Table structure for table `w3sys_priorite` */

DROP TABLE IF EXISTS `w3sys_priorite`;

CREATE TABLE `w3sys_priorite` (
  `id_priorite` int(10) NOT NULL AUTO_INCREMENT,
  `label` varchar(45) NOT NULL,
  PRIMARY KEY (`id_priorite`),
  UNIQUE KEY `label_UNIQUE` (`label`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `w3sys_priorite` */

insert  into `w3sys_priorite`(`id_priorite`,`label`) values (3,'High'),(1,'Low'),(2,'Medium');

/*Table structure for table `w3sys_secteur` */

DROP TABLE IF EXISTS `w3sys_secteur`;

CREATE TABLE `w3sys_secteur` (
  `fk_entreprise` int(10) NOT NULL,
  `fk_batiment` int(10) NOT NULL,
  `id_secteur` int(10) NOT NULL AUTO_INCREMENT,
  `fk_categorie` int(10) NOT NULL,
  PRIMARY KEY (`id_secteur`),
  KEY `fk_w3sys_secteur_w3sys_entreprise1_idx` (`fk_entreprise`),
  KEY `fk_w3sys_secteur_w3sys_batiment1_idx` (`fk_batiment`),
  KEY `fk_w3sys_secteur_w3sys_categorie_incident1_idx` (`fk_categorie`),
  CONSTRAINT `fk_w3sys_secteur_w3sys_batiment1` FOREIGN KEY (`fk_batiment`) REFERENCES `w3sys_batiment` (`id_batiment`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_w3sys_secteur_w3sys_categorie_incident1` FOREIGN KEY (`fk_categorie`) REFERENCES `w3sys_categorie_incident` (`id_categorie_incident`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_w3sys_secteur_w3sys_entreprise1` FOREIGN KEY (`fk_entreprise`) REFERENCES `w3sys_entreprise` (`id_entreprise`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

/*Data for the table `w3sys_secteur` */

insert  into `w3sys_secteur`(`fk_entreprise`,`fk_batiment`,`id_secteur`,`fk_categorie`) values (3,1,1,5),(3,2,2,5),(3,3,3,5),(3,4,4,5),(3,4,7,5),(1,1,8,5),(1,2,9,5),(1,3,10,5),(1,4,11,5),(2,1,12,5),(2,2,13,5),(2,3,14,5),(2,4,15,5);

/*Table structure for table `w3sys_statut_ticket` */

DROP TABLE IF EXISTS `w3sys_statut_ticket`;

CREATE TABLE `w3sys_statut_ticket` (
  `id_statut_ticket` int(10) NOT NULL AUTO_INCREMENT,
  `label` varchar(64) NOT NULL,
  PRIMARY KEY (`id_statut_ticket`),
  UNIQUE KEY `label_UNIQUE` (`label`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `w3sys_statut_ticket` */

insert  into `w3sys_statut_ticket`(`id_statut_ticket`,`label`) values (3,'Cloturé'),(2,'En Traitement'),(1,'Nouveau');

/*Table structure for table `w3sys_ticket` */

DROP TABLE IF EXISTS `w3sys_ticket`;

CREATE TABLE `w3sys_ticket` (
  `id_ticket` int(10) NOT NULL AUTO_INCREMENT,
  `fk_statut` int(10) NOT NULL DEFAULT '1',
  `fk_categorie` int(10) NOT NULL,
  `fk_user` int(10) DEFAULT NULL,
  `descriptif` text,
  `fk_canal` int(10) NOT NULL,
  `date_intervention` date DEFAULT NULL,
  `fk_entreprise` int(10) DEFAULT NULL,
  `code_ticket` varchar(10) DEFAULT NULL,
  `etage` varchar(45) DEFAULT NULL,
  `bureau` varchar(45) DEFAULT NULL,
  `fk_locataire` int(10) NOT NULL,
  `fk_batiment` int(10) NOT NULL,
  PRIMARY KEY (`id_ticket`),
  UNIQUE KEY `code_ticket_UNIQUE` (`code_ticket`),
  KEY `fk_w3sys_ticket_w3sys_statut_ticket1_idx` (`fk_statut`),
  KEY `fk_w3sys_ticket_w3sys_categorie_incident1_idx` (`fk_categorie`),
  KEY `fk_w3sys_ticket_w3sys_user1_idx` (`fk_user`),
  KEY `fk_w3sys_ticket_w3sys_canal1_idx` (`fk_canal`),
  KEY `fk_w3sys_ticket_w3sys_entreprise1_idx` (`fk_entreprise`),
  KEY `fk_w3sys_ticket_w3sys_locataire1_idx` (`fk_locataire`),
  KEY `fk_w3sys_ticket_w3sys_batiment1_idx` (`fk_batiment`)
) ENGINE=InnoDB AUTO_INCREMENT=198 DEFAULT CHARSET=utf8;

/*Data for the table `w3sys_ticket` */

insert  into `w3sys_ticket`(`id_ticket`,`fk_statut`,`fk_categorie`,`fk_user`,`descriptif`,`fk_canal`,`date_intervention`,`fk_entreprise`,`code_ticket`,`etage`,`bureau`,`fk_locataire`,`fk_batiment`) values (1,3,31,1,'test avant présentation\r\n---------- Cloture ----------\r\nfin\\n---------- Cloture ----------\\ntermine',1,'2014-02-20',1,'ABC1234','2','A',2,28),(2,3,5,1,'azerty\\n---------- Cloture ----------\\n',1,'2014-02-28',2,'BCD2345',NULL,NULL,2,2),(3,2,5,1,'scqf',1,'2014-02-21',4,'CDE3456',NULL,NULL,2,2),(4,3,5,1,'scqf<br>---------- Cloture ----------<br>Test de cloture ticket DEF4567',1,'2014-02-21',2,'DEF4567',NULL,NULL,3,3),(5,3,5,1,'scqf\\n---------- Cloture ----------\\nTest avec Lionel\r\nTest\r\nTest',1,'2014-02-27',1,'EFG5678',NULL,NULL,1,2),(6,2,5,1,'e',1,'2014-02-21',1,'FGH6789',NULL,NULL,1,1),(7,2,5,1,'e',1,'2014-02-26',1,'GHI7890',NULL,NULL,2,3),(8,3,5,1,'\\n---------- Cloture ----------\\ncloture',1,'2014-02-28',1,'BCD3',NULL,NULL,3,2),(9,2,5,3,'rezsrdfsfvdz zef',1,'2014-02-28',3,'CDE2',NULL,NULL,1,3),(10,2,8,3,'rezsrdfsfvdz zef',1,'2014-03-21',1,'CDE3',NULL,NULL,1,3),(82,1,21,1,'',1,NULL,NULL,'ALLF2','','',1,4),(83,2,22,1,'',1,'2014-02-27',2,'ALLA17','','',2,13),(84,1,20,1,'',1,NULL,NULL,'ALLJ2','','',3,5),(91,1,22,1,'',1,NULL,NULL,'ALLA19','','',2,1),(99,1,7,1,'',1,NULL,NULL,'ALLA20','','',2,1),(105,1,23,1,'',1,NULL,NULL,'ALLA21','','',2,1),(106,1,21,1,'',1,NULL,NULL,'ALLA22','','',2,1),(110,1,21,1,'',1,NULL,NULL,'ALLA24','','',1,1),(112,1,8,1,'',1,NULL,NULL,'ALLA25','','',2,1),(114,1,22,1,'',1,NULL,NULL,'ARTS2','','',1,7),(117,1,7,3,'',1,NULL,NULL,'ARLU2','','',3,8),(131,1,20,1,'',1,NULL,NULL,'ALLA26','','',1,1),(133,1,8,1,'',1,NULL,NULL,'ALLB9','','',1,2),(138,1,20,1,'',1,NULL,NULL,'ALLA27','','',1,1),(141,1,8,1,'',1,NULL,NULL,'2','','',1,1),(151,1,21,1,'',1,NULL,NULL,'ALLA28','','',1,1),(152,1,24,1,'',1,NULL,NULL,'ALLA29','','',1,1),(153,1,21,1,'',1,NULL,NULL,'ALLA30','','',1,1),(154,1,20,1,'',1,NULL,NULL,'ALLA31','','',1,1),(155,1,22,1,'',1,NULL,NULL,'ALLA32','','',1,1),(159,1,20,1,'souci d\'évier bouché',1,NULL,NULL,'ALLA34','1','a',1,1),(160,2,20,1,'',1,'2014-02-20',2,'ALLA35','54','',1,1),(161,2,21,1,'',1,'2014-02-21',2,'ALLA36','','',1,1),(162,1,22,1,'Test 3',2,NULL,NULL,'ALLA37','3','333',1,1),(165,1,21,3,'zetrrezqt',1,NULL,NULL,'ALLF3','5','A',1,4),(166,1,39,3,'',1,NULL,NULL,'ALLD8','','',1,3),(167,1,9,3,'Test<br />\r\nTest avec retour a la ligne<br />\r\nNouveau test avec nouveau retour a la ligne<br />\r\nDernier test avec dernier retour a la ligne',1,NULL,NULL,'ALLJ3','','',1,5),(168,1,36,1,'Test Historique',2,NULL,NULL,'ALLA38','','',1,1),(169,3,5,1,'Test Historique\\n---------- Cloture ----------\\n\\n---------- Cloture ----------\\nukkjhgfh\\n---------- Cloture ----------\\nukkjhgfh',1,'2014-02-20',3,'ALLA39','','',1,1),(170,3,8,1,'ceci est un test pour l\'historique update\\n---------- Cloture ----------\\nCloture ticket pour historique',2,'2014-02-20',3,'ALLA40','15','lionel',2,12),(171,1,13,1,'',2,NULL,NULL,'BEAU2','1','du directeur',2,11),(172,1,7,1,'',2,NULL,NULL,'ALLD9','','',2,3),(173,1,30,3,'Test',1,NULL,NULL,'STPI2','5566','Z',1,20),(174,1,21,1,'K',2,NULL,NULL,'OVER2','123','RZ',1,29),(175,1,24,3,'qzr',1,NULL,NULL,'ALLD10','','',1,3),(177,3,5,3,'\\n---------- Cloture ----------\\ncloture',1,'2014-02-28',1,'ARTS3','','',1,7),(178,1,11,1,'',2,NULL,NULL,'ALLB10','','',2,2),(179,1,5,1,'',2,NULL,NULL,'ALLB11','','',2,2),(180,1,9,1,'',2,NULL,NULL,'ALLB12','','',2,2),(181,1,5,1,'',2,NULL,NULL,'ALLS2','','',2,6),(182,1,5,1,'',2,NULL,NULL,'ALLF4','','',2,4),(183,1,25,1,'',2,NULL,NULL,'ALLD11','','',2,3),(184,3,31,1,'modif ticket\\n---------- Cloture ----------\\ncloture',2,'2014-02-20',2,'ASEV2','','',2,9),(185,1,5,1,'',2,NULL,NULL,'ALLF5','','',2,4),(187,1,9,1,'',2,NULL,NULL,'ALLB13','','',2,2),(188,1,7,3,'',1,NULL,NULL,'ARTS4','78852','MMO',1,7),(189,1,5,1,'',2,NULL,NULL,'ALLS3','','',2,6),(190,3,9,3,'\\n---------- Cloture ----------\\nAscenceur réparé',1,'2014-02-20',3,'BEAU3','','',1,11),(191,1,16,1,'Impossible de diminuer la température',2,NULL,NULL,'ALLD12','3','11',4,3),(192,1,6,1,'Ampoule à changer',2,NULL,NULL,'BVDW2','1','9',4,12),(193,1,25,3,'',1,NULL,NULL,'CINE2','8','3',3,16),(194,1,7,1,'',2,NULL,NULL,'WOPN2','4','5',4,41),(195,3,9,3,'Test pour historique\\n---------- Cloture ----------\\nCloture du ticket',1,'2014-02-26',3,'ALLD13','3','333',1,3),(196,1,33,3,'Parlophone en panne',1,NULL,NULL,'ROOM2','2','25',1,31),(197,1,25,3,'test',1,NULL,NULL,'WARE2','3','8',1,39);

/*Table structure for table `w3sys_user` */

DROP TABLE IF EXISTS `w3sys_user`;

CREATE TABLE `w3sys_user` (
  `id_user` int(10) NOT NULL AUTO_INCREMENT,
  `nom` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(32) NOT NULL,
  `fk_fonction` int(10) NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_w3sys_user_w3sys_fonction1_idx` (`fk_fonction`),
  CONSTRAINT `fk_w3sys_user_w3sys_fonction1` FOREIGN KEY (`fk_fonction`) REFERENCES `w3sys_fonction` (`id_fonction`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `w3sys_user` */

insert  into `w3sys_user`(`id_user`,`nom`,`email`,`password`,`fk_fonction`) values (0,'Default_user','z','z',1),(1,'Riduan Amar Ouaali','a@a.a','0cc175b9c0f1b6a831c399e269772661',2),(3,'Lionel','u@u.u','7b774effe4a349c6dd82ad4f4f21d34c',1),(4,'Emmanuel Capelle','e@e.e','e1671797c52e15f763380b45e841ec32',2),(5,'User','user','ee11cbb19052e40b07aac0ca060c23ee',1),(6,'Admin','admin','21232f297a57a5a743894a0e4a801fc3',2),(11,'rachid','rachid@r.be','0d2ece888a960b5f0351b27fea74e747',2);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
