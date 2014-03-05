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

insert  into `w3sys_batiment`(`id_batiment`,`adresse`,`commune`,`cp`,`nom`,`cpt`,`code`,`visible`) values (1,'Boulevard de France 7 & 9','Braine l\'Alleud',1420,'Alliance A & C',43,'ALLA',1),(2,'Avenue de Finlande 2','Braine l\'Alleud',1420,'Alliance B',19,'ALLB',1),(3,'Place de Luxembourg 1-4','Braine l\'Alleud',1420,'Alliance D & E',24,'ALLD',1),(4,'Avenue de Finlande 4-6-8','Braine l\'Alleud',1420,'Alliance F & G',22,'ALLF',1),(5,'Avenue de Finlande 5-7-9','Braine l\'Alleud',1420,'Alliance J',13,'ALLJ',1),(6,'Boulevard de l\'Angleterre 2-4','Braine l\'Alleud',1420,'Alliance S',11,'ALLS',1),(7,'Avenue des Arts 44','Bruxelles',1040,'Arts 44',7,'ARTS',1),(8,'Avenue des Arts 58','Bruxelles',1040,'Arts&Lux',7,'ARLU',1),(9,'Rue de Genêve 1-3','Bruxelles',1140,'ASTRID - EVERE',6,'ASEV',1),(10,'Chaussée de Wavre 1789','Bruxelles',1160,'AUDERGHEM',2,'AUDE',1),(11,'Av. Beaulieu 1-3','Bruxelles',1160,'BEAULIEU',5,'BEAU',1),(12,'Bd. De Waterloo 38','Bruxelles',1050,'BOULEVARD DE WATERLOO',2,'BVDW',1),(13,'Bd. de l\'Industrie 14','Bruxelles',1070,'Brussels 1 Office',4,'B1OF',1),(14,'Rue des deux gares 150','Bruxelles',1070,'Brussels 2 Office',1,'B2OF',1),(15,'Rue de Loxum 25','Bruxelles',1000,'CENTRAL PLAZA',2,'CPLA',1),(16,'Rue du Marais 54-56','Bruxelles',1000,'CITEB NEW',2,'CINE',1),(17,'Bd. du Jardin Botanique 19','Bruxelles',1000,'CITY CENTER',1,'CICE',1),(18,'Avenue du Congo 7','Bruxelles',1000,'CONGO 7',1,'CONG',1),(19,'Av . de Cortenbergh 80','Bruxelles',1000,'CORTENBERGH',1,'CORT',1),(20,'Av. de Cortenbergh 60','Bruxelles',1000,'CRYSTAL',1,'CRYS',1),(21,'Rue Joseph Wauters 63','Hannut',4280,'HANNUT',1,'HANN',1),(22,'Guffenslaan 5-7-9','Hasselt',3500,'HASSELT',1,'HASS',1),(23,'Rue du Noyer - Pl.Jamblinne de Meux 221','Bruxelles',1030,'JAMBLINNE DE MEUX',1,'JAME',1),(24,'Rue de la Loi 102','Bruxelles',1040,'LOI 102',1,'LOII',1),(25,'Rue de la Fusée 100','Bruxelles',1130,'Mercure centre',1,'MECE',1),(26,'Rue des Bourgeois 7','Namur',5000,'NAMUR - BOURGEOIS',1,'NABO',1),(27,'Boulevard Simon Bolivar 34','Bruxelles',1000,'NORTH LIGHT',1,'NOLI',1),(28,'Mercuriusstraat 27','Nossegem',1930,'NOSSEGEM - Data Center',1,'NODC',1),(29,'Chaussée de la Hulpe 415','Overijse',3090,'OVERIJSE',2,'OVER',1),(30,'Pl. de l\'Université 16','Louvain-La-Neuve',1348,'PARC -UNIVERSITE L-L-N (LE)',1,'ULLN',1),(31,'Sq. F. Roosevelt 6','Mons',7000,'ROOSEVELT - MONS',2,'ROOM',1),(32,'Rue Royale 52','Bruxelles',1000,'ROYALE 52',1,'RO52',1),(33,'Rue Royale 54','Bruxelles',1000,'ROYALE 54',1,'RO54',1),(34,'Av. Louise 54-60','Bruxelles',1050,'STEPHANIE PLACE I',2,'STPI',1),(35,'Avenue Louise 59-69','Bruxelles',1050,'Stéphanie Square',1,'STSQ',1),(36,'Av. de Tervuren 2','Bruxelles',1040,'TERVUREN 2',1,'TER2',1),(37,'Culliganlaan 1','Diegem',1831,'Twin Square, Madison',1,'SMAD',1),(38,'Culliganlaan 1','Diegem',1831,'Twin Square, Vendôme',1,'SVEN',1),(39,'Rue Ernest Malvoz 649','Waremme',4300,'WAREMME',2,'WARE',1),(40,'Drève de Richelle 161','Waterloo',1410,'Waterloo Office Park, immeuble M',1,'WOPM',1),(41,'Drève de Richelle','Waterloo',1410,'Waterloo Office Park, immeuble N',2,'WOPN',1),(42,'Bd. de la Woluwe 2','Woluwe Saint Pierre',1150,'WOLUWE GATE',1,'WOGA',1),(43,'TEST NE PAS AFFICHER','TEST NE PAS AFFICHER',0,'TEST NE PAS AFFICHER',1,'TEST',0);

/*Data for the table `w3sys_canal` */

insert  into `w3sys_canal`(`id_canal`,`label`) values (1,'Phone'),(2,'Web');

/*Data for the table `w3sys_categorie_incident` */

insert  into `w3sys_categorie_incident`(`id_categorie_incident`,`label`,`fk_parent`,`fk_priorite`,`visible`) values (1,'Sanitaire',NULL,1,1),(2,'Electricité',NULL,1,1),(3,'Ascenseurs',NULL,1,1),(4,'HVAC',NULL,1,1),(5,'Panne d\'électricité',2,1,1),(6,'Ampoule / néon défectueux',2,1,1),(7,'Fuite eau',1,1,1),(8,'WC bouché',1,1,1),(9,'Ascenseur en panne',3,1,1),(10,'Arrêt',3,1,1),(11,'Radiateur en panne',4,1,1),(12,'Local trop chaud',4,1,1),(13,'Local trop froid',4,1,1),(14,'Sécurité',NULL,1,1),(15,'Divers',NULL,1,1),(16,'Thermostat défectueux',4,1,1),(17,'Climatisation en panne',4,1,1),(18,'Fuite d\'eau au niveau du radiateur',4,1,1),(19,'Autre',4,1,1),(20,'Evier bouché',1,1,1),(21,'Chasse d\'eau défectueuse',1,1,1),(22,'Robinetterie défectueuse',1,1,1),(23,'Mauvaise odeur au niveau des canalisations',1,1,1),(24,'Autre',1,1,1),(25,'Prise défectueuse',2,1,1),(26,'Autre',2,1,1),(27,'Badge défectueux',14,1,1),(28,'Lecteur de badge défectueux',14,1,1),(29,'Problème d\'accès au batiment',14,1,1),(30,'Problème d\'accès au parking',14,1,1),(31,'Caméra défectueuse',14,1,1),(32,'Détecteur d\'incendie défectueux',14,1,1),(33,'Parlophone / visiophone défectueux',14,1,1),(34,'Porte bloquée',14,1,1),(35,'Autre',14,1,1),(36,'Nettoyage',15,1,1),(37,'Déblayage',15,1,1),(38,'Papier WC manquant',15,1,1),(39,'Produit sanitaire manquant',15,1,1),(40,'Autre',15,1,1);

/*Data for the table `w3sys_entreprise` */

insert  into `w3sys_entreprise`(`id_entreprise`,`nom`,`adresse`,`tva`,`commune`,`cp`,`tel`,`visible`) values (1,'TEM','1, rue test','1111111111111111','Bruxelles',1000,'02191919',1),(2,'DALKIA','33, bvd de la cambre','0000000000000000','Jette',1090,'01234567',1),(3,'COFELY','247, rue fransman','2222222222222222','Laeken',1020,'98765432',1),(4,'KONE','Rue test, 1','9999999999','Commune test',9999,'02345345345',1);

/*Data for the table `w3sys_fonction` */

insert  into `w3sys_fonction`(`id_fonction`,`label`) values (2,'Admin'),(3,'Root'),(1,'User');

/*Data for the table `w3sys_historique_ticket` */

insert  into `w3sys_historique_ticket`(`id_historique_ticket`,`date_update`,`fk_ticket`,`fk_statut_ticket`,`fk_user`) values (3,'2014-02-26 19:58:30',264,1,1),(4,'2014-02-27 15:07:50',202,3,4),(5,'2014-02-27 17:51:52',265,1,1),(6,'2014-02-27 17:52:20',266,1,1),(7,'2014-02-28 14:16:58',267,1,1),(8,'2014-02-28 15:07:55',198,1,1),(9,'2014-02-28 15:08:31',198,1,1),(10,'2014-02-28 15:08:41',198,1,1),(11,'2014-03-03 16:43:18',268,1,1),(12,'2014-03-04 13:40:06',205,2,1),(13,'2014-03-04 15:56:20',269,1,1),(14,'2014-03-04 15:56:52',270,1,1),(15,'2014-03-04 19:42:28',271,1,1),(16,'2014-03-04 19:43:26',271,2,1),(17,'2014-03-04 19:43:47',271,3,1);

/*Data for the table `w3sys_langue` */

insert  into `w3sys_langue`(`id`,`label`) values (1,'FR'),(2,'EN'),(3,'NL');

/*Data for the table `w3sys_lieu` */

insert  into `w3sys_lieu`(`id_lieu`,`fk_locataire`,`fk_batiment`,`visible`) values (1,2,1,1),(2,3,4,1),(3,2,3,1),(4,1,3,1),(5,3,2,1);

/*Data for the table `w3sys_locataire` */

insert  into `w3sys_locataire`(`id_locataire`,`nom`,`email`,`password`,`fk_langue`,`visible`) values (1,'Rachid Nokri','abc@def.com','0cc175b9c0f1b6a831c399e269772661',1,1),(2,'Desaedeleer','desaedeleerlionel@hotmail.com','800a0e21225906fe82d141def1a9202d',2,1),(3,'Aziz Lawrizy','def@abc.com','0cc175b9c0f1b6a831c399e269772661',2,1),(4,'locataire','locataire@l.be','f5306c3a951ed90e70d7e3393cf733bc',1,1);

/*Data for the table `w3sys_priorite` */

insert  into `w3sys_priorite`(`id_priorite`,`label`) values (3,'High'),(1,'Low'),(2,'Medium');

/*Data for the table `w3sys_secteur` */

/*Data for the table `w3sys_statut_ticket` */

insert  into `w3sys_statut_ticket`(`id_statut_ticket`,`label`) values (3,'Cloturé'),(2,'En Traitement'),(1,'Nouveau');

/*Data for the table `w3sys_ticket` */

insert  into `w3sys_ticket`(`id_ticket`,`fk_statut`,`fk_categorie`,`fk_user`,`descriptif`,`fk_canal`,`date_intervention`,`fk_entreprise`,`code_ticket`,`etage`,`bureau`,`fk_locataire`,`fk_batiment`,`visible`) values (198,1,21,1,'',2,NULL,NULL,'ALLB14','','',2,2,NULL),(199,1,9,1,'Test Traitement',1,NULL,NULL,'B1OF2','7','652',1,13,NULL),(200,1,25,1,'',2,NULL,NULL,'ALLA41','','',2,1,NULL),(201,2,5,1,'',2,'2014-02-24',1,'ALLD14','','',2,3,NULL),(202,3,29,1,' ---------- Cloture ---------- test',2,'2014-02-26',4,'ALLF6','','',2,4,NULL),(203,1,9,1,'',1,NULL,NULL,'ALLB15','','',1,2,NULL),(204,1,12,4,'',1,NULL,NULL,'ALLA42','','',4,1,NULL),(205,2,21,4,'',1,'2014-03-12',2,'ASEV3','','',3,9,NULL),(206,1,21,4,'',1,NULL,NULL,'ASEV4','','',3,9,NULL),(207,1,17,4,'',1,NULL,NULL,'ALLF7','','',3,4,NULL),(208,1,17,4,'',1,NULL,NULL,'ALLF8','','',3,4,NULL),(209,1,17,4,'',1,NULL,NULL,'ALLF9','','',3,4,NULL),(210,1,17,4,'',1,NULL,NULL,'ALLF10','','',3,4,NULL),(211,1,17,4,'',1,NULL,NULL,'ALLF11','','',3,4,NULL),(212,1,17,4,'',1,NULL,NULL,'ALLF12','','',3,4,NULL),(213,1,17,4,'',1,NULL,NULL,'ALLF13','','',3,4,NULL),(214,1,9,4,'',1,NULL,NULL,'ALLS4','','',3,6,NULL),(215,1,9,4,'',1,NULL,NULL,'ALLS5','','',3,6,NULL),(216,1,9,4,'',1,NULL,NULL,'ALLS6','','',3,6,NULL),(217,1,11,4,'',1,NULL,NULL,'AUDE2','','',3,10,NULL),(218,1,9,4,'',1,NULL,NULL,'ALLF14','','',2,4,NULL),(219,1,9,4,'',1,NULL,NULL,'ALLS7','','',2,6,NULL),(220,1,5,4,'',1,NULL,NULL,'ALLS8','','',2,6,NULL),(221,1,11,4,'',1,NULL,NULL,'ALLJ4','','',2,5,NULL),(222,1,27,4,'',1,NULL,NULL,'ARTS5','','',2,7,NULL),(223,1,18,4,'',1,NULL,NULL,'ALLS9','','',2,6,NULL),(224,1,11,4,'',1,NULL,NULL,'ARTS6','','',2,7,NULL),(225,1,11,4,'',1,NULL,NULL,'ALLJ5','','',2,5,NULL),(226,1,11,4,'',1,NULL,NULL,'ALLD15','','',2,3,NULL),(227,1,27,4,'',1,NULL,NULL,'ALLJ6','','',2,5,NULL),(228,1,9,4,'',1,NULL,NULL,'ALLD16','','',2,3,NULL),(229,2,6,4,'',1,'2014-02-25',4,'ALLD17','','',2,3,NULL),(230,1,9,4,'',1,NULL,NULL,'ALLD18','','',2,3,NULL),(231,1,9,4,'',1,NULL,NULL,'ARLU3','','',1,8,NULL),(232,1,9,4,'',1,NULL,NULL,'ARLU4','','',1,8,NULL),(233,1,9,4,'',1,NULL,NULL,'ARLU5','','',1,8,NULL),(234,1,39,4,'',1,NULL,NULL,'ARLU6','','',1,8,NULL),(235,1,38,4,'',1,NULL,NULL,'ALLS10','','',1,6,NULL),(236,2,7,4,'',1,'2014-02-25',1,'ALLF15','','',1,13,NULL),(237,1,9,4,'',1,NULL,NULL,'ARTS7','','',3,7,NULL),(238,1,9,4,'',1,NULL,NULL,'ALLJ7','','',3,5,NULL),(239,1,9,4,'',1,NULL,NULL,'ALLS11','','',1,6,NULL),(264,1,5,1,'Yo Lionel, c\'est juste un ticket créé pour un test ;-) Ridounet',1,NULL,NULL,'ALLF22','1','web3sys',2,4,NULL),(265,1,5,1,'',2,NULL,NULL,'ALLD22','','',2,3,NULL),(266,1,5,1,'',2,NULL,NULL,'ALLD23','','',2,3,NULL),(267,1,26,1,'rtuti',2,NULL,NULL,'ALLJ13','','',2,5,NULL),(268,1,10,1,'sfdqsdsqd',2,NULL,NULL,'B1OF4','','',2,13,NULL),(269,1,16,1,'',1,NULL,NULL,'ALLB18','','',1,2,NULL),(270,1,39,1,'',1,NULL,NULL,'ALLB19','','',2,2,NULL),(271,3,9,1,' ---------- Cloture ---------- Test',1,'2014-03-05',3,'ALLD24','','',1,3,NULL);

insert  into `w3sys_trad`(`code`,`fr`,`en`,`nl`) values 
('ConnexionButton','Connexion','Login','Inloggen'),
('ConnexionTitre','Connexion','Login','Inloggen'),
('EmailForm','Email : ','Email : ','Email : '),
('ExplicationBatiment','(pour voir, modifier ou supprimer un Bâtiment)','(to view, modify or delete a Building)','(Om te bekijken, wijzigen of verwijderen van een gebouw)'),
('ExplicationTicket','(pour voir, traiter, clôturer ou supprimer un Ticket)','(to view, process, close or remove a Ticket)','(te bekijken, verwerken, te sluiten of verwijderen van een ticket)'),
('Indication','Remplissez les champs avec vos données de connexion:','Please fill out the following form with your login credentials:','Vul het onderstaande formulier in met uw inloggegevens:'),
('Mdp','Mot de passe: ','Password: ','Passwoord :  '),
('MdpForm','Mot de passe: ','Password: ','Passwoord :  '),
('MdpOublie','Mot de passe oublié ?','Forgot password ?','Passwoord vergeten ?\''),
('Required','Les champs avec <span class=\"required\">*</span> sont obligatoire.','Fields with <span class=\"required\">*</span> are required.','Velden met <span class=\"required\">*</span>   verplicht.'),
('SeSouvenir','Se rappeler de moi','Remember me','Onthoud mij');


insert  into `w3sys_trad`(`code`,`fr`,`en`,`nl`) values ('AjaxFrenquenceEntreprise','Nombre de ticket par entreprises (pour tous les tickets)','Ticket\'s number by entreprise (all tickets)','Aantal tickets per vennootschap (alle tickets)'),
('AjaxFrequenceStatutTicket','Nombre de ticket par statut (Bâtiment: ','Ticket\'s number by status (Building: ','Aantal tickets per staat (Gebouw: '),
('AjaxFrequenceUnBatiment','Nombre de ticket par catégorie (Bâtiment : ','Ticket\'s number by categorie (Building : ','Aantal tickets per categorie (Gebouw : '),
('AjaxStatutClosed',' cloturé(s)',' closed',' gesloten'),
('AjaxStatutInProgress',' en cour de traitement',' in progress',' aan de gang'),
('AjaxStatutNew',' nouveau(x)',' new',' nieuw'),
('AjaxStatutTicket','Nombre de ticket par statut (Tous les bâtiments)','Ticket\'s number by status  (all buildings)','Aantal tickets per staat (alle gebouwen)'),
('AjaxTitre','Nombre de ticket par catégorie (Tous les bâtiments)','Ticket\'s number by categorie (all buildings)','Aantal tickets per categorie (alle gebouwen)'),
('AllBatiment','Tous les bâtiments','All buildings','Alle gebouwen'),
('Ampoule / néon défectueux','Ampoule / néon défectueux','Bulb /defective neon','Gloeilamp /defecte neon'),
('Arrêt','Arrêt','Stuck','Stop'),
('Ascenseur en panne','Ascenseur en panne','Stuck lift','Kapotte lift'),
('Ascenseurs','Ascenseurs','Lift','Lift'),
('Autre','Autre','Other','Aanderen'),
('Badge défectueux','Badge défectueux','Defective badge','Defecte badge'),
('Caméra défectueuse','Caméra défectueuse','Defective security camera','Defecte camera'),
('Chasse d\'eau défectueuse','Chasse d\'eau défectueuse','Defective flush','Defecte waterspoeling'),
('Climatisation en panne','Climatisation en panne','Broken down air conditioner','Uitgesplitst airconditioner'),
('Déblayage','Déblayage','Clearing','Uitmesten'),
('Détecteur d\'incendie défectueux','Détecteur d\'incendie défectueux','Defective fire alarm','Brandmelder defect'),
('Divers','Divers','Miscellaneous','Diversen'),
('Electricité','Electricité','Electricity','Elektriciteit'),
('Evier bouché','Evier bouché','Blocked sink','Verstopte gootsteen'),
('Fuite d\'eau au niveau du radiateur','Fuite d\'eau au niveau du radiateur','Radiator leaking water','Waterlek in de radiator'),
('Fuite eau','Fuite eau','Water leak','Water Lek'),
('HVAC','HVAC','HVAC','HVAC'),
('Lecteur de badge défectueux','Lecteur de badge défectueux','Defective badge reader','Speler defect badge'),
('Local trop chaud','Local trop chaud','Room too hot','Lokaal te warm'),
('Local trop froid','Local trop froid','Room too cold','Lokaal te koud'),
('Mauvaise odeur au niveau des canalisations','Mauvaise odeur au niveau des canalisations','Foul smell in the piping','Slechte geur in leidingen'),
('Nettoyage','Nettoyage','Cleaning','Schoonmaken'),
('Panne d\'électricité','Panne d\'électricité','Electricity breakdown','Uitsplitsing elektriciteit'),
('Papier WC manquant','Papier WC manquant','Missing toilet paper','Papier ontbrekende wc'),
('Parlophone / visiophone défectueux','Parlophone / visiophone défectueux','Defective videophone','Intercom / videofoon defect'),
('Porte bloquée','Porte bloquée','Stuck door','Geblokkeerde deur'),
('Prise défectueuse','Prise défectueuse','Defective plug','Defecte beslissing'),
('Problème d\'accès au batiment','Problème d\'accès au batiment','Building access problem','Probleem van de toegang tot het gebouw'),
('Problème d\'accès au parking','Problème d\'accès au parking','Parking access problem','Probleem van de toegang tot de parkeerplaats'),
('Produit sanitaire manquant','Produit sanitaire manquant','Missing detergent','Sanitizer vermist'),
('Radiateur en panne','Radiateur en panne','Broken down radiator','Radiator beneden'),
('ReglerProbleme','Veuillez régler les problèmes suivants','Please fix the following problems','Please fix de volgende problemen'),
('Robinetterie défectueuse','Robinetterie défectueuse','Defective plumbing','Kleppen defect'),
('Sanitaire','Sanitaire','Sanitary','Sanitair'),
('Sécurité','Sécurité','Security','Veiligheid'),
('SelectionnerBat','Sélectionnez un bâtiment pour filtrer les résultats:','Select a building to filter results: ','Selecteer een bouwen om resultaten te filteren:  '),
('Thermostat défectueux','Thermostat défectueux','Defective thermostat','Defecte thermostaat'),
('TitreDashboard','Tableau de bord','Dashboard','Dashboard'),
('WC bouché','WC bouché','Blocked WC','Verstopte WC');

/*Data for the table `w3sys_trad` */

insert  into `w3sys_trad`(`code`,`fr`,`en`,`nl`) values ('','','',''),
('Actions','Action(s)','Action(s)','Actie(s)'),
('AdminClosedTitre','Tickets cloturés','Tickets closed','Tickets gesloten'),
('AdminInProgressTitre','Tickets en cours de traitement','Tickets in progress','Tickets in uitvoering'),
('AdminOpenedTitre','Nouveaux tickets ','New tickets','Nieuwe tickets'),
('AdminTitre','Tous les tickets','All tickets','Alle tickets'),
('AdminTraitementTitre','Tickets en cours de traitement','Tickets in progress ','Tickets in uitvoering '),
('APropos','A Propos','About','Over ons'),
('BatimentTicket','Bâtiment','Building','Gebouw'),
('BatimentTicketCirc','B&acirc;timent','Building','Gebouw'),
('BureauTicket','Bureau','Office','Officie'),
('ButtonClose','Cloturer le ticket','Close ticket','Sluit het ticket'),
('ButtonCreer','Créer','Create','Maaken'),
('ButtonTraitement','Passer en traitement','Put in progress','Voeren behandeling'),
('CanalTicket','Voie de création','Way of creation','Manier van de schepping'),
('CategorieTicket','Sous-cat&eacute;gorie','Sub-category','Subcategorie'),
('CategTicket','Cat&eacute;gorie','Category','Categorie'),
('CloseTitre','Clôture du ticket ','Closing of ticket ','Sluitend van ticket '),
('Cloturé','Cloturé','Closed ','Gesloten'),
('CodeTicket','Code du ticket','Ticket code ','Ticket code '),
('Connexion','Connexion','Login','Inloggen'),
('Contact','Contact','Contact','Contact'),
('CreateBatiment','Créer un bâtiment','Create a building','Maaken een gebouw'),
('CreateTitre','Créer un nouveau ticket','Create a new ticket','Maaken een nieuw ticket'),
('Creer','Créer','Create','Creer'),
('CreerLocataire','Créer un locatraire','Create a locataire','Maak een huurder'),
('CreerTicket','Créer un nouveau ticket','Create a new ticket','Maak een nieuw ticket'),
('DashBoard','Tableaux de bord','Dashboard','Dashboard'),
('DateIntervention','Date d\'intervention ',' Intervention date','Interventie datum'),
('DateInterventionTicket','Date d\'intervention','Response time /!\\ ','Reactie datum'),
('DeConnexion','Déconnexion','Logout','Uitloggen'),
('DescriptifTicket','Description','Description','Beschrijving'),
('DroitsReserve','Tous Droits Réservés.','All Rights Reserved.','Alle rechten voorbehouden.'),
('EmailUser','Email','Email','Email'),
('En Traitement','En Traitement','In Treatment ','aan de gang'),
('EntrepriseTicket','Sous-traitant','Subcontractor','Onderaannemer'),
('EtageTicket','Etage','Floor','Verdieping'),
('FonctionUser','Fonction de l\'utilisateur','User\'s function','Gebruikersfunctie '),
('GestionApplication','Gestion de l\'application','Application Management','Application Management'),
('Graphique','Graphique','Graphic','Grafisch'),
('IdLoc','Nom du locataire','Roomer\'s name','Naam van de huurder'),
('IdTicket','Id du ticket','Ticket \'s Id','Id van het ticket'),
('IdUser','Id Utilisateur','User\'s Id','Id van de gebruiker'),
('LanguageUser','Langage','Language','Taal'),
('ListBatiment','Liste des Bâtiments','Building\'s list','Lijst van de gebouwen'),
('ListeTicket','Liste des tickets','Tickets\' list','Overzicht van de tickets'),
('ListLocataire','Liste des locataires','Roomer\'s list','lijst van de huurders'),
('LocataireTicket','Locataire','Roommate','Huurders'),
('MdpLoc','Mot de passe','Password','Passwoord'),
('MdpUser','Mot de passe','Password','Passwoord'),
('MenuCloseTicket','Cloturer le ticket ','Close the ticket ','Sluit het ticket '),
('MenuCreerTicket','Créer un ticket','Create a ticket','Maak een ticket'),
('MenuMettreEnTraitementTicket','Mettre en traitement','Put in progress','Zetten in uitvoering'),
('MenuModifierTicket','Modifier le ticket','Modify the ticket ','Wijzigen van een ticket '),
('MenuTicketDelete','Effacer ce ticket','Delete this ticket','Verwijder dit ticket'),
('MenuTicketEnCours','Tickets en cours de traitement','Tickets in progress','Tickets in uitvoering'),
('MenuTicketFerme','Tickets cloturés','Tickets closed','Tickets gesloten'),
('MenuTicketNouveau','Nouveaux tickets','New tickets','Nieuw ticketsTickets gesloten'),
('MenuTicketTout','Tous les tickets','All tickets','Alle tickets'),
('Message','Bienvenue sur ','Welcome on ','Welkom op '),
('NomLoc','Nom','Name','Naam'),
('NomUser','Nom','Name','Naam'),
('Nouveau','Nouveau','New','Nieuw'),
('Par','par','by','bij'),
('Phone','Téléphone','Phone','Telefoon'),
('RechercheAvancee','Recherche avancée','Advanced search','Geavanceerd zoeken'),
('SelectionnerBatiment','Sélectionner un bâtiment:','Select a building: ','Selecteer een gebouw: '),
('SelectionnerCategorie','Sélectonner une catégorie:','Select a category: ','Selecteer een categorie: '),
('StatutTicket','Statut','Status','Staat'),
('TraitementTitre','Traitement du Ticket:  ','Ticket\'s processing:  ','Behandeling van Ticket:  '),
('UserTicket','Assigné à','Assigned to ','Gedefineerd'),
('UserTicketCirc','Assign&eacute; à','Assigned to ','Gedefineerd'),
('ViewHistoriqueDate','Date de mise à jour','Update date','Update datum'),
('ViewHistoriqueTitre','Historique','History','Historie'),
('ViewHistoriqueType','Type','Type','Type'),
('ViewTitre','Ticket : ','Ticket : ','Ticket : '),
('Web','Web','Web','Web');

/*Data for the table `w3sys_user` */

insert  into `w3sys_user`(`id_user`,`nom`,`email`,`password`,`fk_fonction`,`fk_langue`,`visible`) values (0,'Default_user','z','z',1,1,1),(1,'Riduan Amar Ouaali','r@r.r','4b43b0aee35624cd95b910189b3dc231',3,2,1),(3,'Lionel','u@u.u','7b774effe4a349c6dd82ad4f4f21d34c',1,1,1),(4,'Emmanuel Capelle','capelle.e@gmail.com','e1671797c52e15f763380b45e841ec32',2,1,1),(5,'User','user','ee11cbb19052e40b07aac0ca060c23ee',1,2,1),(6,'Admin','admin','21232f297a57a5a743894a0e4a801fc3',2,2,1),(11,'rachid','rachid@r.be','0d2ece888a960b5f0351b27fea74e747',2,1,1),(12,'HServices','test@web3sys.com','7dffd33bda65d2f2f37cc5ac7a832419',2,1,1),(13,'Manager','a@a.a','0cc175b9c0f1b6a831c399e269772661',2,3,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
