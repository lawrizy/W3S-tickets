<?php

class DashboardController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

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
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        if (Yii::app()->session['Utilisateur'] == 'Locataire') {
            return array(
                array('deny', // deny all users
                    'actions' => array('vue'),
                    'users' => array('*'),
                ),
            );
        } elseif (isset (Yii::app ()->session['Logged'])&&Yii::app()->session['Logged']->fk_fonction == 2) {
            return array(
                array('allow', // deny all users
                    'users' => array('@'),
                ),
            );
        } elseif (isset (Yii::app()->session['Logged']) && Yii::app()->session['Logged']->fk_fonction == 1) {
            return array(
                array('deny', // deny all users
                    'actions' => array('vue'),
                    'users' => array('*'),
                ),
            );
        } else {
            return array(
                array('deny', // allow authenticated user to perform 'create' and 'update' actions
                    'actions' => array(),
                    'users' => array('?'),
                ),
//
            );
        }
    }

    /**
     * Lists all models.
     */
    public function actionVue() {
        $dataProvider = new CActiveDataProvider('Ticket');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
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

    public function getTicketByCategorie() {
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

    public function getCategoriesLabel() { //return list categorie's label
        $datas = CategorieIncident::model()->findAllByAttributes(array('fk_parent' => NULL));
        $listLabel = array();
        foreach ($datas as $data) {
            array_push($listLabel, $data['label']);
        }
        return $listLabel;
    }

    public function actionFilterByBatiment()
    {
        $idBatiment = $_POST['idBatiment'];
    }
}
