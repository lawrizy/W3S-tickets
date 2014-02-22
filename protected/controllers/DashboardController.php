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
        if (Yii::app()->session['Utilisateur'] == 'Locataire') { // locataire
            return array(
                array('deny', 'users' => array('*'), //pas de dashboard
                    'message' => 'Vous n\'avez pas accès à cette page.'), //message
            );
        } elseif (isset(Yii::app()->session['Logged']) && Yii::app()->session['Logged']->fk_fonction == 2) { //user admin
            return array(
                array('allow',
                    'actions' => array('vue', 'filterbybatiment', 'getticketbycategorie', 'getcategorieslabel'), //peut tout faire
                    'users' => array('*')
                ),
                array('deny', 'users' => array('*'),
                    'message' => 'Vous n\'avez pas accès à cette page.'), //message),
            );
        } elseif (isset(Yii::app()->session['Logged']) && Yii::app()->session['Logged']->fk_fonction == 1) { //user non admin peut dashboard
            return array(
                array('deny', 'users' => array('*'),
                    'message' => 'Vous n\'avez pas accès à cette page.'),
            );
        } else {
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

    public function actionGetTicketByCategorieForBatimentID($idBatiment)
    {
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

    public function getCategories()
    { //retrurn list of categories
        $datas = CategorieIncident::model()->findAllByAttributes(array('fk_parent' => NULL));
        $listCategorie = array();
        foreach ($datas as $data) {
            array_push($listCategorie, $data);
        }
        return $listCategorie;
    }

    public function actionGetCategoriesLabel()
    { //return list categorie's label
        //Yii::trace("getTicketByCategorie", "cron");
        $datas = CategorieIncident::model()->findAllByAttributes(array('fk_parent' => NULL));
        $listLabel = array();
        foreach ($datas as $data) {
            array_push($listLabel, $data['label']);
        }
        return $listLabel;
    }

    public function actionFilterByBatiment()
    {
        $data = array();
        $data['idBatiment'] = $_POST['idBatiment'];
        $this->renderPartial('_ajaxUpdateGraphs', $data, false, true);
    }



}
