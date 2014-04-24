<?php

/*
 * Pour vérifier le WSDL (le fichier XML) de ce webservice, voir l'URL
 * http://[NomDeDomaine]/index.php/android/websys
 * 
 * Les méthodes ne sont pas encore utilisables
 */

class AndroidController extends Controller {

    /*
     * Les codes erreurs possibles lorsque le webService est appelé
     */
    const ERROR_SAVE_HISTORIQUE = '-4';
    const ERROR_SAVE_TICKET = '-3';
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

    /*
     * AccessRules donnant droit à l'appel du webservice
     */
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

    /*
     * Dans cette méthode on indique que lorsque l'on appelle l'action websys
     * de ce contrôleur, websys doit agir comme un webService et que Yii doit
     * générer le fichier WSDL associé. Et à partir de là on peut appeler les
     * méthodes de associés à ce webservices (voir commentaire sur méthode suivante)
     */
    public function actions() {
        return array(
            'websys' => array(
                'class' => 'CWebServiceAction',
            ),
        );
    }



    /*
     * Ici une méthode associée au webService. Pour associer une méthode au
     * webService il faut mettre les commentaires au dessus de cette méthode.
     * Il ne s'agit pas de simples commentaires comme celui-ci, si on regarde
     * bien, ces commentaires-là commencent par un slash suivi de 2 astérisques.
     * 
     * Un @soap pour l'associer au webService, on le met de préférence à le fin.
     * On y précise le nombre de paramètres ainsi que leur type ainsi que le
     * type de retour. C'est sur base de ces commentaires que Yii génèrera le 
     * fichier XML (WSDL) associé indiquant à ceux voulant l'appeler comment
     * utiliser le webService (quelle méthode a besoin de quoi, ...)
     */


    /**
     * @param string $email Email de l'utilisateur
     * @param string $password Mot de passe de l'utilisateur
     * @return int $error un code erreur
     * @soap
     */
    public function testLogin($email, $password)
    {
        // Méthode testant le login qui renvoie l'id de la personne ou un code erreur
        $error = self::ERROR_USER_INEXISTANT; // Initialisation de la variable de retour
        try
        {
            $user = User::model()->findByAttributes(array( // Recherche de cet utilisateur
                'visible' => Constantes::VISIBLE,
                'email' => $email,
                'password' => md5($password))); // On n'oublie pas de crypter le password
            if ($user !== null) // Si l'utilisateur existe alors on met son id dans la variable de retour
                $error = $user->id_user;
        } catch (CDbException $ex)
        {
            $error = self::ERROR_DB_INACCESSIBLE;
            // Si souci avec la DB, on met le code erreur adapté dans la variable de retour
        }
        return $error; // Et enfin un return
    }

    /**
     * @param int $id_user
     * @return string[] id des batiments
     * @soap
     */
    public function getMyBuilding($id_user)
    { // Demande des bâtiments pour un certain locataire
        $myBuildings = array(); // Initialisation de la variable de retour
        $buildings_id = Batiment::model()->findAllBySql(
            "SELECT b.id_batiment FROM w3sys_lieu l 
                    INNER JOIN w3sys_batiment b on  l.fk_batiment = b.id_batiment
                    WHERE l.fk_locataire =" . $id_user . " and "
            . "l.visible=" . Constantes::VISIBLE);
        // Recherche par SQL pour éviter de faire plein de recherche dans la DB
        foreach ($buildings_id as $idBuildings)
            array_push($myBuildings, $idBuildings->id_batiment);
        // On parcourt la liste reçue et on l'insère dans le tableau de retour
        return $myBuildings; // Et enfin le retour
    }

    /**
     * @param int $id_locataire ID du locataire
     * @param int $sousCategorie ID de la sous categorie
     * @param int $fk_batiment ID du batiment
     * @param string $etage Etage de l'incident
     * @param string $bureau Bureau de l'incident
     * @param string $descriptif Description de l'incident
     * @return string Code-Ticket
     * @soap
     */
    public function createTicket($id_locataire, $sousCategorie, $fk_batiment,
                                 $etage = null, $bureau = null, $descriptif = null)
    {
        // La création du ticket à partir de l'application Android
        $ticketAndroid = new Ticket;
        // On instancie un ticket et on y insère tout ce que l'on reçoit de l'application Android
        $ticketAndroid->fk_locataire = $id_locataire;
        $ticketAndroid->fk_batiment = $fk_batiment;
        $ticketAndroid->fk_categorie = $sousCategorie;
        $ticketAndroid->etage = $etage;
        $ticketAndroid->bureau = $bureau;
        $ticketAndroid->descriptif = "TicketAndroid: " . $descriptif;
        // Les champs suivants sont remplis par défaut
        $ticketAndroid->fk_canal = Constantes::CANAL_WEB;
        // Si créé à partir d'Android, on considère ça comme du web
        $ticketAndroid->fk_statut = Constantes::STATUT_OPENED; // Statut forcément ouvert
        $ticketAndroid->fk_user = Constantes::USER_DEFAUT; // Assigné à l'utilisateur par défaut
        $ticketAndroid->code_ticket = TicketController::createCodeTicket($fk_batiment);
        // On génère le code du ticket
        $cat = CategorieIncident::model()->findByPk($ticketAndroid['fk_categorie']);
        $ticketAndroid->fk_priorite = $cat['fk_priorite']; // Priorité par rapport à la catégorie
        if ($ticketAndroid->save(FALSE))
        { // On test le save du ticket
            $histo = new HistoriqueTicket(); // On génère l'historique associé
            $histo->date_update = date("Y-m-d H:i:s", time());
            $histo->fk_ticket = $ticketAndroid->id_ticket;
            $histo->fk_statut_ticket = Constantes::STATUT_OPENED;
            $histo->fk_user = $ticketAndroid['fk_locataire'];
            if ($histo->save(FALSE))
            { // On enregistre l'historique
                // ------------------ TODO Envoi de mail ------------------ //
                // On envoie un mail au locataire
                return $ticketAndroid->code_ticket;
                // Et enfin on return le code du ticket
            }
            else
            { // Si l'historique ne s'est pas enregistré
                return self::ERROR_SAVE_HISTORIQUE;
            }
        }
        else
        { // Si le ticket ne s'est pas enregistré
            return self::ERROR_SAVE_TICKET;
        }
    }


    /**
     * @param int $idBatiment id du bâtiment sur lequel filtrer
     * @param int $langue id de la langue à traduire (paramètre falcutatif)
     * @return object[] Liste des nombre de tickets par catégorie
     * @soap
     */
    public function getBarsDatas($idBatiment, $langue)
    {
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
        $sql = "";

        if ($idBatiment == 0)
        {
            // On prépare une requête SQL qui va rechercher le nombre de ticket
            $sql = "SELECT count(t.id_ticket) FROM w3sys_ticket t "
                . "WHERE t.visible = " . Constantes::VISIBLE . " "
                . "AND fk_categorie IN "
                . "(SELECT c.id_categorie_incident "
                . "FROM w3sys_categorie_incident c "
                . "WHERE c.fk_parent = ";
        }
        else
        {
            $sql = "SELECT count(t.id_ticket) FROM w3sys_ticket t "
                . "WHERE t.visible = " . Constantes::VISIBLE . " "
                . "AND fk_batiment = " . $idBatiment . " " // La condition supplémentaire
                . "AND fk_categorie IN "
                . "(SELECT c.id_categorie_incident "
                . "FROM w3sys_categorie_incident c "
                . "WHERE c.fk_parent = ";
        }

        foreach ($categories as $categorie)
        { // On parcourt toutes les catégories
            $nbTicket = Yii::app()->db->createCommand($sql . $categorie['id_categorie_incident'] . ")")->queryScalar();
            // La méthode queryScalar() permet de récupérer la toute première donnée
            // de la toute première ligne qui sera le résultat de la requête passée
            // en paramètre
            $cat = new CategorieAndroid( // On génère l'objet qui sera inseré dans la liste finale
                Translate::trad($categorie['label']), // On n'oublie pas de traduire
                $nbTicket);
            array_push($listCat, $cat); // Et on push à la liste à renvoyer
        }

        return $listCat;
        // Et enfin on retourne l'array contenant toutes les données demandées
    }

    /**
     * @param int $idBatiment Le bâtiment sur lequel filtrer
     * @param int $langue Langue d'affichage de l'application
     * @return object[] Liste des nombres de tickets par statut.
     * @soap
     */
    public function getPieDatas($idBatiment, $langue)
    {
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
                $s = new CategorieAndroid(
                    Translate::trad($statut['label']),
                    $nbTicket == NULL ? 0 : $nbTicket); // On génère l'array qu'on insèrera dans la liste finale ...
                array_push($listStatut, $s); // ... et on l'insère
            }
        }
        else { // Si demande pour un bâtiment en particulier
            foreach ($statuts as $statut) {
                // Le fonctionnement est le même qu'au-dessus. Seul différence,
                // on rajoute une condition en plus dans notre recherche
                $nbTicket = (int)Ticket::model()->countByAttributes(array(
                    'visible' => Constantes::VISIBLE,
                    'fk_statut' => $statut['id_statut_ticket'],
                    'fk_batiment' => $idBatiment)); // Condition supplémentaire
                $s = new CategorieAndroid(
                    Translate::trad($statut['label']),
                    $nbTicket == NULL ? 0 : $nbTicket);
                array_push($listStatut, $s);
            }
        }
        return $listStatut;
        // Et enfin on retourne l'array contenant toutes les données demandées
    }

    /**
     * @param int $idUser L'id de l'utilisateur
     * @return int L'id de la fonction associée à l'utilisateur
     * @soap
     */
    public function getUserPermissionLevel($idUser) {
        /* @var $model User */
        $error = self::ERROR_USER_INEXISTANT;
        try {
            $model = User::model()->findByPk($idUser);
            if ($model != null) $error = $model->fk_fonction;
        } catch (CDbException $e) {
            $error = self::ERROR_DB_INACCESSIBLE;
        }
        return $error;
    }
}
