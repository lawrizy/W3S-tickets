/*
SQLyog Community Edition- MySQL GUI v6.52
MySQL - 5.5.23 : Database - db_ticketing
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

create database if not exists `db_ticketing`;

USE `db_ticketing`;

/*Data for the table `w3sys_batiment` */

insert  into `w3sys_batiment`(`id_batiment`,`adresse`,`commune`,`cp`,`nom`,`cpt`,`code`) values (1,'Boulevard de France 7 & 9','Braine l\'Alleud',1420,'Alliance A & C',16,'ALLA'),(2,'Avenue de Finlande 2','Braine l\'Alleud',1420,'Alliance B',9,'ALLB'),(3,'Place de Luxembourg 1-4','Braine l\'Alleud',1420,'Alliance D & E',7,'ALLD'),(4,'Avenue de Finlande 4-6-8','Braine l\'Alleud',1420,'Alliance F & G',1,'ALLF'),(5,'Avenue de Finlande 5-7-9','Braine l\'Alleud',1420,'Alliance J',1,'ALLJ'),(6,'Boulevard de l\'Angleterre 2-4','Braine l\'Alleud',1420,'Alliance S',1,'ALLS'),(7,'Avenue des Arts 44','Bruxelles',1040,'Arts 44',1,'ARTS'),(8,'Avenue des Arts 58','Bruxelles',1040,'Arts&Lux',1,'ARLU'),(9,'Rue de Genève 1-3','Bruxelles',1140,'ASTRID - EVERE',1,'ASEV'),(10,'Chaussée de Wavre 1789','Bruxelles',1160,'AUDERGHEM',1,'AUDE'),(11,'Av. Beaulieu 1-3','Bruxelles',1160,'BEAULIEU',1,'BEAU'),(12,'Bd. De Waterloo 38','Bruxelles',1050,'BOULEVARD DE WATERLOO',1,'BVDW'),(13,'Bd. de l\'Industrie 14','Bruxelles',1070,'Brussels 1 Office',1,'B1OF'),(14,'Rue des deux gares 150','Bruxelles',1070,'Brussels 2 Office',1,'B2OF'),(15,'Rue de Loxum 25','Bruxelles',1000,'CENTRAL PLAZA',1,'CPLA'),(16,'Rue du Marais 54-56','Bruxelles',1000,'CITEB NEW',1,'CINE'),(17,'Bd. du Jardin Botanique 19','Bruxelles',1000,'CITY CENTER',1,'CICE'),(18,'Avenue du Congo 7','Bruxelles',1000,'CONGO 7',1,'CONG'),(19,'Av . de Cortenbergh 80','Bruxelles',1000,'CORTENBERGH',1,'CORT'),(20,'Av. de Cortenbergh 60','Bruxelles',1000,'CRYSTAL',1,'CRYS'),(21,'Rue Joseph Wauters 63','Hannut',4280,'HANNUT',1,'HANN'),(22,'Guffenslaan 5-7-9','Hasselt',3500,'HASSELT',1,'HASS'),(23,'Rue du Noyer - Pl.Jamblinne de Meux 221','Bruxelles',1030,'JAMBLINNE DE MEUX',1,'JAME'),(24,'Rue de la Loi 102','Bruxelles',1040,'LOI 102',1,'LOII'),(25,'Rue de la Fusée 100','Bruxelles',1130,'Mercure centre',1,'MECE'),(26,'Rue des Bourgeois 7','Namur',5000,'NAMUR - BOURGEOIS',1,'NABO'),(27,'Boulevard Simon Bolivar 34','Bruxelles',1000,'NORTH LIGHT',1,'NOLI'),(28,'Mercuriusstraat 27','Nossegem',1930,'NOSSEGEM - Data Center',1,'NODC'),(29,'Chaussée de la Hulpe 415','Overijse',3090,'OVERIJSE',1,'OVER'),(30,'Pl. de l\'Université 16','Louvain-La-Neuve',1348,'PARC -UNIVERSITE L-L-N (LE)',1,'ULLN'),(31,'Sq. F. Roosevelt 6','Mons',7000,'ROOSEVELT - MONS',1,'ROOM'),(32,'Rue Royale 52','Bruxelles',1000,'ROYALE 52',1,'RO52'),(33,'Rue Royale 54','Bruxelles',1000,'ROYALE 54',1,'RO54'),(34,'Av. Louise 54-60','Bruxelles',1050,'STEPHANIE PLACE I',1,'STPI'),(35,'Avenue Louise 59-69','Bruxelles',1050,'Stéphanie Square',1,'STSQ'),(36,'Av. de Tervuren 2','Bruxelles',1040,'TERVUREN 2',1,'TER2'),(37,'Culliganlaan 1','Diegem',1831,'Twin Square, Madison',1,'SMAD'),(38,'Culliganlaan 1','Diegem',1831,'Twin Square, Vendôme',1,'SVEN'),(39,'Rue Ernest Malvoz 649','Waremme',4300,'WAREMME',1,'WARE'),(40,'Drève de Richelle 161','Waterloo',1410,'Waterloo Office Park, immeuble M',1,'WOPM'),(41,'Drève de Richelle','Waterloo',1410,'Waterloo Office Park, immeuble N',1,'WOPN'),(42,'Bd. de la Woluwe 2','Woluwe Saint Pierre',1150,'WOLUWE GATE',1,'WOGA');

/*Data for the table `w3sys_canal` */

insert  into `w3sys_canal`(`id_canal`,`label`) values (1,'Phone'),(2,'Web');

/*Data for the table `w3sys_categorie_incident` */

insert  into `w3sys_categorie_incident`(`id_categorie_incident`,`label`,`fk_parent`,`fk_priorite`) values (1,'Sanitaire',NULL,1),(2,'Electricité',NULL,1),(3,'Ascenseurs',NULL,1),(4,'Chauffage / Climatisation',NULL,1),(5,'Panne d\'éléctricité',2,1),(6,'Ampoule / néon déféctueux',2,1),(7,'Fuite eau',1,1),(8,'WC bouché',1,1),(9,'Arrêt',3,1),(10,'Ascenseur en panne',3,1),(11,'Radiateur en panne',4,1),(12,'Local trop chaud',4,1),(13,'Local trop froid',4,1),(14,'Sécurité',NULL,1),(15,'Divers',NULL,1),(16,'Thermosta défectueux',4,1),(17,'Climatisation en panne',4,1),(18,'Fuite d\'eau au niveau du radiateur',4,1),(19,'Autre',4,1),(20,'Evier bouché',1,1),(21,'Chasse d\'eau défectueuse',1,1),(22,'Robinetterie défectueuse',1,1),(23,'Mauvaise odeur au niveau des canalisations',1,1),(24,'Autre',1,1),(25,'Prise déféctueuse',2,1),(26,'Autre',2,1),(27,'Badge défectueux',14,1),(28,'Lecteur de badge défectueux',14,1),(29,'Problème d\'accès au batiment',14,1),(30,'Problème d\'accès au parking',14,1),(31,'Caméra défectueuse',14,1),(32,'Détecteur d\'incendie défectueux',14,1),(33,'Parlophone / visiophone défectueux',14,1),(34,'Porte bloquée',14,1),(35,'Autre',14,1),(36,'Nettoyage',15,1),(37,'Déblayage',15,1),(38,'Papier WC manquant',15,1),(39,'Produit sanitaire manquant',15,1),(40,'Autre',15,1);

/*Data for the table `w3sys_entreprise` */

insert  into `w3sys_entreprise`(`id_entreprise`,`nom`,`adresse`,`tva`,`commune`,`cp`,`tel`) values (1,'Dummy Inc.','1, rue test','1111111111111111','Bruxelles',1000,'02191919'),(2,'Amar & Co.','33, bvd de la cambre','0000000000000000','Jette',1090,'01234567'),(3,'Electronica','247, rue fransman','2222222222222222','Laeken',1020,'98765432');

/*Data for the table `w3sys_fonction` */

insert  into `w3sys_fonction`(`id_fonction`,`label`) values (2,'Admin'),(1,'User');

/*Data for the table `w3sys_historique_ticket` */

insert  into `w3sys_historique_ticket`(`id_historique_ticket`,`date_update`,`fk_ticket`,`fk_statut_ticket`,`fk_user`) values (2,'2014-02-13 11:31:03',2,1,0),(3,'2014-02-13 13:22:33',7,1,0),(4,'2014-02-17 14:42:52',8,1,1),(5,'2014-02-17 15:13:07',9,1,3),(6,'2014-02-17 15:38:56',10,1,3),(7,'2014-02-17 15:53:40',11,1,1),(8,'2014-02-17 15:54:47',12,1,1),(9,'2014-02-17 15:55:00',13,1,1),(10,'2014-02-17 16:48:19',13,1,1),(11,'2014-02-17 16:48:23',13,1,1),(12,'2014-02-17 16:48:28',13,1,1),(13,'2014-02-17 17:18:33',14,1,3),(14,'2014-02-17 17:49:33',15,1,1),(15,'2014-02-17 17:51:01',16,1,1),(16,'2014-02-17 18:00:57',1,1,1),(17,'2014-02-17 18:03:35',17,1,1),(18,'2014-02-17 18:03:54',17,1,1),(19,'2014-02-17 18:17:06',18,1,1),(20,'2014-02-17 18:17:19',19,1,1),(21,'2014-02-17 18:17:36',19,1,1),(22,'2014-02-17 18:56:57',19,2,1),(23,'2014-02-17 18:58:42',19,2,1),(24,'2014-02-17 19:11:09',20,1,3),(25,'2014-02-17 19:14:20',21,1,3),(26,'2014-02-17 19:37:28',22,1,3),(27,'2014-02-17 19:37:38',22,1,3),(28,'2014-02-17 19:37:48',22,2,3),(29,'2014-02-17 19:38:18',1,2,3),(30,'2014-02-17 19:38:34',4,2,3),(31,'2014-02-18 10:01:56',23,1,0),(32,'2014-02-18 10:02:36',24,1,0),(33,'2014-02-18 10:06:01',25,1,0),(34,'2014-02-18 10:11:09',26,1,0),(35,'2014-02-18 10:17:41',1,2,3),(36,'2014-02-18 10:21:30',1,2,3),(37,'2014-02-18 10:22:32',1,2,3),(38,'2014-02-18 11:15:33',27,1,0),(39,'2014-02-18 12:39:03',1,2,3),(40,'2014-02-18 12:41:12',28,1,0),(41,'2014-02-18 12:43:29',29,1,0),(42,'2014-02-18 12:45:52',1,2,3),(43,'2014-02-18 13:46:50',30,1,0),(44,'2014-02-18 13:54:41',31,1,1);

/*Data for the table `w3sys_lieu` */

insert  into `w3sys_lieu`(`id_lieu`,`fk_locataire`,`fk_batiment`) values (1,2,1),(2,3,4),(3,2,3),(4,1,3),(5,3,2);

/*Data for the table `w3sys_locataire` */

insert  into `w3sys_locataire`(`id_locataire`,`nom`,`email`,`password`) values (1,'Rachid Nokri','abc@def.com','0cc175b9c0f1b6a831c399e269772661'),(2,'Desaedeleer','desaedeleerlionel@hotmail.com','800a0e21225906fe82d141def1a9202d'),(3,'Aziz Lawrizy','def@abc.com','0cc175b9c0f1b6a831c399e269772661'),(4,'locataire','locataire@l.be','f5306c3a951ed90e70d7e3393cf733bc');

/*Data for the table `w3sys_priorite` */

insert  into `w3sys_priorite`(`id_priorite`,`label`) values (3,'High'),(1,'Low'),(2,'Medium');

/*Data for the table `w3sys_secteur` */

insert  into `w3sys_secteur`(`fk_entreprise`,`fk_batiment`,`id_secteur`,`fk_categorie`) values (3,1,1,5),(3,2,2,5),(3,3,3,5),(3,4,4,5),(3,4,7,5),(1,1,8,5),(1,2,9,5),(1,3,10,5),(1,4,11,5),(2,1,12,5),(2,2,13,5),(2,3,14,5),(2,4,15,5);

/*Data for the table `w3sys_statut_ticket` */

insert  into `w3sys_statut_ticket`(`id_statut_ticket`,`label`) values (3,'Closed'),(2,'InProgress'),(1,'Opened');

/*Data for the table `w3sys_ticket` */

insert  into `w3sys_ticket`(`id_ticket`,`fk_statut`,`fk_categorie`,`fk_user`,`descriptif`,`fk_canal`,`date_intervention`,`fk_entreprise`,`code_ticket`,`etage`,`bureau`,`fk_locataire`,`fk_batiment`) values (1,2,22,1,'test avant présentation',1,'2014-02-21',1,'ABC1234','2','A',2,3),(2,1,5,1,'azerty',1,NULL,3,'BCD2345',NULL,NULL,2,2),(3,1,5,1,'scqf',1,NULL,NULL,'CDE3456',NULL,NULL,2,2),(4,2,5,1,'scqf',1,'2014-02-21',2,'DEF4567',NULL,NULL,3,3),(5,1,5,1,'scqf',1,NULL,NULL,'EFG5678',NULL,NULL,1,2),(6,1,5,1,'e',1,NULL,NULL,'FGH6789',NULL,NULL,1,1),(7,1,5,1,'e',1,NULL,NULL,'GHI7890',NULL,NULL,2,3),(8,1,5,1,'',1,NULL,NULL,'BCD3',NULL,NULL,3,2),(9,1,5,3,'rezsrdfsfvdz zef',1,NULL,NULL,'CDE2',NULL,NULL,1,3),(10,1,8,3,'rezsrdfsfvdz zef',1,NULL,NULL,'CDE3',NULL,NULL,1,3),(11,1,9,1,'103 eme test',1,NULL,NULL,'ABC2',NULL,NULL,3,1),(12,1,7,1,'103 eme test',1,NULL,NULL,'ABC3',NULL,NULL,3,1),(13,1,7,1,'103 eme test',1,NULL,3,'ABC4',NULL,NULL,3,1),(14,1,5,3,'saza',1,NULL,NULL,'BCD4',NULL,NULL,1,2),(15,1,6,1,'test',1,NULL,NULL,'BCD5',NULL,NULL,1,2),(16,1,21,1,'test avec Aziz',1,NULL,NULL,'ABC5',NULL,NULL,1,1),(17,1,20,1,'test 2 avant présentation',1,NULL,NULL,'BCD6','1','a',4,4),(18,1,20,1,'test',1,NULL,NULL,'BCD7','1','2',1,2),(19,2,22,1,'test 2',1,'2014-02-24',2,'BCD8','1','2',1,2),(20,1,8,3,'test test ted',1,NULL,NULL,'CDE4','2','rome',1,3),(21,1,20,3,'',1,NULL,NULL,'CDE5','','',1,3),(22,2,21,3,'test d\'un pc à un autre',1,'2014-02-21',3,'BCD9','','',1,2),(23,1,8,1,'sfdsd',2,NULL,NULL,'ABC8','2','111',4,1),(24,1,7,1,'Test Rachid',2,NULL,NULL,'ABC9','2','333',4,1),(25,1,7,1,'Test Rachid',2,NULL,NULL,'ABC10','2','333',4,1),(26,1,8,1,'12d1s',2,NULL,NULL,'CDE6','2','1454',2,3),(27,1,8,1,'Test',2,NULL,NULL,'ABC11','2','333',4,1),(28,1,21,1,'aze',2,NULL,NULL,'ALA12','1','B',1,1),(29,1,7,1,'qsergohg',2,NULL,NULL,'CDE7','8','A',1,3),(30,1,20,1,'Test',2,NULL,NULL,'ALA13','1','2',1,1),(31,1,8,1,'',1,NULL,NULL,'ALA15','s','',1,1);

/*Data for the table `w3sys_user` */

insert  into `w3sys_user`(`id_user`,`nom`,`email`,`password`,`fk_fonction`) values (0,'Default_user','z','z',1),(1,'Riduan Amar Ouaali','a@a.a','0cc175b9c0f1b6a831c399e269772661',2),(3,'Lionel','u@u.u','7b774effe4a349c6dd82ad4f4f21d34c',2),(4,'Emmanuel Capelle','e@e.e','e1671797c52e15f763380b45e841ec32',2),(5,'User','user','ee11cbb19052e40b07aac0ca060c23ee',1),(6,'Admin','admin','21232f297a57a5a743894a0e4a801fc3',2),(11,'rachid','rachid@r.be','0d2ece888a960b5f0351b27fea74e747',2);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
