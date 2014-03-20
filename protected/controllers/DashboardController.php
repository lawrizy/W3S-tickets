<?php

class DashboardController extends Controller {

    Const ID_CONTROLLER = 4;
    Const ACTION_VUE = 1;
    Const ACTION_GETTICKETBYCATEGORIE = 2;
    COnst ACTION_GETTICKETBYCATEGORIEFORBATIMENTID = 4;
    const ACTION_GETTICKETBYSTATUSFORBATIMENTID = 8;
    const ACTION_GETCATEGORIESLABEL = 16;
    Const ACTION_FILTERBYBATIMENT= 32;
    Const ACTION_GETFREQUENCECALLEDBYENTREPRISE= 64;
 

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }
    
    /**
     * La méthode permettant d'accorder des droits aux différents utilisateurs.
     * Cette méthode est appelée à chaque fois que l'on veut accéder à une action
     * de ce controleur. La méthode vérifie les droits que cet utilisateur a sur
     * ce controleur et génère les arrays 'allow' (permis) et 'deny' (refusé)
     * selon ces droits-là.
     */
    public function accessRules() { // droit des utilisateur sur les actions
        if (Yii::app()->session['Utilisateur'] == 'Locataire') { // Locataire a des droits fixes
            return array(
                array('deny', // refuse autre users
                    'users' => array('@'), //tous utilisateur
                    'message' => 'Vous n\'avez pas accès à cette page.'
                ),
            );
        } elseif (Yii::app()->session['Utilisateur'] == 'User') { // Génération des droits selon le user
            
            // On récupère d'abord le user et ses droits de la session
            $logged = Yii::app()->session['Logged'];
            $rights = Yii::app()->session['Rights']->getDashboard();
            // On initialise ensuite les array qui stockeront les droits
            $allow = array();
            
            // Et enfin on teste chaque droit un à un, et si le droit est bien accordé,
            // on le rajoute à l'array qui sera envoyé dans le return
            if ($rights & self::ACTION_VUE) array_push($allow, 'vue');
            if ($rights & self::ACTION_GETTICKETBYCATEGORIE) array_push($allow, 'getticketbycategorie');
            if ($rights & self::ACTION_GETTICKETBYCATEGORIEFORBATIMENTID) array_push($allow, 'getticketbycategorieforbatimentid');
            if ($rights & self::ACTION_GETTICKETBYSTATUSFORBATIMENTID) array_push($allow, 'getticketbystatusforbatimentid');
            if ($rights & self::ACTION_GETCATEGORIESLABEL) array_push($allow, 'getcategorieslabel');
            if ($rights & self::ACTION_FILTERBYBATIMENT) array_push($allow, 'filterbybatiment');
            if ($rights & self::ACTION_GETFREQUENCECALLEDBYENTREPRISE) array_push($allow, 'getfrequencecalledentreprise');
            
            return array( // Ici on a plus qu'à envoyer la liste des droits
                    array('allow', // Ici l'array des droits 'permis'
                        'actions' => $allow, // Et on lui communique l'array que l'on a généré plus tôt
                        'users' => array('@'), // Autorisé pour les user loggés
                    ),
                    array('deny', // Refuse autre users
                        'users' => array('@'), // Refus aux visiteurs non loggés
                        'message' => 'Vous n\'avez pas accès à cette page.'
                            // Le message qui sera affiché
                    ),
                );
        } else { // Si autre utilisateur (visiteur)
            return array( // Ici on a plus qu'à envoyer la liste des droits
                    array('deny', // Refuse autre users
                        'users' => array('?'), // Refus aux visiteurs non loggés
                        'message' => 'Vous n\'avez pas accès à cette page.'
                            // Le message qui sera affiché
                    ),
                );
        }
    }

    /**
     * Lists all models.
     */
    public function actionVue() {

        $data = array('idBatiment' => 'ALL');

        $data['idBatiment'] = 'ALL';
        $this->render('index', $data);
    }

    /**
     * Retourne une liste contenant un label de catégorie lié à une valeur représentant la fréquence de cette catégorie dans la DB.
     * Format : array( [labelCatégorie] => [fréqCatégorie] )
     */
    public function getDataForCategoriesStats() {
        
    }

    public function getNombreIncidentElectricite() {
        return (int) CategorieIncident::model()->countByAttributes(array('fk_parent' => 2));
    }

    public function getNombreIncidentSanitaire() {
        return (int) CategorieIncident::model()->countByAttributes(array('fk_parent' => 1));
    }

    public function actionGetTicketByCategorie() {
        //Yii::trace("actionGetTicketByCategorie", "cron");
        $categories = $this->getCategories();
        $nbFinal = array();
        foreach ($categories as $categorie) {
            $nbCategorie = 0;
            $sousCategories = CategorieIncident::model()->findAllByAttributes(array('fk_parent' => $categorie['id_categorie_incident']));
            foreach ($sousCategories as $sousCategorie) {
                $nbCategorie += Ticket::model()->countByAttributes(array('fk_categorie' => $sousCategorie['id_categorie_incident']));
            }
            array_push($nbFinal, $nbCategorie);
        }
        return $nbFinal;
    }

    public function getCategories() { //retrurn list of categories
        $datas = CategorieIncident::model()->findAllByAttributes(array('fk_parent' => NULL));
        $listCategorie = array();
        foreach ($datas as $data) {
            array_push($listCategorie, $data);
        }
        return $listCategorie;
    }

    public function actionGetTicketByCategorieForBatimentID($idBatiment) {
        //Yii::trace("actionGetTicketByCategorie", "cron");
        $categories = $this->getCategories();
        $nbFinal = array();

        foreach ($categories as $categorie) {
            $nbCategorie = 0;
            $sousCategories = CategorieIncident::model()->findAllByAttributes(array('fk_parent' => $categorie['id_categorie_incident']));

            foreach ($sousCategories as $sousCategorie)
                $nbCategorie += Ticket::model()->countByAttributes(array('fk_categorie' => $sousCategorie['id_categorie_incident'], 'fk_batiment' => $idBatiment));

            array_push($nbFinal, $nbCategorie);
        }

        return $nbFinal;
    }

    /**
     * Retourne une liste de valeurs représentant la fréquence des statuts ticket pour un bâtiment donné (dont l'ID
     * est passé en paramètre).
     * @param $idBatiment Le bâtiment pour lequel calculer la fréquence des statuts ticket (ouvert, inprogress, closed)
     * @return array Une liste contenant un statut associé à une valeur représentant sa fréquence.
     *              Format : array($label=>$value)
     */
    public function actionGetTicketByStatusForBatimentID($idBatiment) {
        $nbStatutTicket = array();

        for ($idStatut = Constantes::PRIORITE_LOW; $idStatut <= Constantes::PRIORITE_HIGH; ++$idStatut) {
            $nbTicket = Ticket::model()->countByAttributes(array('fk_batiment' => $idBatiment, 'fk_statut' => $idStatut));

            $label = $idStatut != Constantes::PRIORITE_LOW ? $idStatut == Constantes::PRIORITE_HIGH ? ' en cours' : ' clôturé(s)'  : ' nouveau(x)';
            $color = $idStatut != Constantes::PRIORITE_LOW ? $idStatut == Constantes::PRIORITE_HIGH ? "rgba(242,106,22,1)" : "rgba(66,200,22,1)"  : "rgba(220, 0,0,1)";
            $value = array(
                "value" => (int) $nbTicket,
                "color" => $color,
                "label" => (int) ($nbTicket) . $label);
            array_push($nbStatutTicket, $value);
        }
        return $nbStatutTicket;
    }

    /**
     * Retourne la liste de tous les noms (labels) des catégories principales, afin d'être affichées sur un graphique.
     * @return array Une liste de labels de catégories principales.
     */
    public function actionGetCategoriesLabel() { //return list categorie's label
        //Yii::trace("getTicketByCategorie", "cron");
        $datas = CategorieIncident::model()->findAllByAttributes(array('fk_parent' => NULL));
        $listLabel = array();
        foreach ($datas as $data) {
            array_push($listLabel, Translate::trad($data['label']));
        }
        return $listLabel;
    }

    /**
     * Fonction AJAX appelée par la dropDownList de la page index.php du dashboard, afin de filtrer les données
     * par bâtiment et ainsi afficher les graphiques en fonction d'un bâtiment spécifique.
     *
     * La méthode n'est qu'un relais entre la page index.php et _ajaxUpdateGraphs.php, qui elle génère les graphiques
     * "physiquement" en fonction des paramètres ($data) qui lui sont passés.
     */
    public function actionFilterByBatiment() {
        $data = array();
        $data['idBatiment'] = $_POST['idBatiment'];
        $this->renderPartial('_ajaxUpdateGraphs', $data, false, true);
    }

    /**
     * TODO commenter
     * @return array
     */
    public function actionGetFrequenceCalledEntreprise() {
        $data = array(); // Format : array( array([nom entreprise] => [nb appels]) )
        $db = Yii::app()->db;
        $entreprisesID = Entreprise::model()->findAllBySql("SELECT id_entreprise, nom FROM w3sys_entreprise order by id_entreprise asc");
        foreach ($entreprisesID as $entry) {
            //echo $entry['id_entreprise'] . " " . $entry['nom'] . "<br/>"; // Debug echo
            // Préparer les variables, on peut déjà récupérer le nom de l'entreprise en cours et calculer sa fréquence
            $currentEntrepriseName = $entry['nom'];
            // Dans la table Ticket, on compte le nombre d'occurences de l'ID de l'entreprise en cours
            $currentEntrepriseCount = Ticket::model()->countByAttributes(array('fk_entreprise' => $entry['id_entreprise']));
            // pusher le résultat en cours dans la table de résultat
            $data_to_push = array($currentEntrepriseName => $currentEntrepriseCount);
            array_push($data, $data_to_push);
            // print_r($data_to_push); // Debug print_r
        }

        return $data;
    }

    public function actionGetNombreTicketsParUser() {
        $returnData = array();

        return $returnData;
    }

}
