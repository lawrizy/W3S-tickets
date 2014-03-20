<?php

class LieuController extends Controller
{

    Const ID_CONTROLLER = 6;
    Const ACTION_VIEW = 1;
    Const ACTION_CREATE = 2;
    COnst ACTION_DELETE = 4;
    const ACTION_UPDATE = 8;
    const ACTION_ADMIN = 16;

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
     * La méthode permettant d'accorder des droits aux différents utilisateurs.
     * Cette méthode est appelée à chaque fois que l'on veut accéder à une action
     * de ce controleur. La méthode vérifie les droits que cet utilisateur a sur
     * ce controleur et génère les arrays 'allow' (permis) et 'deny' (refusé)
     * selon ces droits-là.
     */
    public function accessRules() { // droit des utilisateur sur les actions
        if (Yii::app()->session['Utilisateur'] == 'Locataire') { // Locataire a des droits fixes
            return array(
                array('deny', // refuse autre users
                    'users' => array('@'), //tous utilisateur
                    'message' => 'Vous n\'avez pas accès à cette page.'
                ),
            );
        } elseif (Yii::app()->session['Utilisateur'] == 'User') { // Génération des droits selon le user
            
            // On récupère d'abord le user et ses droits de la session
            $logged = Yii::app()->session['Logged'];
            $rights = Yii::app()->session['Rights']->getLieu();
            // On initialise ensuite les array qui stockeront les droits
            $allow = array();
            
            // Et enfin on teste chaque droit un à un, et si le droit est bien accordé,
            // on le rajoute à l'array qui sera envoyé dans le return
            if ($rights & self::ACTION_VIEW) array_push($allow, 'view');
            if ($rights & self::ACTION_CREATE) array_push($allow, 'create');
            if ($rights & self::ACTION_DELETE) array_push($allow, 'delete');
            if ($rights & self::ACTION_UPDATE) array_push($allow, 'update');
            if ($rights & self::ACTION_ADMIN) array_push($allow, 'admin');
            
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
        } else { // Si autre utilisateur (visiteur)
            return array( // Ici on a plus qu'à envoyer la liste des droits
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
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        /* @var CDbConnection $db */
        /* @var CDbTransaction $tsql */
        $db = Yii::app()->db;
        $model = new Lieu;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Lieu']))
        {
            $tsql = $db->beginTransaction();
            $model->attributes = $_POST['Lieu'];
            try
            {
                if($model->validate() && $model->save())
                {
                    $tsql->commit();
                    $this->redirect(array('view', 'id' => $model->id_lieu));
                }
                else // Non validé
                {
                    $err = "Une erreur est survenue : <br/>";
                    foreach($model->getErrors() as $key=>$value)
                        $err .= $value[0] . "<br/>";
                    throw new Exception($err);
                }
            } catch (Exception $erreur)
            {
                $tsql->rollback();
                Yii::app()->user->setFlash('error', $erreur->getMessage());
                $this->redirect(array('admin'));
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
    public function actionUpdate($id)
    {
        /* @var CDbConnection $db */
        /* @var CDbTransaction $tsql */
        $db = Yii::app()->db;
        $tsql = $db->beginTransaction();
        
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Lieu']))
        {
            try
            {
                $model->attributes = $_POST['Lieu'];
                if ($model->validate() && $model->save())
                {
                    $tsql->commit();
                    $this->redirect(array('view', 'id' => $model->id_lieu));
                }
                else // Non validé
                {
                    $err = "Une erreur est survenue : <br/>";
                    foreach($model->getErrors() as $key=>$value)
                        $err .= $value[0] . "<br/>";
                    throw new Exception($err);
                }
            } catch(Exception $e)
            {
                $tsql->rollback();
                Yii::app()->user->setFlash('error', $e->getMessage());
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
    public function actionDelete($id)
    {
        /*
         * Les 2 directives suivantes ne font rien dans le code, c'est juste une 
         * spécificité de PHP qui permet de dire à l'IDE de quel type est une variable donnée, pour l'autocomplétion.
         * Ceci ne fait EN AUCUN CAS un cast de la variable vers la classe concernée.
         */
        /* @var CDbConnection $db */
        /* @var CDbTransaction $tsql */

        // On charge l'objet sur lequel travailler, comme d'habitude.
        $model = $this->loadModel($id);
        // On effectue les changements désirés
        $model->setAttribute("visible", 0);
        // Ici je ne fais que de me faciliter l'accès à la variable db de YII en la placant dans $db
        $db = Yii::app()->db;
        // Création d'une instance de transaction qui se terminera soit par un commit(), soit par un rollback().
        $tsql = $db->beginTransaction();
        // L'ajout d'un try-catch est nécéssaire pour l'utilisation des transactions, car celui-ci agira en tant que
        // barrière de sécurité pour les opérations à effectuer.
        try
        {
            // On fait le save() comme d'habitude, mais celui-ci n'est PAS ENCORE EFFECTIF sur la DB, il faut
            // faire un commit()
            if($model->validate() && $model->save(true))
            {
                // On commit si tout s'est bien passé, sinon le catch va s'exécuter.
                $tsql->commit();
                $this->redirect(array('view', $model->id_lieu));
            }
            else // Non validé
            {
                $err = "Une erreur est survenue : <br/>";
                foreach($model->getErrors() as $k=>$v)
                    $err .= $v[0] . "<br/>";
                throw new Exception($err);
            }
        } catch (Exception $erreur)
        {
            // Rollback() des changements effectués en cas de problème!
            $tsql->rollback();
            // Apparition d'une banière signifiant la nature de l'erreur.
            Yii::app()->user->setFlash('error', $erreur->getMessage());
            $this->redirect(array('view', 'id' => $model->id_lieu));
        }

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Lieu');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Lieu('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Lieu']))
            $model->attributes = $_GET['Lieu'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Lieu the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Lieu::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Lieu $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'lieu-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
