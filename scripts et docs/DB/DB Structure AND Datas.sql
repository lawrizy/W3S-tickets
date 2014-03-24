/*
SQLyog Community Edition- MySQL GUI v6.52
MySQL - 5.5.23 : Database - db_ticketing
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `w3sys_batiment` */

DROP TABLE IF EXISTS `w3sys_batiment`;

CREATE TABLE `w3sys_batiment` (
  `id_batiment` int(10) NOT NULL AUTO_INCREMENT,
  `adresse` varchar(45) NOT NULL,
  `commune` varchar(45) NOT NULL,
  `cp` int(5) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `cpt` int(5) DEFAULT '1',
  `code` varchar(4) NOT NULL,
  `visible` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_batiment`),
  UNIQUE KEY `nom_UNIQUE` (`nom`),
  UNIQUE KEY `code_UNIQUE` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

/*Data for the table `w3sys_batiment` */

insert  into `w3sys_batiment`(`id_batiment`,`adresse`,`commune`,`cp`,`nom`,`cpt`,`code`,`visible`) values (1,'Boulevard de France 7 & 9','Braine l\'Alleud',1420,'Alliance A & C',46,'ALLA',1),(2,'Avenue de Finlande 2','Braine l\'Alleud',1420,'Alliance B',27,'ALLB',1),(3,'Place de Luxembourg 1-4','Braine l\'Alleud',1420,'Alliance D & E',30,'ALLD',1),(4,'Avenue de Finlande 4-6-8','Braine l\'Alleud',1420,'Alliance F & G',48,'ALLF',1),(5,'Avenue de Finlande 5-7-9','Braine l\'Alleud',1420,'Alliance J',19,'ALLJ',1),(6,'Boulevard de l\'Angleterre 2-4','Braine l\'Alleud',1420,'Alliance S',13,'ALLS',1),(7,'Avenue des Arts 44','Bruxelles',1040,'Arts 44',8,'ARTS',1),(8,'Avenue des Arts 58','Bruxelles',1040,'Arts&Lux',7,'ARLU',1),(9,'Rue de Genêve 1-3','Bruxelles',1140,'ASTRID - EVERE',6,'ASEV',1),(10,'Chaussée de Wavre 1789','Bruxelles',1160,'AUDERGHEM',2,'AUDE',1),(11,'Av. Beaulieu 1-3','Bruxelles',1160,'BEAULIEU',5,'BEAU',1),(12,'Bd. De Waterloo 38','Bruxelles',1050,'BOULEVARD DE WATERLOO',2,'BVDW',1),(13,'Bd. de l\'Industrie 14','Bruxelles',1070,'Brussels 1 Office',4,'B1OF',1),(14,'Rue des deux gares 150','Bruxelles',1070,'Brussels 2 Office',1,'B2OF',1),(15,'Rue de Loxum 25','Bruxelles',1000,'CENTRAL PLAZA',2,'CPLA',1),(16,'Rue du Marais 54-56','Bruxelles',1000,'CITEB NEW',2,'CINE',1),(17,'Bd. du Jardin Botanique 19','Bruxelles',1000,'CITY CENTER',1,'CICE',1),(18,'Avenue du Congo 7','Bruxelles',1000,'CONGO 7',1,'CONG',1),(19,'Av . de Cortenbergh 80','Bruxelles',1000,'CORTENBERGH',1,'CORT',1),(20,'Av. de Cortenbergh 60','Bruxelles',1000,'CRYSTAL',1,'CRYS',1),(21,'Rue Joseph Wauters 63','Hannut',4280,'HANNUT',1,'HANN',1),(22,'Guffenslaan 5-7-9','Hasselt',3500,'HASSELT',1,'HASS',1),(23,'Rue du Noyer - Pl.Jamblinne de Meux 221','Bruxelles',1030,'JAMBLINNE DE MEUX',1,'JAME',1),(24,'Rue de la Loi 102','Bruxelles',1040,'LOI 102',1,'LOII',1),(25,'Rue de la Fusée 100','Bruxelles',1130,'Mercure centre',1,'MECE',1),(26,'Rue des Bourgeois 7','Namur',5000,'NAMUR - BOURGEOIS',2,'NABO',1),(27,'Boulevard Simon Bolivar 34','Bruxelles',1000,'NORTH LIGHT',1,'NOLI',1),(28,'Mercuriusstraat 27','Nossegem',1930,'NOSSEGEM - Data Center',1,'NODC',1),(29,'Chaussée de la Hulpe 415','Overijse',3090,'OVERIJSE',2,'OVER',1),(30,'Pl. de l\'Université 16','Louvain-La-Neuve',1348,'PARC -UNIVERSITE L-L-N (LE)',1,'ULLN',1),(31,'Sq. F. Roosevelt 6','Mons',7000,'ROOSEVELT - MONS',2,'ROOM',1),(32,'Rue Royale 52','Bruxelles',1000,'ROYALE 52',1,'RO52',1),(33,'Rue Royale 54','Bruxelles',1000,'ROYALE 54',1,'RO54',1),(34,'Av. Louise 54-60','Bruxelles',1050,'STEPHANIE PLACE I',2,'STPI',1),(35,'Avenue Louise 59-69','Bruxelles',1050,'Stéphanie Square',1,'STSQ',1),(36,'Av. de Tervuren 2','Bruxelles',1040,'TERVUREN 2',1,'TER2',1),(37,'Culliganlaan 1','Diegem',1831,'Twin Square, Madison',1,'SMAD',1),(38,'Culliganlaan 1','Diegem',1831,'Twin Square, Vendôme',1,'SVEN',1),(39,'Rue Ernest Malvoz 649','Waremme',4300,'WAREMME',2,'WARE',1),(40,'Drève de Richelle 161','Waterloo',1410,'Waterloo Office Park, immeuble M',1,'WOPM',1),(41,'Drève de Richelle','Waterloo',1410,'Waterloo Office Park, immeuble N',2,'WOPN',1),(42,'Bd. de la Woluwe 2','Woluwe Saint Pierre',1150,'WOLUWE GATE',1,'WOGA',1),(43,'TEST NE PAS AFFICHER','TEST NE PAS AFFICHER',0,'TEST NE PAS AFFICHER',1,'TEST',0),(44,'1','1',1,'testBatiment',1,'1000',0),(49,'1','1',1,'test3',1,'AAAA',0),(51,'1','1',1,'test2',1,'AAAB',0);

/*Table structure for table `w3sys_canal` */

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
  `visible` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_categorie_incident`),
  KEY `fk_w3sys_categorie_incident_w3sys_categorie_incident1_idx` (`fk_parent`),
  KEY `fk_w3sys_categorie_incident_w3sys_priorite1_idx` (`fk_priorite`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

/*Data for the table `w3sys_categorie_incident` */

insert  into `w3sys_categorie_incident`(`id_categorie_incident`,`label`,`fk_parent`,`fk_priorite`,`visible`) values (1,'Sanitaire',NULL,1,1),(2,'Electricité',NULL,3,1),(3,'Ascenseurs',NULL,2,1),(4,'HVAC',NULL,3,1),(5,'Panne d\'électricité',2,1,1),(6,'Ampoule / néon défectueux',2,2,1),(7,'Fuite eau',1,3,1),(8,'WC bouché',1,3,1),(9,'Ascenseur en panne',3,3,1),(10,'Arrêt',3,2,1),(11,'Radiateur en panne',4,1,1),(12,'Local trop chaud',4,3,1),(13,'Local trop froid',4,2,1),(14,'Sécurité',NULL,3,1),(15,'Divers',NULL,1,1),(16,'Thermostat défectueux',4,1,1),(17,'Climatisation en panne',4,1,1),(18,'Fuite d\'eau au niveau du radiateur',4,1,1),(19,'Autre',4,2,1),(20,'Evier bouché',1,3,1),(21,'Chasse d\'eau défectueuse',1,2,1),(22,'Robinetterie défectueuse',1,3,1),(23,'Mauvaise odeur au niveau des canalisations',1,1,1),(24,'Autre',1,1,1),(25,'Prise défectueuse',2,3,1),(26,'Autre',2,3,1),(27,'Badge défectueux',14,2,1),(28,'Lecteur de badge défectueux',14,2,1),(29,'Problème d\'accès au batiment',14,2,1),(30,'Problème d\'accès au parking',14,3,1),(31,'Caméra défectueuse',14,1,1),(32,'Détecteur d\'incendie défectueux',14,2,1),(33,'Parlophone / visiophone défectueux',14,1,1),(34,'Porte bloquée',14,1,1),(35,'Autre',14,2,1),(36,'Nettoyage',15,2,1),(37,'Déblayage',15,2,1),(38,'Papier WC manquant',15,1,1),(39,'Produit sanitaire manquant',15,3,1),(40,'Autre',15,1,1);

/*Table structure for table `w3sys_controleur` */

DROP TABLE IF EXISTS `w3sys_controleur`;

CREATE TABLE `w3sys_controleur` (
  `id_controleur` int(10) NOT NULL AUTO_INCREMENT,
  `label` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id_controleur`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `w3sys_controleur` */

insert  into `w3sys_controleur`(`id_controleur`,`label`) values (1,'AdminController'),(2,'BatimentController'),(3,'CategorieIncidentController'),(4,'DashboardController'),(5,'EntrepriseController'),(6,'LieuController'),(7,'LocataireController'),(8,'TicketController'),(9,'TradController'),(10,'UserController');

/*Table structure for table `w3sys_droit` */

DROP TABLE IF EXISTS `w3sys_droit`;

CREATE TABLE `w3sys_droit` (
  `id_droit` int(10) NOT NULL AUTO_INCREMENT,
  `fk_controleur` int(10) DEFAULT NULL,
  `fk_user` int(10) DEFAULT NULL,
  `droits` int(4) DEFAULT '0',
  PRIMARY KEY (`id_droit`),
  KEY `fk_w3sys_droit_w3sys_controleur1_idx` (`fk_controleur`),
  KEY `fk_w3sys_droit_w3sys_user1_idx` (`fk_user`),
  CONSTRAINT `fk_w3sys_droit_w3sys_controleur1` FOREIGN KEY (`fk_controleur`) REFERENCES `w3sys_controleur` (`id_controleur`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_w3sys_droit_w3sys_user1` FOREIGN KEY (`fk_user`) REFERENCES `w3sys_user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=utf8;

/*Data for the table `w3sys_droit` */

insert  into `w3sys_droit`(`id_droit`,`fk_controleur`,`fk_user`,`droits`) values (1,1,1,3),(2,2,1,31),(3,3,1,127),(4,4,1,127),(5,5,1,63),(6,6,1,31),(7,7,1,127),(8,8,1,511),(9,9,1,15),(10,10,1,127),(11,1,14,3),(12,2,14,31),(13,3,14,127),(14,4,14,127),(15,5,14,63),(16,6,14,31),(17,7,14,127),(18,8,14,511),(19,9,14,15),(20,10,14,127),(21,1,15,3),(22,2,15,31),(23,3,15,127),(25,4,15,127),(26,5,15,63),(27,6,15,31),(28,7,15,127),(29,8,15,511),(30,9,15,15),(31,10,15,127),(32,1,13,0),(33,2,13,0),(34,3,13,0),(35,4,13,127),(36,5,13,0),(37,6,13,0),(38,7,13,0),(39,8,13,511),(40,9,13,0),(41,10,13,32),(42,1,4,0),(43,2,4,0),(44,3,4,0),(45,4,4,127),(46,5,4,0),(47,6,4,0),(48,7,4,0),(49,8,4,511),(50,9,4,0),(51,10,4,32),(52,1,6,0),(53,2,6,0),(54,3,6,0),(55,4,6,127),(56,5,6,0),(57,6,6,0),(58,7,6,0),(59,8,6,511),(60,9,6,0),(61,10,6,32),(62,1,11,0),(63,2,11,0),(64,3,11,0),(65,4,11,127),(66,5,11,0),(67,6,11,0),(68,7,11,0),(69,8,11,511),(70,9,11,0),(71,10,11,32),(72,1,12,0),(73,2,12,0),(74,3,12,0),(75,4,12,127),(76,5,12,0),(77,6,12,0),(78,7,12,0),(79,8,12,511),(80,9,12,0),(81,10,12,32),(82,1,3,0),(83,2,3,0),(84,3,3,0),(85,4,3,0),(86,5,3,0),(87,6,3,0),(88,7,3,17),(89,8,3,443),(90,9,3,0),(91,10,3,32),(92,1,5,0),(93,2,5,0),(94,3,5,0),(95,4,5,0),(96,5,5,0),(97,6,5,0),(98,7,5,17),(99,8,5,443),(100,9,5,0),(101,10,5,32),(112,1,17,0),(113,2,17,0),(114,3,17,0),(115,4,17,0),(116,5,17,0),(117,6,17,0),(118,7,17,128),(119,8,17,163),(120,9,17,0),(121,10,17,32),(122,1,18,0),(123,2,18,0),(124,3,18,0),(125,4,18,0),(126,5,18,0),(127,6,18,0),(128,7,18,128),(129,8,18,163),(130,9,18,0),(131,10,18,32),(133,1,19,0),(134,2,19,0),(135,3,19,0),(136,4,19,0),(137,5,19,0),(138,6,19,0),(139,7,19,128),(140,8,19,163),(141,9,19,0),(142,10,19,32);

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
  `visible` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_entreprise`),
  UNIQUE KEY `tva_UNIQUE` (`tva`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `w3sys_entreprise` */

insert  into `w3sys_entreprise`(`id_entreprise`,`nom`,`adresse`,`tva`,`commune`,`cp`,`tel`,`visible`) values (1,'Entreprise_defaut','Entreprise_defaut','Entreprise_defaut','Entreprise_defaut',0,'Entreprise_defaut',0),(2,'TEM','1, rue test','1111111111111111','Bruxelles',1000,'02191919',1),(3,'DALKIA','33, bvd de la cambre','0000000000000000','Jette',1090,'01234567',1),(4,'COFELY','247, rue fransman','2222222222222222','Laeken',1020,'98765432',1),(5,'KONE','Rue test, 1','9999999999','Commune test',9999,'02345345345',1),(6,'test','test','999999999','9',999,'999',0),(7,'test','999','99','99',9,'9',0);

/*Table structure for table `w3sys_fonction` */

DROP TABLE IF EXISTS `w3sys_fonction`;

CREATE TABLE `w3sys_fonction` (
  `id_fonction` int(10) NOT NULL AUTO_INCREMENT,
  `label` varchar(45) NOT NULL,
  PRIMARY KEY (`id_fonction`),
  UNIQUE KEY `label_UNIQUE` (`label`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `w3sys_fonction` */

insert  into `w3sys_fonction`(`id_fonction`,`label`) values (2,'Admin'),(4,'Locataire'),(3,'Root'),(1,'User');

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
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8;

/*Data for the table `w3sys_historique_ticket` */

insert  into `w3sys_historique_ticket`(`id_historique_ticket`,`date_update`,`fk_ticket`,`fk_statut_ticket`,`fk_user`) values (3,'2014-02-26 19:58:30',264,1,1),(4,'2014-02-27 15:07:50',202,3,4),(5,'2014-02-27 17:51:52',265,1,1),(6,'2014-02-27 17:52:20',266,1,1),(7,'2014-02-28 14:16:58',267,1,1),(8,'2014-02-28 15:07:55',198,1,1),(9,'2014-02-28 15:08:31',198,1,1),(10,'2014-02-28 15:08:41',198,1,1),(11,'2014-03-03 16:43:18',268,1,1),(12,'2014-03-04 13:40:06',205,2,1),(13,'2014-03-04 15:56:20',269,1,1),(14,'2014-03-04 15:56:52',270,1,1),(15,'2014-03-04 19:42:28',271,1,1),(16,'2014-03-04 19:43:26',271,2,1),(17,'2014-03-04 19:43:47',271,3,1),(18,'2014-03-07 10:47:35',272,1,1),(19,'2014-03-07 12:36:15',198,2,1),(20,'2014-03-07 12:38:14',198,2,1),(21,'2014-03-10 19:34:20',273,1,1),(22,'2014-03-10 19:44:16',274,1,1),(23,'2014-03-12 10:42:51',275,1,1),(24,'2014-03-12 10:50:13',276,1,1),(25,'2014-03-12 10:50:49',276,2,1),(26,'2014-03-13 15:59:23',277,1,1),(27,'2014-03-13 16:00:43',278,1,1),(28,'2014-03-13 15:01:29',279,1,15),(29,'2014-03-13 16:24:23',280,1,1),(30,'2014-03-13 15:45:49',281,1,15),(31,'2014-03-15 12:00:44',282,1,15),(32,'2014-03-15 12:01:50',282,2,15),(33,'2014-03-15 12:07:42',200,2,15),(34,'2014-03-18 11:41:41',218,2,15),(35,'2014-03-19 11:12:11',283,1,15),(36,'2014-03-19 11:12:39',284,1,15),(37,'2014-03-19 11:12:55',284,2,15),(38,'2014-03-19 16:38:10',285,1,15),(39,'2014-03-19 16:38:22',285,2,15),(40,'2014-03-19 16:38:31',285,3,15),(41,'2014-03-19 16:45:04',198,3,15),(42,'2014-03-19 16:47:35',286,1,1),(43,'2014-03-19 16:48:17',286,2,15),(44,'2014-03-19 16:48:25',286,3,15),(45,'2014-03-19 16:50:26',287,1,1),(46,'2014-03-19 16:51:20',287,2,15),(47,'2014-03-19 16:51:28',287,3,15),(48,'2014-03-20 15:04:19',288,1,1),(49,'2014-03-20 15:12:00',289,1,15),(50,'2014-03-20 15:43:56',199,2,15),(51,'2014-03-20 15:44:04',199,3,15),(52,'2014-03-20 16:40:43',203,2,15),(53,'2014-03-20 16:40:54',203,3,15),(54,'2014-03-21 09:10:28',290,1,15),(55,'2014-03-21 09:11:43',291,1,15),(56,'2014-03-21 09:14:35',292,1,15),(57,'2014-03-21 15:06:54',296,1,14),(58,'2014-03-21 15:07:24',297,1,14),(59,'2014-03-21 15:07:52',297,2,14),(60,'2014-03-21 15:08:15',297,3,14),(61,'2014-03-21 16:00:00',298,1,1),(62,'2014-03-21 15:25:56',299,1,15),(63,'2014-03-21 15:25:56',300,1,15),(64,'2014-03-21 15:25:56',301,1,15),(65,'2014-03-21 15:25:57',302,1,15),(66,'2014-03-21 15:25:57',303,1,15),(67,'2014-03-21 15:25:57',304,1,15),(68,'2014-03-21 15:25:57',305,1,15),(69,'2014-03-21 15:25:57',306,1,15),(70,'2014-03-21 15:25:57',307,1,15),(71,'2014-03-21 15:25:58',308,1,15),(72,'2014-03-21 15:25:58',309,1,15),(73,'2014-03-21 15:25:58',310,1,15),(74,'2014-03-21 15:25:58',311,1,15),(75,'2014-03-21 15:25:58',312,1,15),(76,'2014-03-21 15:25:58',313,1,15),(77,'2014-03-21 15:25:58',314,1,15),(78,'2014-03-21 15:40:46',315,1,15),(79,'2014-03-21 17:19:36',316,1,1),(80,'2014-03-24 10:22:22',317,1,1);

/*Table structure for table `w3sys_langue` */

DROP TABLE IF EXISTS `w3sys_langue`;

CREATE TABLE `w3sys_langue` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `label` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `w3sys_langue` */

insert  into `w3sys_langue`(`id`,`label`) values (1,'FR'),(2,'EN'),(3,'NL');

/*Table structure for table `w3sys_lieu` */

DROP TABLE IF EXISTS `w3sys_lieu`;

CREATE TABLE `w3sys_lieu` (
  `id_lieu` int(10) NOT NULL AUTO_INCREMENT,
  `fk_batiment` int(10) NOT NULL,
  `visible` tinyint(1) DEFAULT '1',
  `fk_locataire` int(10) NOT NULL,
  PRIMARY KEY (`id_lieu`),
  KEY `fk_w3sys_lieu_w3sys_batiment1_idx` (`fk_batiment`),
  KEY `fk_w3sys_lieu_w3sys_user1_idx` (`fk_locataire`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

/*Data for the table `w3sys_lieu` */

insert  into `w3sys_lieu`(`id_lieu`,`fk_batiment`,`visible`,`fk_locataire`) values (1,1,0,17),(2,1,0,17),(3,4,0,17),(4,3,0,17),(5,6,0,17),(6,2,0,17),(7,5,0,17),(8,7,0,17),(9,8,0,17),(10,9,0,17),(11,10,0,17),(12,10,0,17),(13,10,0,17),(14,10,0,17),(15,11,0,17),(16,11,0,17),(17,11,0,17),(18,11,0,17);

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
  `id_secteur` int(10) NOT NULL AUTO_INCREMENT,
  `fk_categorie` int(10) NOT NULL,
  `visible` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_secteur`),
  KEY `fk_w3sys_secteur_w3sys_entreprise1_idx` (`fk_entreprise`),
  KEY `fk_w3sys_secteur_w3sys_categorie_incident1_idx` (`fk_categorie`),
  CONSTRAINT `fk_w3sys_secteur_w3sys_categorie_incident1` FOREIGN KEY (`fk_categorie`) REFERENCES `w3sys_categorie_incident` (`id_categorie_incident`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_w3sys_secteur_w3sys_entreprise1` FOREIGN KEY (`fk_entreprise`) REFERENCES `w3sys_entreprise` (`id_entreprise`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `w3sys_secteur` */

insert  into `w3sys_secteur`(`fk_entreprise`,`id_secteur`,`fk_categorie`,`visible`) values (2,1,1,1),(5,2,3,1),(3,3,4,0),(4,4,2,1),(2,7,15,0);

/*Table structure for table `w3sys_session` */

DROP TABLE IF EXISTS `w3sys_session`;

CREATE TABLE `w3sys_session` (
  `id_session` int(10) NOT NULL AUTO_INCREMENT,
  `fk_yiisession` char(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  PRIMARY KEY (`id_session`),
  KEY `fk_w3sys_session_yiisession1_idx` (`fk_yiisession`),
  CONSTRAINT `fk_w3sys_session_yiisession1` FOREIGN KEY (`fk_yiisession`) REFERENCES `yiisession` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

/*Data for the table `w3sys_session` */

insert  into `w3sys_session`(`id_session`,`fk_yiisession`,`email`) values (17,'bled53ej2291j22kr513toqig2','desaedeleerlionel@hotmail.com');

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
  `date_intervention` date DEFAULT NULL,
  `fk_entreprise` int(10) DEFAULT NULL,
  `code_ticket` varchar(10) NOT NULL,
  `etage` varchar(45) DEFAULT NULL,
  `bureau` varchar(45) DEFAULT NULL,
  `fk_batiment` int(10) NOT NULL,
  `fk_priorite` int(10) NOT NULL,
  `fk_locataire` int(10) NOT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `fk_canal` int(10) NOT NULL,
  PRIMARY KEY (`id_ticket`),
  UNIQUE KEY `code_ticket_UNIQUE` (`code_ticket`),
  KEY `fk_w3sys_ticket_w3sys_statut_ticket1_idx` (`fk_statut`),
  KEY `fk_w3sys_ticket_w3sys_categorie_incident1_idx` (`fk_categorie`),
  KEY `fk_w3sys_ticket_w3sys_user1_idx` (`fk_user`),
  KEY `fk_w3sys_ticket_w3sys_entreprise1_idx` (`fk_entreprise`),
  KEY `fk_w3sys_ticket_w3sys_batiment1_idx` (`fk_batiment`),
  KEY `fk_w3sys_ticket_w3sys_priorite1_idx` (`fk_priorite`),
  KEY `fk_w3sys_ticket_w3sys_user2_idx` (`fk_locataire`),
  KEY `fk_w3sys_ticket_w3sys_canal1_idx` (`fk_canal`)
) ENGINE=InnoDB AUTO_INCREMENT=318 DEFAULT CHARSET=utf8;

/*Data for the table `w3sys_ticket` */

insert  into `w3sys_ticket`(`id_ticket`,`fk_statut`,`fk_categorie`,`fk_user`,`descriptif`,`date_intervention`,`fk_entreprise`,`code_ticket`,`etage`,`bureau`,`fk_batiment`,`fk_priorite`,`fk_locataire`,`visible`,`fk_canal`) values (198,3,21,1,' ---------- Cloture ---------- -\r\n','2014-03-12',2,'ALLB14','','',2,1,18,1,2),(199,3,9,1,'Test Traitement ---------- Cloture ---------- qzmoeithetioh','2014-03-20',5,'B1OF2','7','652',13,1,17,1,1),(200,2,25,1,'','2014-03-29',4,'ALLA41','','',1,1,18,1,2),(201,2,5,1,'','2014-02-24',2,'ALLD14','','',3,1,18,1,2),(202,3,29,1,' ---------- Cloture ---------- test','2014-02-26',5,'ALLF6','','',4,1,18,1,2),(203,3,9,1,' ---------- Cloture ---------- 9999999\r\n','2014-03-21',5,'ALLB15','','',2,1,17,1,1),(204,1,12,4,'',NULL,NULL,'ALLA42','','',1,1,19,1,1),(205,2,21,4,'','2014-03-12',3,'ASEV3','','',9,1,19,1,1),(206,1,21,4,'',NULL,NULL,'ASEV4','','',9,1,19,1,1),(207,1,17,4,'',NULL,NULL,'ALLF7','','',4,1,19,1,1),(208,1,17,4,'',NULL,NULL,'ALLF8','','',4,1,19,1,1),(209,1,17,4,'',NULL,NULL,'ALLF9','','',4,1,19,1,1),(210,1,17,4,'',NULL,NULL,'ALLF10','','',4,1,19,1,1),(211,1,17,4,'',NULL,NULL,'ALLF11','','',4,1,19,1,1),(212,1,17,4,'',NULL,NULL,'ALLF12','','',4,1,19,1,1),(213,1,17,4,'',NULL,NULL,'ALLF13','','',4,1,19,1,1),(214,1,9,4,'',NULL,NULL,'ALLS4','','',6,1,19,1,1),(215,1,9,4,'',NULL,NULL,'ALLS5','','',6,1,19,1,1),(216,1,9,4,'',NULL,NULL,'ALLS6','','',6,1,19,1,1),(217,1,11,4,'',NULL,NULL,'AUDE2','','',10,1,19,1,1),(218,2,9,4,'','2014-03-19',5,'ALLF14','','',4,1,18,1,1),(219,1,9,4,'',NULL,NULL,'ALLS7','','',6,1,18,1,1),(220,1,5,4,'',NULL,NULL,'ALLS8','','',6,1,18,1,1),(221,1,11,4,'',NULL,NULL,'ALLJ4','','',5,1,18,1,1),(222,1,27,4,'',NULL,NULL,'ARTS5','','',7,1,18,1,1),(223,1,18,4,'',NULL,NULL,'ALLS9','','',6,1,18,1,1),(224,1,11,4,'',NULL,NULL,'ARTS6','','',7,1,18,1,1),(225,1,11,4,'',NULL,NULL,'ALLJ5','','',5,1,18,1,1),(226,1,11,4,'',NULL,NULL,'ALLD15','','',3,1,18,1,1),(227,1,27,4,'',NULL,NULL,'ALLJ6','','',5,1,18,1,1),(228,1,9,4,'',NULL,NULL,'ALLD16','','',3,1,18,1,1),(229,2,6,4,'','2014-02-25',4,'ALLD17','','',3,1,18,1,1),(230,1,9,4,'',NULL,NULL,'ALLD18','','',3,1,18,1,1),(231,1,9,4,'',NULL,NULL,'ARLU3','','',8,1,17,1,1),(232,1,9,4,'',NULL,NULL,'ARLU4','','',8,1,17,1,1),(233,1,9,4,'',NULL,NULL,'ARLU5','','',8,1,17,1,1),(234,1,39,4,'',NULL,NULL,'ARLU6','','',8,1,17,1,1),(235,1,38,4,'',NULL,NULL,'ALLS10','','',6,1,17,1,1),(236,2,7,4,'','2014-02-25',2,'ALLF15','','',13,1,17,1,1),(237,1,9,4,'',NULL,NULL,'ARTS7','','',7,1,19,1,1),(238,1,9,4,'',NULL,NULL,'ALLJ7','','',5,1,19,1,1),(239,1,9,4,'',NULL,NULL,'ALLS11','','',6,1,17,1,1),(264,1,5,1,'Yo Lionel, c\'est juste un ticket créé pour un test ;-) Ridounet',NULL,NULL,'ALLF22','1','web3sys',4,1,18,1,1),(265,1,5,1,'',NULL,NULL,'ALLD22','','',3,1,18,1,2),(266,1,5,1,'',NULL,NULL,'ALLD23','','',3,1,18,1,2),(267,1,26,1,'rtuti',NULL,NULL,'ALLJ13','','',5,1,18,1,2),(268,1,10,1,'sfdqsdsqd',NULL,NULL,'B1OF4','','',13,1,18,1,2),(269,1,16,1,'',NULL,NULL,'ALLB18','','',2,1,17,1,1),(270,1,39,1,'',NULL,NULL,'ALLB19','','',2,1,18,1,1),(271,3,9,1,' ---------- Cloture ---------- Test','2014-03-05',4,'ALLD24','','',3,1,17,1,1),(272,1,7,1,'',NULL,NULL,'ALLD25','','',3,1,18,1,2),(273,1,10,1,'',NULL,NULL,'ALLF23','','',4,1,17,0,1),(274,1,27,1,'',NULL,NULL,'ALLB20','','',2,1,17,0,1),(275,1,21,1,'c',NULL,NULL,'NABO2','a','b',26,1,18,0,1),(276,2,13,1,'','2014-03-19',3,'ALLD26','','',3,1,18,0,1),(277,1,5,1,'',NULL,NULL,'ALLD27','','',3,1,18,0,2),(278,1,11,1,'',NULL,NULL,'ALLJ14','','',5,1,18,0,1),(279,1,5,15,'',NULL,NULL,'ALLD28','','',3,1,18,0,1),(280,1,9,1,'',NULL,NULL,'ARTS8','','',7,3,18,0,2),(281,1,11,15,'',NULL,NULL,'ALLJ15','','',5,1,18,0,1),(282,2,9,15,'','2014-03-18',5,'ALLJ16','','',5,3,18,1,1),(283,1,9,15,'',NULL,NULL,'ALLS12','','',6,3,17,1,1),(284,2,9,15,'','2014-03-20',5,'ALLS13','','',6,3,17,1,1),(285,3,11,15,' ---------- Cloture ---------- Tout va bien.','2014-03-20',3,'ALLF25','','',4,1,17,1,1),(286,3,5,1,' ---------- Cloture ---------- test','2014-03-31',4,'ALLF26','','',4,1,18,1,2),(287,3,11,1,' ---------- Cloture ---------- test','2014-03-20',3,'ALLF27','','',4,1,19,1,2),(288,1,5,1,'',NULL,NULL,'ALLB21','','',2,1,19,1,2),(289,1,11,15,'',NULL,NULL,'ALLF28','','',4,1,19,1,1),(290,1,7,15,'',NULL,NULL,'ALLF29','','',4,3,18,1,1),(291,1,9,15,'',NULL,NULL,'ALLF30','','',4,3,19,1,1),(292,1,7,15,'',NULL,NULL,'ALLD29','','',3,3,19,1,1),(293,1,5,15,'',NULL,NULL,'ALLJ18','','',5,1,17,1,1),(294,1,9,14,'',NULL,NULL,'ALLB23','','',2,3,18,1,1),(295,1,9,14,'',NULL,NULL,'ALLB24','','',2,3,18,1,1),(296,1,9,14,'',NULL,NULL,'ALLB25','','',2,3,18,1,1),(297,3,9,14,' ---------- Cloture ---------- fsqksdfqkjgfsqjkfsdqkj ---------- Cloture ---------- fsqksdfqkjgfsqjkfsdqkj','2014-03-22',5,'ALLB26','','',2,3,18,1,1),(298,1,25,1,'',NULL,NULL,'ALLB27','','',2,3,17,1,2),(299,1,5,15,'',NULL,NULL,'ALLF32','','',4,1,17,1,1),(300,1,5,15,'',NULL,NULL,'ALLF33','','',4,1,17,1,1),(301,1,5,15,'',NULL,NULL,'ALLF34','','',4,1,17,1,1),(302,1,5,15,'',NULL,NULL,'ALLF35','','',4,1,17,1,1),(303,1,5,15,'',NULL,NULL,'ALLF36','','',4,1,17,1,1),(304,1,5,15,'',NULL,NULL,'ALLF37','','',4,1,17,1,1),(305,1,5,15,'',NULL,NULL,'ALLF38','','',4,1,17,1,1),(306,1,5,15,'',NULL,NULL,'ALLF39','','',4,1,17,1,1),(307,1,5,15,'',NULL,NULL,'ALLF40','','',4,1,17,1,1),(308,1,5,15,'',NULL,NULL,'ALLF41','','',4,1,17,1,1),(309,1,5,15,'',NULL,NULL,'ALLF42','','',4,1,17,1,1),(310,1,5,15,'',NULL,NULL,'ALLF43','','',4,1,17,1,1),(311,1,5,15,'',NULL,NULL,'ALLF44','','',4,1,17,1,1),(312,1,5,15,'',NULL,NULL,'ALLF45','','',4,1,17,1,1),(313,1,5,15,'',NULL,NULL,'ALLF46','','',4,1,17,1,1),(314,1,5,15,'',NULL,NULL,'ALLF47','','',4,1,17,1,1),(315,1,7,15,'',NULL,NULL,'ALLA44','','',1,3,17,1,1),(316,1,19,1,'',NULL,NULL,'ALLF48','','',4,2,17,1,2),(317,1,10,1,'',NULL,NULL,'ALLJ19','','',5,2,17,1,2);

/*Table structure for table `w3sys_trad` */

DROP TABLE IF EXISTS `w3sys_trad`;

CREATE TABLE `w3sys_trad` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fr` varchar(128) DEFAULT NULL,
  `en` varchar(128) DEFAULT NULL,
  `nl` varchar(128) DEFAULT NULL,
  `code` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code_UNIQUE` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=165 DEFAULT CHARSET=utf8;

/*Data for the table `w3sys_trad` */

insert  into `w3sys_trad`(`id`,`fr`,`en`,`nl`,`code`) values (1,'','','',''),(2,'Action(s)','Action(s)','Actie(s)','Actions'),(3,'Tickets cloturés','Tickets closed','Tickets gesloten','AdminClosedTitre'),(4,'Tickets en cours de traitement','Tickets in progress','Tickets in uitvoering','AdminInProgressTitre'),(5,'Nouveaux tickets ','New tickets','Nieuwe tickets','AdminOpenedTitre'),(6,'Tous les tickets','All tickets','Alle tickets','AdminTitre'),(7,'Tickets en cours de traitement','Tickets in progress ','Tickets in uitvoering ','AdminTraitementTitre'),(8,'Nombre de ticket par entreprises (pour tous les tickets)','Ticket\'s number by entreprise (all tickets)','Aantal tickets per vennootschap (alle tickets)','AjaxFrenquenceEntreprise'),(9,'Nombre de ticket par statut (Bâtiment: ','Ticket\'s number by status (Building: ','Aantal tickets per staat (Gebouw: ','AjaxFrequenceStatutTicket'),(10,'Nombre de ticket par catégorie (Bâtiment : ','Ticket\'s number by categorie (Building : ','Aantal tickets per categorie (Gebouw : ','AjaxFrequenceUnBatiment'),(11,' cloturé(s)',' closed',' gesloten','AjaxStatutClosed'),(12,' en cours de traitement',' in progress',' aan de gang','AjaxStatutInProgress'),(13,' nouveau(x)',' new',' nieuw','AjaxStatutNew'),(14,'Nombre de ticket par statut (Tous les bâtiments)','Ticket\'s number by status  (all buildings)','Aantal tickets per staat (alle gebouwen)','AjaxStatutTicket'),(15,'Nombre de ticket par catégorie (Tous les bâtiments)','Ticket\'s number by categorie (all buildings)','Aantal tickets per categorie (alle gebouwen)','AjaxTitre'),(16,'Tous les bâtiments','All buildings','Alle gebouwen','AllBatiment'),(17,'Tous les canaux','All channels','Alle kanalen','AllCanal'),(18,'Ampoule / néon défectueux','Bulb /defective neon','Gloeilamp /defecte neon','Ampoule / néon défectueux'),(19,'A Propos','About','Over ons','APropos'),(20,'Arrêt','Stuck','Stop','Arrêt'),(21,'Ascenseur en panne','Stuck lift','Kapotte lift','Ascenseur en panne'),(22,'Ascenseurs','Lift','Lift','Ascenseurs'),(23,'Autre','Other','Aanderen','Autre'),(24,'Badge défectueux','Defective badge','Defecte badge','Badge défectueux'),(25,'Bâtiment','Building','Gebouw','BatimentTicket'),(26,'B&acirc;timent','Building','Gebouw','BatimentTicketCirc'),(27,'Bureau','Office','Officie','BureauTicket'),(28,'Cloturer le ticket','Close ticket','Sluit het ticket','ButtonClose'),(29,'Créer','Create','Maaken','ButtonCreer'),(30,'Passer en traitement','Put in progress','Voeren behandeling','ButtonTraitement'),(31,'Caméra défectueuse','Defective security camera','Defecte camera','Caméra défectueuse'),(32,'Voie de création','Way of creation','Manier van de schepping','CanalTicket'),(33,'Sous-cat&eacute;gorie','Sub-category','Subcategorie','CategorieTicket'),(34,'Cat&eacute;gorie','Category','Categorie','CategTicket'),(35,'Chasse d\'eau défectueuse','Defective flush','Defecte waterspoeling','Chasse d\'eau défectueuse'),(36,'Climatisation en panne','Broken down air conditioner','Uitgesplitst airconditioner','Climatisation en panne'),(37,'Clôture du ticket ','Closing of ticket ','Sluitend van ticket ','CloseTitre'),(38,'Cloturé','Closed ','Gesloten','Cloturé'),(39,'Code du ticket','Ticket code ','Ticket code ','CodeTicket'),(40,'Connexion','Login','Inloggen','Connexion'),(41,'Connexion','Login','Inloggen','ConnexionButton'),(42,'Connexion','Login','Inloggen','ConnexionTitre'),(43,'Contact','Contact','Contact','Contact'),(44,'Créer un bâtiment','Create a building','Maaken een gebouw','CreateBatiment'),(45,'Créer un nouveau ticket','Create a new ticket','Maaken een nieuw ticket','CreateTitre'),(46,'Créer','Create','Creer','Creer'),(47,'Créer un locataire','Create a locataire','Maak een huurder','CreerLocataire'),(48,'Créer un nouveau ticket','Create a new ticket','Maak een nieuw ticket','CreerTicket'),(49,'Créer un utilisateur','Create a user','Maaken een gebruiker','CreerUtilisateur'),(50,'Tableaux de bord','Dashboard','Dashboard','DashBoard'),(51,'Date d\'intervention ',' Intervention date','Interventie datum','DateIntervention'),(52,'Date d\'intervention','Response time /!\\ ','Reactie datum','DateInterventionTicket'),(53,'Déblayage','Clearing','Uitmesten','Déblayage'),(54,'Déconnexion','Logout','Uitloggen','DeConnexion'),(55,'Description','Description','Beschrijving','DescriptifTicket'),(56,'Détecteur d\'incendie défectueux','Defective fire alarm','Brandmelder defect','Détecteur d\'incendie défectueux'),(57,'Divers','Miscellaneous','Diversen','Divers'),(58,'Tous Droits Réservés.','All Rights Reserved.','Alle rechten voorbehouden.','DroitsReserve'),(59,'Electricité','Electricity','Elektriciteit','Electricité'),(60,'Email : ','Email : ','Email : ','EmailForm'),(61,'Email','Email','Email','EmailUser'),(62,'En Traitement','In Treatment ','aan de gang','En Traitement'),(63,'Sous-traitant','Subcontractor','Onderaannemer','EntrepriseTicket'),(64,'Etage','Floor','Verdieping','EtageTicket'),(65,'Evier bouché','Blocked sink','Verstopte gootsteen','Evier bouché'),(66,'(pour voir, modifier ou supprimer un Bâtiment)','(to view, modify or delete a Building)','(om te bekijken, wijzigen of verwijderen van een gebouw)','ExplicationBatiment'),(67,'(pour voir, modifier ou supprimer un sous-traitant)','(to view, modify or delete a subcontractor)','(om te bekijken, wijzigen of verwijderen van een onderaannemer)','ExplicationEntreprise'),(68,'(pour voir, modifier ou supprimer un locataire)','(to view, modify or delete a roomer)','(om te bekijken, wijzigen of verwijderen van een huurder)','ExplicationLocataire'),(69,'(pour voir, traiter, clôturer ou supprimer un Ticket)','(to view, process, close or remove a Ticket)','(om te bekijken, verwerken, te sluiten of verwijderen van een ticket)','ExplicationTicket'),(70,'(pour voir, modifier ou supprimer un utilisateur)','(to view, modify or delete a user)','(om te bekijken, wijzigen of verwijderen van een gebruiker)','ExplicationUtilisateur'),(71,'Fonction de l\'utilisateur','User\'s function','Gebruikersfunctie ','FonctionUser'),(72,'Fuite d\'eau au niveau du radiateur','Radiator leaking water','Waterlek in de radiator','Fuite d\'eau au niveau du radiateur'),(73,'Fuite eau','Water leak','Water Lek','Fuite eau'),(74,'Gestion de l\'application','Application Management','Application Management','GestionApplication'),(75,'Graphique','Graphic','Grafisch','Graphique'),(76,'HVAC','HVAC','HVAC','HVAC'),(77,'Nom du locataire','Roomer\'s name','Naam van de huurder','IdLoc'),(78,'Id du ticket','Ticket \'s Id','Id van het ticket','IdTicket'),(79,'Id Utilisateur','User\'s Id','Id van de gebruiker','IdUser'),(80,'Remplissez les champs avec vos données de connexion:','Please fill out the following form with your login credentials:','Vul het onderstaande formulier in met uw inloggegevens:','Indication'),(81,'Langage','Language','Taal','LanguageUser'),(82,'Lecteur de badge défectueux','Defective badge reader','Speler defect badge','Lecteur de badge défectueux'),(83,'Liste des Bâtiments','Building\'s list','Lijst van de gebouwen','ListBatiment'),(84,'Liste des sous-traitants','Subcontractor\'s list','Lijst van onderaannemers','ListeSousTraitant'),(85,'Liste des tickets','Tickets\' list','Overzicht van de tickets','ListeTicket'),(86,'Liste des locataires','Roomer\'s list','lijst van de huurders','ListLocataire'),(87,'Liste des utilisateurs','User\'s list','Lijst van de gebruikers','ListUtilisateur'),(88,'Local trop chaud','Room too hot','Lokaal te warm','Local trop chaud'),(89,'Local trop froid','Room too cold','Lokaal te koud','Local trop froid'),(90,'Locataire','Roommate','Huurders','LocataireTicket'),(91,'Mauvaise odeur au niveau des canalisations','Foul smell in the piping','Slechte geur in leidingen','Mauvaise odeur au niveau des canalisations'),(92,'Mot de passe: ','Password: ','Passwoord :  ','Mdp'),(93,'Mot de passe: ','Password: ','Passwoord :  ','MdpForm'),(94,'Mot de passe','Password','Passwoord','MdpLoc'),(95,'Mot de passe oublié ?','Forgot password ?','Passwoord vergeten ?\'','MdpOublie'),(96,'Mot de passe','Password','Passwoord','MdpUser'),(97,'Cloturer le ticket ','Close the ticket ','Sluit het ticket ','MenuCloseTicket'),(98,'Créer un ticket','Create a ticket','Maak een ticket','MenuCreerTicket'),(99,'Mettre en traitement','Put in progress','Zetten in uitvoering','MenuMettreEnTraitementTicket'),(100,'Modifier le ticket','Modify the ticket ','Wijzigen van een ticket ','MenuModifierTicket'),(101,'Effacer ce ticket','Delete this ticket','Verwijder dit ticket','MenuTicketDelete'),(102,'Tickets en cours de traitement','Tickets in progress','Tickets in uitvoering','MenuTicketEnCours'),(103,'Tickets cloturés','Tickets closed','Tickets gesloten','MenuTicketFerme'),(104,'Nouveaux tickets','New tickets','Nieuw ticketsTickets gesloten','MenuTicketNouveau'),(105,'Tous les tickets','All tickets','Alle tickets','MenuTicketTout'),(106,'Bienvenue sur ','Welcome on ','Welkom op ','Message'),(107,'Nettoyage','Cleaning','Schoonmaken','Nettoyage'),(108,'Nom','Name','Naam','NomLoc'),(109,'Nom','Name','Naam','NomUser'),(110,'Nouveau','New','Nieuw','Nouveau'),(111,'Panne d\'électricité','Electricity breakdown','Uitsplitsing elektriciteit','Panne d\'électricité'),(112,'Papier WC manquant','Missing toilet paper','Papier ontbrekende wc','Papier WC manquant'),(113,'par','by','bij','Par'),(114,'Parlophone / visiophone défectueux','Defective videophone','Intercom / videofoon defect','Parlophone / visiophone défectueux'),(115,'Téléphone','Phone','Telefoon','Phone'),(116,'Porte bloquée','Stuck door','Geblokkeerde deur','Porte bloquée'),(117,'Prise défectueuse','Defective plug','Defecte beslissing','Prise défectueuse'),(118,'Problème d\'accès au batiment','Building access problem','Probleem van de toegang tot het gebouw','Problème d\'accès au batiment'),(119,'Problème d\'accès au parking','Parking access problem','Probleem van de toegang tot de parkeerplaats','Problème d\'accès au parking'),(120,'Produit sanitaire manquant','Missing detergent','Sanitizer vermist','Produit sanitaire manquant'),(121,'Radiateur en panne','Broken down radiator','Radiator beneden','Radiateur en panne'),(122,'Recherche avancée','Advanced search','Geavanceerd zoeken','RechercheAvancee'),(123,'Veuillez régler les problèmes suivants','Please fix the following problems','Please fix de volgende problemen','ReglerProbleme'),(124,'Les champs avec <span class=\"required\">*</span> sont obligatoire.','Fields with <span class=\"required\">*</span> are required.','Velden met <span class=\"required\">*</span>   verplicht.','Required'),(125,'Robinetterie défectueuse','Defective plumbing','Kleppen defect','Robinetterie défectueuse'),(126,'Sanitaire','Sanitary','Sanitair','Sanitaire'),(127,'Sécurité','Security','Veiligheid','Sécurité'),(128,'Sélectionnez un bâtiment pour filtrer les résultats:','Select a building to filter results: ','Selecteer een bouwen om resultaten te filteren:  ','SelectionnerBat'),(129,'Sélectionner un bâtiment:','Select a building: ','Selecteer een gebouw: ','SelectionnerBatiment'),(130,'Sélectonner une catégorie:','Select a category: ','Selecteer een categorie: ','SelectionnerCategorie'),(131,'Se rappeler de moi','Remember me','Onthoud mij','SeSouvenir'),(132,'Sous-traitant','Subcontractors','Onderaannemers','SousTraitant'),(133,'Statut','Status','Staat','StatutTicket'),(134,'Thermostat défectueux','Defective thermostat','Defecte thermostaat','Thermostat défectueux'),(135,'Tableau de bord','Dashboard','Dashboard','TitreDashboard'),(136,'Traitement du Ticket:  ','Ticket\'s processing:  ','Behandeling van Ticket:  ','TraitementTitre'),(137,'Assigné à','Assigned to ','Gedefineerd','UserTicket'),(138,'Assign&eacute; à','Assigned to ','Gedefineerd','UserTicketCirc'),(139,'Utilisateur','User','Gebruiker','Utilisateur'),(140,'Date de mise à jour','Update date','Update datum','ViewHistoriqueDate'),(141,'Historique','History','Historie','ViewHistoriqueTitre'),(142,'Type','Type','Type','ViewHistoriqueType'),(143,'Ticket : ','Ticket : ','Ticket : ','ViewTitre'),(144,'WC bouché','Blocked WC','Verstopte WC','WC bouché'),(145,'Web','Web','Web','Web'),(146,'Vue','View','Zicht','Vue'),(148,'Français','French','Frans','Fr'),(149,'Néérlandais','Dutch','Nederlands','Nl'),(150,'Anglais','English','Engels','En'),(151,'Code de traduction','Translation code','Vertaling code','TradCode'),(153,'Options','Options','Opties','GestionCompte'),(154,'Changer mon mot de passe','Change my password','Mijn wachtwoord veranderen','ChangePassword'),(156,'Retour à la page d\'administration','Back to admin page','TranslateMe','RetourPageAdmin'),(157,'Modifier une traduction existante','Modify an existing translation','TranslateMe','ModifierTradExistante'),(159,'test','test','test','test'),(160,'Ajouter une nouvelle traduction','Add a new translation','Een nieuwe vertaling voegen','AjouterNouvelleTraduction'),(161,'Créer la nouvelle traduction','Create the new translation','Nieuwe vertaling zenden','CreerNouvelleTraduction'),(162,'Mettre à jour la traduction','Update translation','Update vertaling','UpdateTraduction'),(163,'Selectionner une sous- catégorie','Select a sub-category','Selecteer een subcategorie: ','SelectionnerSousCategorie'),(164,'Voie de cr&eacute;ation','Way of creation','Manier van de schepping','CanalTicketCirc');

/*Table structure for table `w3sys_user` */

DROP TABLE IF EXISTS `w3sys_user`;

CREATE TABLE `w3sys_user` (
  `id_user` int(10) NOT NULL AUTO_INCREMENT,
  `nom` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(32) NOT NULL,
  `fk_fonction` int(10) NOT NULL,
  `fk_langue` int(10) NOT NULL,
  `visible` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_w3sys_user_w3sys_fonction1_idx` (`fk_fonction`),
  KEY `fk_w3sys_user_w3sys_langue1_idx` (`fk_langue`),
  CONSTRAINT `fk_w3sys_user_w3sys_fonction1` FOREIGN KEY (`fk_fonction`) REFERENCES `w3sys_fonction` (`id_fonction`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_w3sys_user_w3sys_langue1` FOREIGN KEY (`fk_langue`) REFERENCES `w3sys_langue` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

/*Data for the table `w3sys_user` */

insert  into `w3sys_user`(`id_user`,`nom`,`email`,`password`,`fk_fonction`,`fk_langue`,`visible`) values (1,'Riduan Amar Ouaali','r@r.r','4b43b0aee35624cd95b910189b3dc231',3,2,1),(3,'Lionel','u@u.u','7b774effe4a349c6dd82ad4f4f21d34c',1,1,1),(4,'Emmanuel Capelle','capelle.e@gmail.com','e1671797c52e15f763380b45e841ec32',2,1,0),(5,'User','user','ee11cbb19052e40b07aac0ca060c23ee',1,2,1),(6,'Admin','admin','21232f297a57a5a743894a0e4a801fc3',2,2,1),(11,'rachid','rachid@r.be','0d2ece888a960b5f0351b27fea74e747',2,1,1),(12,'HServices','test@web3sys.com','7dffd33bda65d2f2f37cc5ac7a832419',2,1,1),(13,'Manager','a@a.a','0cc175b9c0f1b6a831c399e269772661',2,3,1),(14,'Root Lionel','rl@rl.rl','3e6a5bd51b64dda3437f46edd9d46bcb',3,2,1),(15,'Root Emmanuel','s@s.s','03c7c0ace395d80182db07ae2c30f034',3,2,1),(16,'Default_user','z','z',1,1,0),(17,'Desaedeleer','desaedeleerlionel@hotmail.com','800a0e21225906fe82d141def1a9202d',4,1,1),(18,'Aziz Lawrizy','def@abc.com','0cc175b9c0f1b6a831c399e269772661',4,1,1),(19,'testTransaction','t@t.t','c4ca4238a0b923820dcc509a6f75849b',4,1,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
