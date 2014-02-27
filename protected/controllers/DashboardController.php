<?php

class DashboardController extends Controller
{

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        if (Yii::app()->session['Utilisateur'] == 'Locataire')
        { // locataire
            return array(
                array('deny', 'users' => array('*'), //pas de dashboard
                    'message' => 'Vous n\'avez pas accès à cette page.'), //message
            );
        }
        elseif (isset(Yii::app()->session['Logged']) && Yii::app()->session['Logged']->fk_fonction == 2)
        { //user admin
            return array(
                array('allow',
                    'actions' => array('vue', 'filterbybatiment', 'getticketbystatusforbatimentid',
                        'getticketbycategorie', 'getcategorieslabel', 'getfrequencestatutsentreprises'),
                    'users' => array('*')
                ),
                array('deny', 'users' => array('*'),
                    'message' => 'Vous n\'avez pas accès à cette page.'), //message),
            );
        }
        elseif (isset(Yii::app()->session['Logged']) && Yii::app()->session['Logged']->fk_fonction == 1)
        { //user non admin peut dashboard
            return array(
                array('deny', 'users' => array('*'),
                    'message' => 'Vous n\'avez pas accès à cette page.'),
            );
        }
        else
        {
            return array(
                array('deny', // allow authenticated user to perform 'create' and 'update' actions
                    'actions' => array(),
                    'users' => array('?'),
                    'message' => 'Vous n\'avez pas accès à cette page.'),
//
            );
        }
    }

    /**
     * Lists all models.
     */
    public function actionVue()
    {
        $data = array();
        $data['idBatiment'] = 'ALL';
        $this->render('index', $data);
    }

    /**
     * Retourne une liste contenant un label de catégorie lié à une valeur représentant la fréquence de cette catégorie dans la DB.
     * Format : array( [labelCatégorie] => [fréqCatégorie] )
     */
    public function getDataForCategoriesStats()
    {

    }

    public function getNombreIncidentElectricite()
    {
        return (int)CategorieIncident::model()->countByAttributes(array('fk_parent' => 2));
    }

    public function getNombreIncidentSanitaire()
    {
        return (int)CategorieIncident::model()->countByAttributes(array('fk_parent' => 1));
    }

    public function actionGetTicketByCategorie()
    {
        //Yii::trace("actionGetTicketByCategorie", "cron");
        $categories = $this->getCategories();
        $nbFinal = array();
        foreach ($categories as $categorie)
        {
            $nbCategorie = 0;
            $sousCategories = CategorieIncident::model()->findAllByAttributes(array('fk_parent' => $categorie['id_categorie_incident']));
            foreach ($sousCategories as $sousCategorie)
            {
                $nbCategorie += Ticket::model()->countByAttributes(array('fk_categorie' => $sousCategorie['id_categorie_incident']));
            }
            array_push($nbFinal, $nbCategorie);
        }
        return $nbFinal;
    }

    public function getCategories()
    { //retrurn list of categories
        $datas = CategorieIncident::model()->findAllByAttributes(array('fk_parent' => NULL));
        $listCategorie = array();
        foreach ($datas as $data)
        {
            array_push($listCategorie, $data);
        }
        return $listCategorie;
    }

    public function actionGetTicketByCategorieForBatimentID($idBatiment)
    {
        //Yii::trace("actionGetTicketByCategorie", "cron");
        $categories = $this->getCategories();
        $nbFinal = array();

        foreach ($categories as $categorie)
        {
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
    public function actionGetTicketByStatusForBatimentID($idBatiment)
    {
        $nbStatutTicket = array();
        for ($idStatut = 1; $idStatut <= 3; ++$idStatut)
        {
            $nbTicket = Ticket::model()->countByAttributes(array('fk_batiment' => $idBatiment, 'fk_statut' => $idStatut));
            $label = $idStatut != 1 ? $idStatut == 2 ? ' en cours' : ' clôturé(s)' : ' nouveau(x)';
            $color = $idStatut != 1 ? $idStatut == 2 ? "rgba(242,106,22,1)" : "rgba(66,200,22,1)" : "rgba(220, 0,0,1)";
            $value = array(
                "value" => (int)$nbTicket,
                "color" => $color,
                "label" => (int)($nbTicket) . $label);
            array_push($nbStatutTicket, $value);
        }
        return $nbStatutTicket;
    }

    /**
     * Retourne la liste de tous les noms (labels) des catégories principales, afin d'être affichées sur un graphique.
     * @return array Une liste de labels de catégories principales.
     */
    public function actionGetCategoriesLabel()
    { //return list categorie's label
        //Yii::trace("getTicketByCategorie", "cron");
        $datas = CategorieIncident::model()->findAllByAttributes(array('fk_parent' => NULL));
        $listLabel = array();
        foreach ($datas as $data)
        {
            array_push($listLabel, Yii::t('model/categorieIncident',$data['label']));
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
    public function actionFilterByBatiment()
    {
        $data = array();
        $data['idBatiment'] = $_POST['idBatiment'];
        $this->renderPartial('_ajaxUpdateGraphs', $data, false, true);
    }

    /**
     * TODO commenter
     * @return array
     */
    public function actionGetFrequenceCalledEntreprise()
    {
        $data = array(); // Format : array( array([nom entreprise] => [nb appels]) )
        
        $entreprisesID = Entreprise::model()->findAllBySql("SELECT id_entreprise, nom FROM w3sys_entreprise order by id_entreprise asc");
        foreach($entreprisesID as $entry)
        {
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
}

//TODO commenter les méthodes
