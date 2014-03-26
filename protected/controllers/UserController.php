<?php

class UserController extends Controller {
    /*
     * Les constantes suivantes correspondent aux actions. Il y a une constante
     * pour chaque action de ce contrôleur. Ces constantes serviront à attribuer
     * ou non des droits aux utilisateurs (voir la méthode 'accessRules()' de 
     * ce même contrôleur)
     */

    Const ID_CONTROLLER = 9;
    Const ACTION_VIEW = 1;
    Const ACTION_CREATE = 2;
    COnst ACTION_DELETE = 4;
    const ACTION_UPDATE = 8;
    const ACTION_ADMIN = 16;
    // const ACTION_CHANGEPASSWORD = 32;

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
     * La méthode permettant d'accorder des droits aux différents utilisateurs.
     * Cette méthode est appelée à chaque fois que l'on veut accéder à une action
     * de ce controleur. La méthode vérifie les droits que cet utilisateur a sur
     * ce controleur et génère l'array 'allow' (permis) selon ces droits-là.
     */
    public function accessRules() { // droit des utilisateur sur les actions
        if (!Yii::app()->user->isGuest) { // Génération des droits selon le user
            // On récupère d'abord le user de la session
            $logged = Yii::app()->session['Logged'];
            // ainsi que ses droits sur ce contrôleur
            $rights = Yii::app()->session['Rights']->getUser();
            // La méthode getUser() demande à ne récupérer que les droits
            // lié à ce contrôleur-ci (en l'occurence, user)

            $allow = array('noright');
            // On initialise ensuite l'array qui stockera les droits
            // On lui met une action inexistante car la méthode accessRules
            // considère qu'un array vide c'est avoir tous les droits

            /* Et enfin on teste chaque droit un à un, et si le droit est bien accordé,
             * on le rajoute à l'array qui sera envoyé dans le return
             */
            // Le test s'effectue grâce à un opérateur de comparaison de bit.
            // On vérifie que dans l'integer représentant les droits sur ce contrôleur,
            // le bit correspondant à un certain nombre soit bien à un.
            // Ces nombres-là sont les valeurs des constantes tout en haut de la classe,
            // on a volontairement choisi des nombres binaires (1, 2, 4, 8, ...) pour que
            // chaque nombre n'ait qu'un seul bit à '1' et n'accorde donc qu'un seul droit
            if ($rights & self::ACTION_VIEW)
                array_push($allow, 'view');
            if ($rights & self::ACTION_CREATE)
                array_push($allow, 'create');
            if ($rights & self::ACTION_DELETE)
                array_push($allow, 'delete');
            if ($rights & self::ACTION_UPDATE)
                array_push($allow, 'update');
            if ($rights & self::ACTION_ADMIN)
                array_push($allow, 'admin');
            
            // Ce droit est un droit que tout le monde a
            array_push($allow, 'changepassword');

            return array(// Ici on a plus qu'à envoyer la liste des droits
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
        }
        else { // Si autre utilisateur (visiteur)
            return array(// Ici on a plus qu'à envoyer la liste des droits
                array('deny', // Refuse autre users
                    'users' => array('?'), // Refus aux visiteurs non loggés
                    'message' => 'Vous n\'avez pas accès à cette page.'
                // Le message qui sera affiché
                ),
            );
        }
    }

//    /*
//     * Cette action nous permet d'attribuer des droits aux utilisateurs.
//     * Sur la vue associée, on tombe sur un tableau permettant de choisir quels
//     * droits donner à l'utilisateur selectionné.
//     */
//
//    public function actionAccorderDroit($id) {
//        $model = $this->loadModel($id);
//
//        if (isset($_POST['Admin'])) {
//
//
//            $this->redirect(array('view', 'id' => $model->id_user));
//        }
//
//        $this->render('accorderDroit', array('model' => $model));
//    }

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
        /* @var CDbConnection $db */
        /* @var CDbTransaction $tsql */
        $db = Yii::app()->db;
        $tsql = $db->beginTransaction();

        $model = new User;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['User'])) {
            try {
                $model->attributes = $tmp = $_POST['User'];
                $tmp['password'] = md5($tmp['password']);
                $model->attributes = $tmp;
                if ($model->validate() && $model->save(true)) {
                    $tsql->commit();
                    $this->redirect(array('view', 'id' => $model->id_user));
                } else {
                    $err = "Une erreur est survenue : <br/>";
                    foreach ($model->getErrors() as $k => $v)
                        $err .= $v[0] . "<br/>";
                    throw new Exception($err);
                }
            } catch (Exception $e) {
                $tsql->rollback();
                Yii::app()->user->setFlash('error', $e->getMessage());
                $this->redirect(array('create'));
            }
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
        /* @var CDbConnection $db */
        /* @var CDbTransaction $tsql */
        $db = Yii::app()->db;
        $tsql = $db->beginTransaction();

        $model = $this->loadModel($id);

        if (isset($_POST['User'])) {
            try {
                $user = $_POST['User'];
                $user['password'] = $model->password;
                $model->attributes = $user;

                if ($model->validate() && $model->save()) {
                    $tsql->commit();
                    $this->redirect(array('view', 'id' => $model->id_user));
                } else {
                    $err = "Une erreur est survenue : <br/>";
                    foreach ($model->getErrors() as $k => $v)
                        $err .= $v[0] . "<br/>";
                    throw new Exception($err);
                }
            } catch (Exception $e) {
                $tsql->rollback();
                Yii::app()->user->setFlash('error', $e->getMessage());
                $this->redirect(array('update', 'id' => $model->id_user));
            }
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
        /* @var CDbConnection $db */
        /* @var CDbTransaction $tsql */
        $db = Yii::app()->db;
        $tsql = $db->beginTransaction();

        $model = $this->loadModel($id);
        $model->setAttribute("visible", 0);
        try {
            if ($model->validate() && $model->save(true)) {
                $tsql->commit();
                $this->redirect(array('admin'));
            } else {
                $err = "Une erreur est survenue : <br/>";
                foreach ($model->getErrors() as $k => $v)
                    $err .= $v[0] . "<br/>";
                throw new Exception($err);
            }
        } catch (Exception $e) {
            $tsql->rollback();
            Yii::app()->user->setFlash('error', $e->getMessage());
            $this->redirect(array('admin'));
        }

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('User');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new User('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['User']))
            $model->attributes = $_GET['User'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return User the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = User::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param User $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionChangePassword() {
        /* @var CDbConnection $db */
        /* @var CDbTransaction $tsql */
        $db = Yii::app()->db;
        $tsql = $db->beginTransaction();

        $model = User::model()->findByPk($_GET['id']);
        //    $this->render('changePassword', array('model' => $varUser));
        if (isset($_POST['AncienMdp'])) {
            try {
                if (md5($_POST['AncienMdp']) === $model->password) {
                    if ($_POST['NouveauMdp'] != NULL && $_POST['NouveauMdp'] === $_POST['NouveauMdp1']) {
                        $model->password = md5($_POST['NouveauMdp1']);
                        if ($model->validate() && $model->save()) {
                            $tsql->commit();
                            Yii::app()->user->setFlash('success', '<strong>Votre nouveau mot de passe a bien été enregistré!' . '</strong>');
                        } else {
                            $err = "Une erreur est survenue : <br/>";
                            foreach ($model->getErrors() as $k => $v)
                                $err .= $v[0] . "<br/>";
                            throw new Exception($err);
                        }
                    } else {
                        throw new Exception('<strong>Erreur les nouveaux mots de passe sont différents !' . '</strong>');
                    }
                } else {
                    throw new Exception('<strong>Erreur votre ancien mot de passe est erroné !' . '</strong>');
                }
            } catch (Exception $e) {
                $tsql->rollback();
                Yii::app()->user->setFlash('error', $e->getMessage());
            }
        }
        $this->render('changePassword',array('model'=>$model));
    }

}
