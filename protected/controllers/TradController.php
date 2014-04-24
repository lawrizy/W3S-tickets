<?php

class TradController extends Controller {
    
    public $layout = '//layouts/column2';

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
            $allow = array('noright');
            
            // Seul les root ont des droits sur ce contrôleur
            if (Yii::app()->session['Logged']->fk_fonction == Constantes::FONCTION_ROOT) {
                array_push($allow, 'update');
                array_push($allow, 'index');
                array_push($allow, 'addtraduction');
                array_push($allow, 'modifytraduction');
            }

            return array(// Ici on a plus qu'à envoyer la liste des droits
                array('allow', // Ici l'array des droits 'permis'
                    'actions' => $allow, // Et on lui communique l'array que l'on a généré plus tôt
                    'users' => array('@'), // Autorisé pour les user loggés
                ),
                array('deny', // Refuse autre users
                    'users' => array('@'), // Refus aux visiteurs loggés
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
        /* @var CDbConnection $db */
        /* @var CDbTransaction $tsql */
        $db = Yii::app()->db;
        $tsql = $db->beginTransaction();

        $model = $this->loadModel($id);

        $this->performAjaxValidation($model);

        if (isset($_POST['Trad'])) {
            try {
                $model->attributes = $_POST['Trad'];
                if ($model->validate() && $model->save(FALSE)) {
                    $tsql->commit();
                    $this->redirect(array('modifyTraduction'));
                } else {
                    $err = Translate::trad('erreurProduite');
                    foreach ($model->getErrors() as $k => $v)
                        $err .= $v[0] . "<br/>";
                    throw new Exception($err);
                }
            } catch (Exception $e) {
                $tsql->rollback();
                Yii::app()->user->setFlash('error', $e->getMessage());
                $this->redirect(array('modifyTraduction'));
            }
        } else {
            $this->render('update', array('model' => $model));
        }
    }

    /**
     * Cette action est appelée lors de la création d'une traduction via l'interface admin.
     */
    public function actionAddTraduction() {
        /* @var CDbConnection $db */
        /* @var CDbTransaction $tsql */
        $db = Yii::app()->db;
        $tsql = $db->beginTransaction();

        $model = new Trad;

        if (isset($_POST['Trad'])) {
            try {
                $model->attributes = $_POST['Trad'];
                // Exécution de la validation suivant les règles du modèle (code, fr, en, nl non null, etc...)
                // Sauvegarde de la nouvelle traduction
                if ($model->validate() && $model->save(FALSE)) {
                    $tsql->commit();
                    Yii::app()->user->setFlash("success", "L'insertion de la nouvelle traduction s'est bien passée.<br/>
                                Vous pouvez désormais l'utiliser en écrivant Translate::trad(\"" . $model->code . "\")");
                } else {
                    $err = Translate::trad('erreurProduite');
                    foreach ($model->getErrors() as $k => $v)
                        $err .= $v[0] . "<br/>";
                    throw new Exception($err);
                }
            } catch (Exception $e) {
                $tsql->rollback();
                Yii::app()->user->setFlash('error', $e->getMessage());
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
