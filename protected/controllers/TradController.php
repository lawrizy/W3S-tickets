<?php

class TradController extends Controller
{

    Const ID_CONTROLLER = 9;
    Const ACTION_UPDATE = 1;
    Const ACTION_INDEX = 2;
    COnst ACTION_ADDTRADUCTION = 4;
    const ACTION_MODIFYTRADUCTION = 8;

    public $layout = '//layouts/column2';

    public function filters()
    {
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
    public function accessRules()
    { // droit des utilisateur sur les actions
        if (!Yii::app()->user->isGuest)
        { // Génération des droits selon le user

            // On récupère d'abord le user et ses droits de la session
            $logged = Yii::app()->session['Logged'];
            $rights = Yii::app()->session['Rights']->getTrad();
            // On initialise ensuite les array qui stockeront les droits
            $allow = array();

            // Et enfin on teste chaque droit un à un, et si le droit est bien accordé,
            // on le rajoute à l'array qui sera envoyé dans le return
            if ($rights & self::ACTION_UPDATE) array_push($allow, 'update');
            if ($rights & self::ACTION_INDEX) array_push($allow, 'index');
            if ($rights & self::ACTION_ADDTRADUCTION) array_push($allow, 'addtraduction');
            if ($rights & self::ACTION_MODIFYTRADUCTION) array_push($allow, 'modifytraduction');
            
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
        }
        else
        { // Si autre utilisateur (visiteur)
            return array( // Ici on a plus qu'à envoyer la liste des droits
                array('deny', // Refuse autre users
                    'users' => array('?'), // Refus aux visiteurs non loggés
                    'message' => 'Vous n\'avez pas accès à cette page.'
                    // Le message qui sera affiché
                ),
            );
        }
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'trad-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function loadModel($id)
    {
        $model = Trad::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function actionIndex()
    {
        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('modifyTraduction'));
    }

    public function actionUpdate($id)
    {
        /* @var CDbConnection $db */
        /* @var CDbTransaction $tsql */
        $db = Yii::app()->db;
        $tsql = $db->beginTransaction();

        $model = $this->loadModel($id);

        $this->performAjaxValidation($model);

        if (isset($_POST['Trad']))
        {
            try
            {
                $model->attributes = $_POST['Trad'];
                if ($model->validate() && $model->save())
                {
                    $tsql->commit();
                    $this->redirect(array('modifyTraduction'));
                }
                else
                {
                    $err = "Une erreur est survenue : <br/>";
                    foreach ($model->getErrors() as $k => $v)
                        $err .= $v[0] . "<br/>";
                    throw new Exception($err);
                }
            } catch (Exception $e)
            {
                $tsql->rollback();
                Yii::app()->user->setFlash('error', $e->getMessage());
                $this->redirect(array('modifyTraduction'));
            }
        }

        $this->render('update', array('model' => $model));
    }

    /**
     * Cette action est appelée lors de la création d'une traduction via l'interface admin.
     */
    public function actionAddTraduction()
    {
        /* @var CDbConnection $db */
        /* @var CDbTransaction $tsql */
        $db = Yii::app()->db;
        $tsql = $db->beginTransaction();

        $model = new Trad;

        if (isset($_POST['Trad']))
        {
            try
            {
                $model->attributes = $_POST['Trad'];
                // Exécution de la validation suivant les règles du modèle (code, fr, en, nl non null, etc...)
                // Sauvegarde de la nouvelle traduction
                if ($model->validate() && $model->save(true))
                {
                    Yii::app()->user->setFlash("success", "L'insertion de la nouvelle traduction s'est bien passée.<br/>
                                Vous pouvez désormais l'utiliser en écrivant Translate::trad(\"" . $model->code . "\")");
                }
                else
                {
                    $err = "Une erreur est survenue : <br/>";
                    foreach ($model->getErrors() as $k => $v)
                        $err .= $v[0] . "<br/>";
                    throw new Exception($err);
                }
            } catch (Exception $e)
            {
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

    public function actionModifyTraduction()
    {
        $model = new Trad('search');
        $model->unsetAttributes();
        if (isset($_GET['Trad']))
            $model->attributes = $_GET['Trad'];

        $this->render('modifyTraduction', array('model' => $model));
    }

}
