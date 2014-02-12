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

insert  into `w3sys_batiment`(`id_batiment`,`adresse`,`commune`,`cp`) values (1,'rue de chez toi 47','Laeken',1020),(2,'rue ici 214','Jette',1090),(3,'bvd de la cambre 33','Ixelles',1050),(4,'rue fransman 2','Etterbeek',1040);

insert  into `w3sys_canal`(`id_canal`,`label`) values (1,'Phone'),(2,'Web');

insert  into `w3sys_categorie_incident`(`id_categorie_incident`,`label`,`fk_parent`,`fk_priorite`) values (1,'Sanitaire',NULL,2),(2,'Electricité',NULL,1),(3,'Toilette',1,1),(4,'Canalisation',1,2),(5,'A',2,3),(6,'B',NULL,1),(7,'C',6,3);

insert  into `w3sys_entreprise`(`id_entreprise`,`nom`,`adresse`,`tva`,`commune`,`cp`,`tel`) values (1,'Dummy Inc.','1, rue test','1111111111111111','Bruxelles',1000,'02191919');

insert  into `w3sys_fonction`(`id_fonction`,`label`) values (2,'Admin'),(1,'User');

insert  into `w3sys_lieu`(`id_lieu`,`etage`,`appartement`,`fk_locataire`,`fk_batiment`) values (1,2,'C',2,1),(2,4,'ED',3,4),(3,0,'17',2,3),(4,4,'A1',1,3),(5,1,'3',3,2);

insert  into `w3sys_locataire`(`id_locataire`,`nom`,`email`,`password`) values (1,'Rachid Nokri','abc@def.com','0cc175b9c0f1b6a831c399e269772661'),(2,'Desaedeleer','desaedeleerlionel@hotmail.com','800a0e21225906fe82d141def1a9202d'),(3,'Aziz Lawrizy','def@abc.com','0cc175b9c0f1b6a831c399e269772661');

insert  into `w3sys_priorite`(`id_priorite`,`label`) values (3,'High'),(1,'Low'),(2,'Medium');

insert  into `w3sys_statut_ticket`(`id_statut_ticket`,`label`) values (1,'Opened'),(2,'InProgress'),(3,'Closed');

insert  into `w3sys_ticket`(`id_ticket`,`fk_statut`,`fk_categorie`,`fk_lieu`,`fk_user`,`commentaire`,`fk_canal`) values (1,1,1,4,1,'zeazeazeazeytuazeohipazeazrareezaaaaaaaaaaaaaaaaaaaaaaaaaaaaaertt',0),(2,1,3,1,2,NULL,0),(3,3,3,5,1,NULL,0),(4,1,1,1,NULL,'Toilette bouchée !',1),(5,1,1,3,1,'Toilette endomagée',1),(6,1,1,1,1,'test nouveau Locataire',1),(7,1,1,1,1,'test avec historique locataire\r\n\r\n',1),(8,1,1,3,1,'test histo 2',1),(9,1,1,3,1,'test histo 3',1),(10,1,1,3,1,'test histo 3',1),(11,1,1,3,1,'test histo 3',1),(12,1,1,3,1,'test histo 3',1),(13,1,1,3,1,'test histo 3',1),(14,1,1,3,1,'test histo 3',1),(15,1,1,3,1,'test histo 3',1);

insert  into `w3sys_user`(`id_user`,`nom`,`email`,`password`,`fk_fonction`) values (1,'Riduan Amar Ouaali','a@a.a','0cc175b9c0f1b6a831c399e269772661',2),(3,'Lionel','u@u.u','7b774effe4a349c6dd82ad4f4f21d34c',2),(4,'Emmanuel Capelle','e@e.e','e1671797c52e15f763380b45e841ec32',2),(5,'User','user','ee11cbb19052e40b07aac0ca060c23ee',1),(6,'Admin','admin','21232f297a57a5a743894a0e4a801fc3',2);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
