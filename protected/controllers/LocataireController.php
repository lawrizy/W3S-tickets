<?php

class LocataireController extends Controller {
    
    /*
     * Les constantes suivantes correspondent aux actions. Il y a une constante
     * pour chaque action de ce contrôleur. Ces constantes serviront à attribuer
     * ou non des droits aux utilisateurs (voir la méthode 'accessRules()' de 
     * ce même contrôleur)
     */
    const ID_CONTROLLER = 6;
    const ACTION_VIEW = 1;
    const ACTION_CREATE = 2;
    const ACTION_DELETE = 4;
    const ACTION_UPDATE = 8;
    const ACTION_ADMIN = 16;
    const ACTION_TOUS = 31;
//    const ACTION_ADDLIEU = 32;
//    const ACTION_DELETELIEU = 64;
//    const ACTION_CHANGEPASSWORD = 128;

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
            // On récupère d'abord le user et ses droits de la session
            $logged = Yii::app()->session['Logged'];
            $rights = Yii::app()->session['Rights']->getLocataire();
            // La méthode getLocataire() demande à ne récupérer que les droits
            // lié à ce contrôleur-ci (en l'occurence, locataire)

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
            if ($rights & self::ACTION_VIEW) array_push($allow, 'view');
            if ($rights & self::ACTION_CREATE) array_push($allow, 'create');
            if ($rights & self::ACTION_DELETE) array_push($allow, 'delete');
            if ($rights & self::ACTION_ADMIN) array_push($allow, 'admin');
            if ($rights & self::ACTION_UPDATE){
                array_push($allow, 'update');
                array_push($allow, 'addlieu');
                array_push($allow, 'deletelieu');
            }

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
        } else { // Si autre utilisateur (visiteur)
            return array(// Ici on a plus qu'à envoyer la liste des droits
                array('deny', // Refuse autre users
                    'users' => array('?'), // Refus aux visiteurs non loggés
                    'message' => 'Vous n\'avez pas accès à cette page.'
                // Le message qui sera affiché
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
        /* @var CDbConnection $db */
        /* @var CDbTransaction $tsql */
        $db = Yii::app()->db;
        $model = new User;

        if (isset($_POST['User'])) {
            $tsql = $db->beginTransaction();
            $tmp = new User();
            $model->attributes = $tmp->attributes = $_POST['User'];
            $model->fk_fonction = $tmp->fk_fonction = Constantes::FONCTION_LOCATAIRE;
            try {
                Yii::trace('Avant save', 'cron');
                if ($tmp->validate()) {
                    $tmp->setAttribute("password", md5($tmp->password));
                    if (!$tmp->save(FALSE)) throw new Exception (Translate::trad('erreurProduite'));
                    Yii::trace('id du locataire ' . $tmp->id_user, 'cron');
                    RightsController::createRights($tmp->id_user, $tmp->fk_fonction);
                    $tsql->commit();
                    Yii::app()->user->setFlash('success', 'Le locataire a bien été créé.');
                    $this->redirect(array('view', 'id' => $tmp->id_user));
                } else {
                    $errMessage = Translate::trad('erreurProduite');
                    foreach ($model->getErrors() as $key => $value)
                        $errMessage .= $value[0] . "<br/>";
                    throw new Exception($errMessage);
                }
            } catch (Exception $ex) {
                $tsql->rollback();
                if ($ex->getCode() === Constantes::DB_ERROR_UNIQUE) {
                    Yii::app()->user->setFlash('error', Translate::trad('mailUnique'));
                } else {
                    Yii::app()->user->setFlash('error', $ex->getMessage());
                }
                $this->render('create', array(
                    'model' => $model,
                ));
            }
        } else {
            $this->render('create', array(
                'model' => $model,
            ));
        }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        /* @var CDbConnection $db */
        /* @var CDbTransaction $tsql */
        $model = $this->loadModel($id);
        $db = Yii::app()->db;

        if (isset($_POST['User'])) {
            $locataire = $_POST['User'];
            $locataire['password'] = $model->password; // On ne change pas le MDP par cette interface -> voir changer mot de passe
            $model->attributes = $locataire;
            $tsql = $db->beginTransaction();
            try {
                if ($model->validate() && $model->save()) {
                    $tsql->commit();
                    Yii::app()->user->setFlash('success', Translate::trad('successMajLocataire'));
                    $this->redirect(array('view', 'id' => $model->id_user));
                } else {
                    $errMessage = Translate::trad('erreurProduite');
                    foreach ($model->getErrors() as $key => $value)
                        $errMessage .= $value[0] . "<br/>";
                    throw new Exception($errMessage);
                }
            } catch (Exception $erreur) {
                $tsql->rollback();
                Yii::app()->user->setFlash('error', $erreur->getMessage());
                $this->render('update', array(
                    'model' => $model,
                ));
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
        // Au lieu de hard delete le locataire, on passe son champs "visible" à 0 (invisible)
        $model->setAttribute("visible", Constantes::INVISIBLE);
        // On sauvegarde ensuite les changements faits
        try {
            if ($model->save(FALSE)) {
                $tsql->commit();
                Yii::app()->user->setFlash('success', Translate::trad('successDeleteLocataire'));
            } else {
                $err = Translate::trad('erreurProduite');
                foreach ($model->getErrors() as $k => $v)
                    $err .= $v[0] . "<br/>";
                throw new Exception($err);
            }

            // Trouver la liste des tickets liés au locataire. On récupère une liste de CActiveRecords
            $tickets = $model->ticketsLocataire;
            // Boucle foreach sur chaque enregistrement ($key => $value)
            foreach ($tickets as $key => $ticket) {
                // Passer le champs visible de chaque enregistrement trouvé à invisible
                $ticket->setAttribute('visible', Constantes::INVISIBLE);
                // Faire un save() du changement effectué
                if ($ticket->save(FALSE)) {
                    $tsql->commit();
                    
                } else {
                    $err = Translate::trad('erreurProduite');
                    foreach ($ticket->getErrors() as $k => $v)
                        $err .= $v[0] . "<br/>";
                    throw new Exception($err);
                }
            }
            $this->redirect(array('admin'));
        } catch (Exception $erreur) {
            $tsql->rollback();
            Yii::app()->user->setFlash('error', $erreur->getMessage());
            $this->redirect(array('admin'));
        }

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new User('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Locataire']))
            $model->attributes = $_GET['Locataire'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Locataire the loaded model
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
     * @param Locataire $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'locataire-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionDeleteLieu() {
        /* @var CDbConnection $db */
        /* @var CDbTransaction $tsql */
        $db = Yii::app()->db;
        $tsql = $db->beginTransaction();

        $model = User::model()->findByPk($_GET['id']);

        if (isset($_POST['Batiment'])) {
            try {
                $modelLieu = Lieu::model()->findByAttributes(array(
                    'fk_locataire' => $model->id_user, 'fk_batiment' => $_POST['Batiment'], 'visible' => Constantes::VISIBLE));
                $modelLieu['visible'] = Constantes::INVISIBLE;
                if ($modelLieu->validate() && $modelLieu->save(FALSE)) {
                    $tsql->commit();
                    Yii::app()->user->setFlash('success', 'Le locataire '.
                        $model->nom . ' n\'habite plus dans le bâtiment: ' . $modelLieu->fkBatiment->nom);
                    $this->redirect(array('deleteLieu?id=' . $model->id_user));
                } else {
                    $err = Translate::trad('erreurProduite');
                    foreach ($modelLieu->getErrors() as $k => $v)
                        $err .= $v[0] . "<br/>";
                    throw new Exception($err);
                }
            } catch (Exception $erreur) {
                $tsql->rollback();
                Yii::app()->user->setFlash('error', $erreur->getMessage());
                $this->redirect(array('admin'));
            }
        } else {
            $this->render('deleteLieu', array('model' => $model));
        }
    }

    public function actionaddLieu() {
        /** @var CDbConnection $db */
        /** @var CDbTransaction $tsql */
        $db = Yii::app()->db;
        $tsql = $db->beginTransaction();

        $model = User::model()->findByPk($_GET['id']);
        
        if (isset($_POST['Batiment'])) {
            try {
                $modelLieu = new Lieu();
                $modelLieu['fk_locataire'] = $model->id_user;
                $modelLieu['fk_batiment'] = $_POST['Batiment'];
                if ($modelLieu->validate() && $modelLieu->save(FALSE)) {
                    $tsql->commit();
                    Yii::app()->user->setFlash('success', '<strong>Cette adresse a bien été ajoutée pour: ' . $model->nom . '</strong>');
                    $this->redirect(array('addLieu?id=' . $model->id_user));
                } else {
                    $err = Translate::trad('erreurProduite');
                    foreach ($modelLieu->getErrors() as $k => $v)
                        $err .= $v[0] . "<br/>";
                    throw new Exception($err);
                }
            } catch (Exception $erreur) {
                $tsql->rollback();
                Yii::app()->user->setFlash('error', $erreur->getMessage());
                $this->redirect(array('admin'));
            }
        } else {
            $this->render('addLieu', array('model' => $model));
        }
    }

    public function actionChangePassword() {
        /* @var CDbConnection $db */
        /* @var CDbTransaction $tsql */
        $db = Yii::app()->db;
        $tsql = $db->beginTransaction();

        $model = $this->loadModel($_GET['id']);
        if (isset($_POST['AncienMdp'])) {
            try {
                if (md5($_POST['AncienMdp']) === $model->password) {
                    if ($_POST['NouveauMdp'] != NULL && $_POST['NouveauMdp'] === $_POST['NouveauMdp1']) {
                        $model->password = md5($_POST['NouveauMdp1']);
                        if ($model->validate() && $model->save(FALSE)) {
                            $tsql->commit();
                            Yii::app()->user->setFlash('success', '<strong>Votre nouveau mot de passe a bien été enregistré!' . '</strong>');
                        } else {
                            $err = Translate::trad('erreurProduite');
                            foreach ($model->getErrors() as $k => $v)
                                $err .= $v[0] . "<br/>";
                            throw new Exception($err);
                        }
                    } else {
                        throw new Exception('<strong>Erreur les nouveaux mots de passe ne sont pas pareils !' . '</strong>');
                    }
                } else {
                    throw new Exception('<strong>Erreur votre ancien mot de passe est erroné !' . '</strong>');
                }
            } catch (Exception $e) {
                $tsql->rollback();
                Yii::app()->user->setFlash('error', $e->getMessage());
                $this->redirect(array('changepassword', 'id' => $model->id_locataire));
            }
        } else {
            $this->render('changePassword');
        }
    }
}

?>