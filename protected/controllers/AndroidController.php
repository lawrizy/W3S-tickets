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
            $user = User::model()->findByAttributes(array('email' => $email, 'password' => md5($password)));
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
        foreach ($buildings_id as $idBuildings)
        {
            array_push($myBuildings, $idBuildings->id_batiment);
        }
        return $myBuildings;
    }

    /**
     * 
     * @param int $id_user id du locataire
     * @param int $sousCategorie id de la sous categorie
     * @param int $fk_batiment id du batiment
     * @return bool message
     * @soap
     */
    public function createTicket($id_user, $sousCategorie, $fk_batiment) {
        $ticketAndroid = new Ticket;
        $ticketAndroid->fk_locataire = $id_user;
        $ticketAndroid->fk_batiment = $fk_batiment;
        $ticketAndroid->fk_categorie = $sousCategorie;
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
        return "Heu ...";
    }

    /**
     * @soap @var int
     * @soap @var string
     * @soap @var int
     * @soap @var int
     * @soap @var int
     * @return string[] Liste des catégories parents
     * @soap
     */
    public function getCategorie() {
        $cats = CategorieIncident::model()->findAllByAttributes(
                array('visible' => Constantes::VISIBLE, 'fk_parent' => NULL));
        $retour = array();
        foreach ($cats as $cat) {
            $c = array(
                'id' => (string) $cat->id_categorie_incident,
                'label' => (string) $cat->label);
            array_push($retour, $c);
        }
        return $retour;
    }

    /**
     * @param int $parent Id de la catégorie-parent
     * @return CategorieIncident[] Liste des sous-catégories concernées
     * @soap
     */
    public function getSousCategorie($parent) {
        $sousCats = CategorieIncident::model()->findAllByAttributes(
                array('visible' => Constantes::VISIBLE, 'fk_parent' => $parent));

        $retour = array();
        foreach ($cats as $cat) {
            $c = array(
                'id' => $cat->id_categorie_incident,
                'label' => $cat->label);
            array_push($retour, $c);
        }
        return $retour;
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
