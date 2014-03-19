<?php

class TradController extends Controller {

    Const ID_CONTROLLER = 9;
    Const ACTION_VIEW = 1;
    Const ACTION_INDEX = 2;
    COnst ACTION_ADDTRADUCTION = 4;
    const ACTION_MODIFYTRADUCTION = 8;

    public $layout = '//layouts/column2';

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules() {
        if ((Yii::app()->session['Utilisateur'] == 'User') && (Yii::app()->session['Logged']->fk_fonction >= Constantes::FONCTION_ADMIN)) {
            return array(
                array(
                    "allow",
                    "actions" => array('view', 'index', 'addtraduction', 'modifytraduction'),
                    "users" => array('@'),
                ),
                array(
                    'deny',
                    'users' => array('?'),
                    'message' => 'Vous n\'avez pas accès à cette page.',
                )
            );
        } else {
            return array(
                array(
                    'deny',
                    'users' => array('?'),
                    'message' => 'Vous n\'avez pas accès à cette page.',
                )
            );
        }
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'trad-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function loadModel($id) {
        $model = Trad::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function actionIndex() {
        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('modifyTraduction'));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        $this->performAjaxValidation($model);

        if (isset($_POST['Trad'])) {
            $model->attributes = $_POST['Trad'];
            if ($model->save())
                $this->redirect(array('modifyTraduction'));
        }

        $this->render('update', array('model' => $model));
    }

    /**
     * Cette action est appelée lors de la création d'une traduction via l'interface admin.
     */
    public function actionAddTraduction() {
        $model = new Trad;

        // Yii::trace("Entrée dans actionAddTraduction", "cron"); // OK passe

        if (isset($_POST['Trad'])) {
            // Yii::trace("Objet trad bien reçu dans actionAddTraduction.", "cron"); // OK passe
            $model->attributes = $_POST['Trad'];
            // Exécution de la validation suivant les règles du modèle (code, fr, en, nl non null, etc...)
            if ($model->validate()) {
                // Yii::trace("La Trad passe le validate", "cron"); // OK passe
                // Sauvegarde de la nouvelle traduction
                try {
                    $model->save(true);
                    Yii::app()->user->setFlash("success", "L'insertion de la nouvelle traduction s'est bien passée.<br/>
                                Vous pouvez désormais l'utiliser en écrivant Translate::trad(\"" . $model->code . "\")");
                } catch (CDbException $cdbe) {
                    Yii::app()->user->setFlash("error", "Le code que vous voulez assigner est déjà utilisé.");
                }
                if (!isset($_GET['ajax']))
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('addTraduction'));
            }
            else {
                // Un soucis s'est produit (champs vide, etc...)
                //Yii::trace("La Trad ne passe pas le validate", "cron");
                Yii::app()->user->setFlash("error", "Un ou plusieurs champs n'a pas pu être validé.");
                if (!isset($_GET['ajax']))
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('addTraduction'));
            }
        }

        $this->render('addTraduction', array(
            'model' => $model,
        ));
    }

    public function actionModifyTraduction() {
        $model = new Trad('search');
        $model->unsetAttributes();
        if (isset($_GET['Trad']))
            $model->attributes = $_GET['Trad'];

        $this->render('modifyTraduction', array('model' => $model));
    }

}
