<?php

class CategorieIncidentController extends Controller {

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
        if ((Yii::app()->session['Utilisateur'] == 'User') && (Yii::app()->session['Logged']->fk_fonction == 2)) {
            return array(
                array('allow', // allow authenticated user to perform 'create' and 'update' actions
                    'actions' => array('create', 'update', 'view', 'admin', 'traitement', 'getsouscategoriesdynamiques', 'close', 'sendnotificationmail'),
                    'users' => array('*'), //user logger
                ),
            );
        } else {
            return array(
                array('deny',
                    'users' => array('*'), //user non loger peut rien faire
                    'message' => 'Vous n\'avez pas accès à cette page.'
                ),
            );
        }
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new CategorieIncident;

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

        if (isset($_POST['CategorieIncident'])) {
            $model->attributes = $_POST['CategorieIncident'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id_categorie_incident));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

        if (isset($_POST['CategorieIncident'])) {
            $model->attributes = $_POST['CategorieIncident'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id_categorie_incident));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('CategorieIncident');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new CategorieIncident('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['CategorieIncident']))
            $model->attributes = $_GET['CategorieIncident'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return CategorieIncident the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = CategorieIncident::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CategorieIncident $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'categorie-incident-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}