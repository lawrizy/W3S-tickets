<?php

/*
 * Pour vérifier le WSDL (le fichier XML) de ce webservice, voir l'URL
 * http://localhost/W3S-tickets/index.php/android/websys
 * 
 * Les méthodes ne sont pas encore utilisables
 */

class AndroidController extends Controller {
    
    /*
     * Les codes erreurs possibles lorsque le webService est appelé
     */

    const ERROR_DB_INACCESSIBLE = -2;
    const ERROR_USER_INEXISTANT = -1;

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('websys'),
                'users' => array('*'),
            ),
            array('deny',
                'users' => array('?'),
                'message' => 'Vous n\'avez pas accès à cette page.'
            ),
        );
    }

    public function actions() {
        return array(
            'websys' => array(
                'class' => 'CWebServiceAction',
            ),
        );
    }

    /**
     * @param string $email Email de l'utilisateur
     * @param string $password Mot de passe de l'utilisateur
     * @return int $error un code erreur
     * @soap
     */
    public function testLogin($email, $password) {
        $error = self::ERROR_USER_INEXISTANT;
        try {
            $user = User::model()->findByAttributes(array('email' => $email, 'visible' => Constantes::VISIBLE, 'password' => md5($password)));
            if ($user !== null)
                $error = $user->id_user;
        } catch (CDbException $ex) {
            $error = self::ERROR_DB_INACCESSIBLE;
        }

        return $error;
    }

    /**
     * 
     * @param int $id_user
     * @return string[] id des batiments
     *  @soap
     */
    public function getMyBuilding($id_user) {
        $myBuildings = array();
        $buildings_id= Batiment::model()->findAllBySql(
                "SELECT b.id_batiment FROM db_ticketing.w3sys_lieu l 
                        INNER JOIN w3sys_batiment b on  l.fk_batiment = b.id_batiment
                        WHERE l.fk_locataire =" . $id_user . " and "
                . "l.visible=" . Constantes::VISIBLE);
        foreach ($buildings_id as $idBuildings) {
            array_push($myBuildings, $idBuildings->id_batiment);
        }
        return $myBuildings;
    }

    /**
     * 
     * @param int $id_user id du locataire
     * @param int $sousCategorie id de la sous categorie
     * @param int $fk_batiment id du batiment
     * @param string $etage etage de l'incident
     * @param string $bureau bureau de l'incident
     * @param string $descriptif description de l'incident
     * @return bool message
     * @soap
     */
    public function createTicket($id_user, $sousCategorie, $fk_batiment, $etage = null, $bureau = null, $descriptif = null) {
        $ticketAndroid = new Ticket;
        $ticketAndroid->fk_locataire = $id_user;
        $ticketAndroid->fk_batiment = $fk_batiment;
        $ticketAndroid->fk_categorie = $sousCategorie;
        $ticketAndroid->etage = $etage;
        $ticketAndroid->bureau = $bureau;
        $ticketAndroid->descriptif = $descriptif;
        $ticketAndroid->fk_canal = Constantes::CANAL_WEB;
        $ticketAndroid->fk_statut = Constantes::STATUT_OPENED;
        $ticketAndroid->fk_user = Constantes::USER_DEFAUT;
        $ticketAndroid->descriptif = "TicketAndroid :)";
        $ticketAndroid->code_ticket = TicketController::createCodeTicket($fk_batiment);
        $cat = CategorieIncident::model()->findByPk($ticketAndroid['fk_categorie']);
        $ticketAndroid->fk_priorite = $cat['fk_priorite'];
        if ($ticketAndroid->save(false)) {
            $histo = new HistoriqueTicket();
            $histo->date_update = date("Y-m-d H:i:s", time());
            $histo->fk_ticket = $ticketAndroid->id_ticket;
            $histo->fk_statut_ticket = Constantes::STATUT_OPENED;
            $histo->fk_user = $ticketAndroid['fk_user'];
            if ($histo->save()) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }
    
    /**
     * @param int $idBatiment id du bâtiment sur lequel filtrer
     * @param int $langue id de la langue à traduire (paramètre falcutatif)
     * @return mixed[] Liste des nombre de tickets par catégorie
     * @soap
     */
    public function getBarsDatas($idBatiment, $langue) {
        $listCat = array(); // On initialise un array pour la liste finale à renvoyer
        Yii::app()->session['_lang'] = $langue == Constantes::LANGUE_EN ? 'en' : ($langue == Constantes::LANGUE_FR ? 'fr' : 'nl');
            // Comme il n'y a pas de session dans le cas d'une application Android 
            // qui se connecte via Webservice, on n'a pas non plus la langue de l'utilisateur.
            // Pour cette raison on demande en paramètre l'id de la langue de l'utilisateur
            // et on la met dans une variable de session _lang qui sera utilisée
            // seulement pour la traduction des textes
        $categories = CategorieIncident::model()->findAllByAttributes(array(
            'visible' => Constantes::VISIBLE,
            'fk_parent' => NULL));
        
        if ($idBatiment == 0) { // Si demande pour tous les bâtiments
            foreach ($categories as $categorie) { // On parcourt toutes les catégories
                // On prépare une requête SQL qui va rechercher le nombre de ticket
                $sql = "SELECT count(t.id_ticket) "
                        . "FROM w3sys_ticket t "
                        . "WHERE t.visible = ". Constantes::VISIBLE ." "
                        . "AND fk_categorie IN "
                            . "(SELECT c.id_categorie_incident "
                            . "FROM w3sys_categorie_incident c "
                            . "WHERE c.fk_parent = ".$categorie['id_categorie_incident'].")";
                $nbTicket = Yii::app()->db->createCommand($sql)->queryScalar();
                    // La méthode queryScalar() permet de récupérer la toute première donnée
                    // de la toute première ligne qui sera le résultat de la requête passée
                    // en paramètre
                $cat = array( // On génère l'array qui sera inseré dans la liste finale
                    'label' => Translate::trad($categorie['label']), // On n'oublie pas de traduire
                    'nb' => $nbTicket);
                array_push($listCat, $cat); // Et on push à la liste à renvoyer
            }
        } else { // Si demande pour un bâtiment en particulier
            foreach ($categories as $categorie) {
                // Le fonctionnement est le même qu'au-dessus. Seul différence,
                // on rajoute une condition en plus dans notre recherche
                $sql = "SELECT count(t.id_ticket) "
                        . "FROM w3sys_ticket t "
                        . "WHERE t.visible = ". Constantes::VISIBLE ." "
                        . "AND fk_batiment = ". $idBatiment ." " // La condition supplémentaire
                        . "AND fk_categorie IN "
                            . "(SELECT c.id_categorie_incident "
                            . "FROM w3sys_categorie_incident c "
                            . "WHERE c.fk_parent = ".$categorie['id_categorie_incident'].")";
                $nbTicket = Yii::app()->db->createCommand($sql)->queryScalar();
                $cat = array(
                    'label' => Translate::trad($categorie['label']), 
                    'nb' => $nbTicket);
                array_push($listCat, $cat);
            }
        }
        return $listCat;
            // Et enfin on retourne l'array contenant toutes les données demandées
    }
    
    /**
     * @param int $idBatiment Le bâtiment sur lequel filtrer
     * @param int $langue Langue d'affichage de l'application
     * @return mixed[] Liste des nombres de tickets par statut.
     * @soap
     */
    public function getPieDatas($idBatiment, $langue) {
        $listStatut = array(); // On initialise un array pour la liste finale à renvoyer
        Yii::app()->session['_lang'] = $langue == Constantes::LANGUE_EN ? 'en' : ($langue == Constantes::LANGUE_FR ? 'fr' : 'nl');
            // Comme il n'y a pas de session dans le cas d'une application Android 
            // qui se connecte via Webservice, on n'a pas non plus la langue de l'utilisateur.
            // Pour cette raison on demande en paramètre l'id de la langue de l'utilisateur
            // et on la met dans une variable de session _lang qui sera utilisée
            // seulement pour la traduction des textes
        $statuts = StatutTicket::model()->findAll(); // On récupère tous les statuts
        if ($idBatiment == 0) { // Si demande faite pour tous les bâtiments
            foreach ($statuts as $statut) { // On parcourt alors tous les statuts
                $nbTicket = (int)Ticket::model()->countByAttributes(array(
                    'visible' => Constantes::VISIBLE,
                    'fk_statut' => $statut['id_statut_ticket']));
                    // On compte le nombre de tickets étant dans ce statut
                    Yii::trace($idBatiment, 'cron');
                $s = array(
                    'label' => Translate::trad($statut['label']),
                    'nb' => $nbTicket); // On génère l'array qu'on insèrera dans la liste finale ...
                array_push($listStatut, $s); // ... et on l'insère
            }
        } else { // Si demande pour un bâtiment en particulier
            foreach ($statuts as $statut) {
                // Le fonctionnement est le même qu'au-dessus. Seul différence,
                // on rajoute une condition en plus dans notre recherche
                $nbTicket = (int)Ticket::model()->countByAttributes(array(
                    'visible' => Constantes::VISIBLE,
                    'fk_statut' => $statut['id_statut_ticket'],
                    'fk_batiment' => $idBatiment));
                Yii::trace($idBatiment, 'cron');
                $s = array(
                    'label' => Translate::trad($statut['label']),
                    'nb' => $nbTicket);
                array_push($listStatut, $s);
            }
        }
        
        return $listStatut;
            // Et enfin on retourne l'array contenant toutes les données demandées
    }

    /**
     * @param int $user Id du locataire
     * @return Batiment[] Liste des bâtiments de ce locataire
     * @soap
     */
    public function getBatiment($user) {
        $batiments = Batiment::model()->findBySql(""
                . "SELECT * "
                . "FROM w3sys_batiment as b "
                . "WHERE b.id_batiment IN "
                . "(SELECT fk_batiment FROM w3sys_lieu as l "
                . "WHERE l.fk_locataire =" . $user . " AND visible = " . Constantes::VISIBLE . ")");

        $retour = array();
        foreach ($batiments as $batiment) {
            array_push($retour, $batiment);
        }
        return $retour;
    }
    
    

}
