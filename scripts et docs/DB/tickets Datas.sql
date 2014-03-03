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

insert  into `w3sys_batiment`(`id_batiment`,`adresse`,`commune`,`cp`,`nom`,`cpt`,`code`,`visible`) values (1,'Boulevard de France 7 & 9','Braine l\'Alleud',1420,'Alliance A & C',43,'ALLA',1),(2,'Avenue de Finlande 2','Braine l\'Alleud',1420,'Alliance B',17,'ALLB',1),(3,'Place de Luxembourg 1-4','Braine l\'Alleud',1420,'Alliance D & E',23,'ALLD',1),(4,'Avenue de Finlande 4-6-8','Braine l\'Alleud',1420,'Alliance F & G',22,'ALLF',1),(5,'Avenue de Finlande 5-7-9','Braine l\'Alleud',1420,'Alliance J',13,'ALLJ',1),(6,'Boulevard de l\'Angleterre 2-4','Braine l\'Alleud',1420,'Alliance S',11,'ALLS',1),(7,'Avenue des Arts 44','Bruxelles',1040,'Arts 44',7,'ARTS',1),(8,'Avenue des Arts 58','Bruxelles',1040,'Arts&Lux',7,'ARLU',1),(9,'Rue de GenÃ¨ve 1-3','Bruxelles',1140,'ASTRID - EVERE',6,'ASEV',1),(10,'ChaussÃ©e de Wavre 1789','Bruxelles',1160,'AUDERGHEM',2,'AUDE',1),(11,'Av. Beaulieu 1-3','Bruxelles',1160,'BEAULIEU',5,'BEAU',1),(12,'Bd. De Waterloo 38','Bruxelles',1050,'BOULEVARD DE WATERLOO',2,'BVDW',1),(13,'Bd. de l\'Industrie 14','Bruxelles',1070,'Brussels 1 Office',3,'B1OF',1),(14,'Rue des deux gares 150','Bruxelles',1070,'Brussels 2 Office',1,'B2OF',1),(15,'Rue de Loxum 25','Bruxelles',1000,'CENTRAL PLAZA',2,'CPLA',1),(16,'Rue du Marais 54-56','Bruxelles',1000,'CITEB NEW',2,'CINE',1),(17,'Bd. du Jardin Botanique 19','Bruxelles',1000,'CITY CENTER',1,'CICE',1),(18,'Avenue du Congo 7','Bruxelles',1000,'CONGO 7',1,'CONG',1),(19,'Av . de Cortenbergh 80','Bruxelles',1000,'CORTENBERGH',1,'CORT',1),(20,'Av. de Cortenbergh 60','Bruxelles',1000,'CRYSTAL',1,'CRYS',1),(21,'Rue Joseph Wauters 63','Hannut',4280,'HANNUT',1,'HANN',1),(22,'Guffenslaan 5-7-9','Hasselt',3500,'HASSELT',1,'HASS',1),(23,'Rue du Noyer - Pl.Jamblinne de Meux 221','Bruxelles',1030,'JAMBLINNE DE MEUX',1,'JAME',1),(24,'Rue de la Loi 102','Bruxelles',1040,'LOI 102',1,'LOII',1),(25,'Rue de la FusÃ©e 100','Bruxelles',1130,'Mercure centre',1,'MECE',1),(26,'Rue des Bourgeois 7','Namur',5000,'NAMUR - BOURGEOIS',1,'NABO',1),(27,'Boulevard Simon Bolivar 34','Bruxelles',1000,'NORTH LIGHT',1,'NOLI',1),(28,'Mercuriusstraat 27','Nossegem',1930,'NOSSEGEM - Data Center',1,'NODC',1),(29,'ChaussÃ©e de la Hulpe 415','Overijse',3090,'OVERIJSE',2,'OVER',1),(30,'Pl. de l\'UniversitÃ© 16','Louvain-La-Neuve',1348,'PARC -UNIVERSITE L-L-N (LE)',1,'ULLN',1),(31,'Sq. F. Roosevelt 6','Mons',7000,'ROOSEVELT - MONS',2,'ROOM',1),(32,'Rue Royale 52','Bruxelles',1000,'ROYALE 52',1,'RO52',1),(33,'Rue Royale 54','Bruxelles',1000,'ROYALE 54',1,'RO54',1),(34,'Av. Louise 54-60','Bruxelles',1050,'STEPHANIE PLACE I',2,'STPI',1),(35,'Avenue Louise 59-69','Bruxelles',1050,'StÃ©phanie Square',1,'STSQ',1),(36,'Av. de Tervuren 2','Bruxelles',1040,'TERVUREN 2',1,'TER2',1),(37,'Culliganlaan 1','Diegem',1831,'Twin Square, Madison',1,'SMAD',1),(38,'Culliganlaan 1','Diegem',1831,'Twin Square, VendÃ´me',1,'SVEN',1),(39,'Rue Ernest Malvoz 649','Waremme',4300,'WAREMME',2,'WARE',1),(40,'DrÃ¨ve de Richelle 161','Waterloo',1410,'Waterloo Office Park, immeuble M',1,'WOPM',1),(41,'DrÃ¨ve de Richelle','Waterloo',1410,'Waterloo Office Park, immeuble N',2,'WOPN',1),(42,'Bd. de la Woluwe 2','Woluwe Saint Pierre',1150,'WOLUWE GATE',1,'WOGA',1);

/*Data for the table `w3sys_canal` */

insert  into `w3sys_canal`(`id_canal`,`label`) values (1,'Phone'),(2,'Web');

/*Data for the table `w3sys_categorie_incident` */

insert  into `w3sys_categorie_incident`(`id_categorie_incident`,`label`,`fk_parent`,`fk_priorite`,`visible`) values (1,'Sanitaire',NULL,1,1),(2,'Electricité',NULL,1,1),(3,'Ascenseurs',NULL,1,1),(4,'HVAC',NULL,1,1),(5,'Panne d\'électricité',2,1,1),(6,'Ampoule / néon défectueux',2,1,1),(7,'Fuite eau',1,1,1),(8,'WC bouché',1,1,1),(9,'Ascenseur en panne',3,1,1),(10,'Arrêt',3,1,1),(11,'Radiateur en panne',4,1,1),(12,'Local trop chaud',4,1,1),(13,'Local trop froid',4,1,1),(14,'Sécurité',NULL,1,1),(15,'Divers',NULL,1,1),(16,'Thermostat défectueux',4,1,1),(17,'Climatisation en panne',4,1,1),(18,'Fuite d\'eau au niveau du radiateur',4,1,1),(19,'Autre',4,1,1),(20,'Evier bouché',1,1,1),(21,'Chasse d\'eau défectueuse',1,1,1),(22,'Robinetterie défectueuse',1,1,1),(23,'Mauvaise odeur au niveau des canalisations',1,1,1),(24,'Autre',1,1,1),(25,'Prise défectueuse',2,1,1),(26,'Autre',2,1,1),(27,'Badge défectueux',14,1,1),(28,'Lecteur de badge défectueux',14,1,1),(29,'Problème d\'accès au batiment',14,1,1),(30,'Problème d\'accès au parking',14,1,1),(31,'Caméra défectueuse',14,1,1),(32,'Détecteur d\'incendie défectueux',14,1,1),(33,'Parlophone / visiophone défectueux',14,1,1),(34,'Porte bloquée',14,1,1),(35,'Autre',14,1,1),(36,'Nettoyage',15,1,1),(37,'Déblayage',15,1,1),(38,'Papier WC manquant',15,1,1),(39,'Produit sanitaire manquant',15,1,1),(40,'Autre',15,1,1);

/*Data for the table `w3sys_entreprise` */

insert  into `w3sys_entreprise`(`id_entreprise`,`nom`,`adresse`,`tva`,`commune`,`cp`,`tel`,`visible`) values (1,'TEM','1, rue test','1111111111111111','Bruxelles',1000,'02191919',1),(2,'DALKIA','33, bvd de la cambre','0000000000000000','Jette',1090,'01234567',1),(3,'COFELY','247, rue fransman','2222222222222222','Laeken',1020,'98765432',1),(4,'KONE','Rue test, 1','9999999999','Commune test',9999,'02345345345',1);

/*Data for the table `w3sys_fonction` */

insert  into `w3sys_fonction`(`id_fonction`,`label`) values (2,'Admin'),(1,'User');

/*Data for the table `w3sys_historique_ticket` */

insert  into `w3sys_historique_ticket`(`id_historique_ticket`,`date_update`,`fk_ticket`,`fk_statut_ticket`,`fk_user`) values (3,'2014-02-26 19:58:30',264,1,1),(4,'2014-02-27 15:07:50',202,3,4),(5,'2014-02-27 17:51:52',265,1,1),(6,'2014-02-27 17:52:20',266,1,1),(7,'2014-02-28 14:16:58',267,1,1),(8,'2014-02-28 15:07:55',198,1,1),(9,'2014-02-28 15:08:31',198,1,1),(10,'2014-02-28 15:08:41',198,1,1);

/*Data for the table `w3sys_langue` */

insert  into `w3sys_langue`(`id`,`label`) values (1,'FR'),(2,'EN'),(3,'NL');

/*Data for the table `w3sys_lieu` */

insert  into `w3sys_lieu`(`id_lieu`,`fk_locataire`,`fk_batiment`,`visible`) values (1,2,1,1),(2,3,4,1),(3,2,3,1),(4,1,3,1),(5,3,2,1);

/*Data for the table `w3sys_locataire` */

insert  into `w3sys_locataire`(`id_locataire`,`nom`,`email`,`password`,`fk_langue`,`visible`) values (1,'Rachid Nokri','abc@def.com','0cc175b9c0f1b6a831c399e269772661',1,1),(2,'Desaedeleer','desaedeleerlionel@hotmail.com','800a0e21225906fe82d141def1a9202d',2,1),(3,'Aziz Lawrizy','def@abc.com','0cc175b9c0f1b6a831c399e269772661',2,1),(4,'locataire','locataire@l.be','f5306c3a951ed90e70d7e3393cf733bc',1,1);

/*Data for the table `w3sys_priorite` */

insert  into `w3sys_priorite`(`id_priorite`,`label`) values (3,'High'),(1,'Low'),(2,'Medium');

/*Data for the table `w3sys_secteur` */

insert  into `w3sys_secteur`(`fk_entreprise`,`fk_batiment`,`id_secteur`,`fk_categorie`,`visible`) values (3,1,1,5,1),(3,2,2,5,1),(3,3,3,5,1),(3,4,4,5,1),(3,4,7,5,1),(1,1,8,5,1),(1,2,9,5,1),(1,3,10,5,1),(1,4,11,5,1),(2,1,12,5,1),(2,2,13,5,1),(2,3,14,5,1),(2,4,15,5,1);

/*Data for the table `w3sys_statut_ticket` */

insert  into `w3sys_statut_ticket`(`id_statut_ticket`,`label`) values (3,'Cloturé'),(2,'En Traitement'),(1,'Nouveau');

/*Data for the table `w3sys_ticket` */

insert  into `w3sys_ticket`(`id_ticket`,`fk_statut`,`fk_categorie`,`fk_user`,`descriptif`,`fk_canal`,`date_intervention`,`fk_entreprise`,`code_ticket`,`etage`,`bureau`,`fk_locataire`,`fk_batiment`) values (198,1,21,1,'',2,NULL,NULL,'ALLB14','','',2,2),(199,1,9,1,'Test Traitement',1,NULL,NULL,'B1OF2','7','652',1,13),(200,1,25,1,'',2,NULL,NULL,'ALLA41','','',2,1),(201,2,5,1,'',2,'2014-02-24',1,'ALLD14','','',2,3),(202,3,29,1,' ---------- Cloture ---------- test',2,'2014-02-26',4,'ALLF6','','',2,4),(203,1,9,1,'',1,NULL,NULL,'ALLB15','','',1,2),(204,1,12,4,'',1,NULL,NULL,'ALLA42','','',4,1),(205,1,21,4,'',1,NULL,NULL,'ASEV3','','',3,9),(206,1,21,4,'',1,NULL,NULL,'ASEV4','','',3,9),(207,1,17,4,'',1,NULL,NULL,'ALLF7','','',3,4),(208,1,17,4,'',1,NULL,NULL,'ALLF8','','',3,4),(209,1,17,4,'',1,NULL,NULL,'ALLF9','','',3,4),(210,1,17,4,'',1,NULL,NULL,'ALLF10','','',3,4),(211,1,17,4,'',1,NULL,NULL,'ALLF11','','',3,4),(212,1,17,4,'',1,NULL,NULL,'ALLF12','','',3,4),(213,1,17,4,'',1,NULL,NULL,'ALLF13','','',3,4),(214,1,9,4,'',1,NULL,NULL,'ALLS4','','',3,6),(215,1,9,4,'',1,NULL,NULL,'ALLS5','','',3,6),(216,1,9,4,'',1,NULL,NULL,'ALLS6','','',3,6),(217,1,11,4,'',1,NULL,NULL,'AUDE2','','',3,10),(218,1,9,4,'',1,NULL,NULL,'ALLF14','','',2,4),(219,1,9,4,'',1,NULL,NULL,'ALLS7','','',2,6),(220,1,5,4,'',1,NULL,NULL,'ALLS8','','',2,6),(221,1,11,4,'',1,NULL,NULL,'ALLJ4','','',2,5),(222,1,27,4,'',1,NULL,NULL,'ARTS5','','',2,7),(223,1,18,4,'',1,NULL,NULL,'ALLS9','','',2,6),(224,1,11,4,'',1,NULL,NULL,'ARTS6','','',2,7),(225,1,11,4,'',1,NULL,NULL,'ALLJ5','','',2,5),(226,1,11,4,'',1,NULL,NULL,'ALLD15','','',2,3),(227,1,27,4,'',1,NULL,NULL,'ALLJ6','','',2,5),(228,1,9,4,'',1,NULL,NULL,'ALLD16','','',2,3),(229,2,6,4,'',1,'2014-02-25',4,'ALLD17','','',2,3),(230,1,9,4,'',1,NULL,NULL,'ALLD18','','',2,3),(231,1,9,4,'',1,NULL,NULL,'ARLU3','','',1,8),(232,1,9,4,'',1,NULL,NULL,'ARLU4','','',1,8),(233,1,9,4,'',1,NULL,NULL,'ARLU5','','',1,8),(234,1,39,4,'',1,NULL,NULL,'ARLU6','','',1,8),(235,1,38,4,'',1,NULL,NULL,'ALLS10','','',1,6),(236,2,7,4,'',1,'2014-02-25',1,'ALLF15','','',1,13),(237,1,9,4,'',1,NULL,NULL,'ARTS7','','',3,7),(238,1,9,4,'',1,NULL,NULL,'ALLJ7','','',3,5),(239,1,9,4,'',1,NULL,NULL,'ALLS11','','',1,6),(264,1,5,1,'Yo Lionel, c\'est juste un ticket créé pour un test ;-) Ridounet',1,NULL,NULL,'ALLF22','1','web3sys',2,4),(265,1,5,1,'',2,NULL,NULL,'ALLD22','','',2,3),(266,1,5,1,'',2,NULL,NULL,'ALLD23','','',2,3),(267,1,26,1,'rtuti',2,NULL,NULL,'ALLJ13','','',2,5);

/*Data for the table `w3sys_user` */

insert  into `w3sys_user`(`id_user`,`nom`,`email`,`password`,`fk_fonction`,`fk_langue`,`visible`) values (0,'Default_user','z','z',1,1,1),(1,'Riduan Amar Ouaali','a@a.a','0cc175b9c0f1b6a831c399e269772661',2,2,1),(3,'Lionel','u@u.u','7b774effe4a349c6dd82ad4f4f21d34c',1,1,1),(4,'Emmanuel Capelle','capelle.e@gmail.com','e1671797c52e15f763380b45e841ec32',2,1,1),(5,'User','user','ee11cbb19052e40b07aac0ca060c23ee',1,2,1),(6,'Admin','admin','21232f297a57a5a743894a0e4a801fc3',2,2,1),(11,'rachid','rachid@r.be','0d2ece888a960b5f0351b27fea74e747',2,1,1),(12,'HServices','test@web3sys.com','7dffd33bda65d2f2f37cc5ac7a832419',2,1,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
