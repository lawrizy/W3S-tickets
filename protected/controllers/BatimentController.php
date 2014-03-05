<?php

class BatimentController extends Controller {

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
     * La fonction permettant d'accorder des droits aux différents utilisateurs.
     * Quand la méthode est appellée, on vérifie le type de l'utilisateur,
     * et en fonction de cela, les droits accordés peuvent varient.
     */
    public function accessRules() {
        if ((Yii::app()->session['Utilisateur'] == 'User') && (Yii::app()->session['Logged']->fk_fonction == Constantes::FONCTION_ROOT)) {
            // Si ['User'] et [fonction = id_admin], alors c'est un admin
            return array(
                array('allow', // 'allow' veut dire que l'utilisateur a droit à ce qui suit.
                    'actions' => array('*'), // L'admin à tous les droits
                    'users' => array('*'),
                // Tous les droits accordés à tout le monde, mais comme il faut être admin 
                // pour arriver là alors il n'y a que les admins qui ont ces droits-là
                ),
            );
        } else {
            // Si ['Locataire'] ou [['User'] et [fonction = id_user]], alors l'utilisateur n'a aucun droit
            return array(
                array('deny', // 'deny' veut dire que l'on renie les droits à l'utilisateur
                    'users' => array('*'),
                    // Aucun droit à tous ceux qui arrivent ici
                    'message' => 'Vous n\'avez pas accès à cette page.'
                // Message qu'affichera la page d'erreur
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
        $model = new Batiment;

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

        if (isset($_POST['Batiment'])) {
            $model->attributes = $_POST['Batiment'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id_batiment));
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

        if (isset($_POST['Batiment'])) {
            $model->attributes = $_POST['Batiment'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id_batiment));
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
    public function actionDelete($id) { // Soft-delete, on passe un champ visible à 0 plutôt que de supprimer l'enregistrement
        try {
            $model = $this->loadModel($id); // On récupère l'enregistrement de ce bâtiment
            $model['visible'] = Constantes::INVISIBLE; // et on met l'enregistrement à l'état invisible
            $model->save(FALSE); // et enfin on enregistre cet état invisible dans la DB

            $tickets = Ticket::model()->findAllByAttributes(array('fk_batiment' => $id)); // On recherche tous les tickets qui sont liés à ce bâtiment
            foreach ($tickets as $ticket) { // et on les passe tous à l'état invisible
                $ticket['visible'] = Constantes::INVISIBLE;
                $ticket->save(FALSE);
            }

            $lieux = Lieu::model()->findAllByAttributes(array('fk_batiment' => $id)); // On recherche tous les lieux qui sont liés à ce bâtiment
            foreach ($lieux as $lieu) { // et on les passe tous à l'état invisible
                $lieu['visible'] = Constantes::INVISIBLE;
                $lieu->save(FALSE);

                // Par contre, si le lieu d'un locataire est supprimé, et que ce locataire n'a plus d'autres lieux, on 'delete' aussi ce locataire
                $locataires = Lieu::model()->findAllByAttributes(array('fk_locataire' => $lieu['fk_locataire'], 'visible' => Constantes::VISIBLE));
                // On recherche donc les autres lieux pour ce locataires (lieux encore visible bien sûr)
                if ($locataires == NULL) { // S'il n'y a pas d'autres lieux pour ce locataire, on le 'delete'
                    $locataire = Locataire::model()->findByPk($lieu['fk_locataire']);
                    $locataire['visible'] = Constantes::INVISIBLE;
                    $locataire->save(FALSE);
                }
            }

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            
        } catch (CDbException $e) {
            
            $this->render('error', 'Erreur avec la base de données, veuillez contacter votre administrateur');
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Batiment');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Batiment('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Batiment']))
            $model->attributes = $_GET['Batiment'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Batiment the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Batiment::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Batiment $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'batiment-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
