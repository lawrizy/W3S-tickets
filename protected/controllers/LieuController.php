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
     * La fonction permettant d'accorder des droits aux différents utilisateurs.
     * Quand la méthode est appellée, on vérifie le type de l'utilisateur,
     * et en fonction de cela, les droits accordés peuvent varient.
     */
    public function accessRules()
    {
        if ((Yii::app()->session['Utilisateur'] == 'User') && (Yii::app()->session['Logged']->fk_fonction == Constantes::FONCTION_ROOT))
        {
            // Si ['User'] et [fonction = id_admin], alors c'est un admin
            return array(
                array('allow', // 'allow' veut dire que l'utilisateur a droit à ce qui suit.
                    'actions' => array('view', 'create', 'update', 'delete', 'admin'), // L'admin à tous les droits
                    'users' => array('@'),
                    // Tous les droits accordés à tout le monde, mais comme il faut être admin 
                    // pour arriver là alors il n'y a que les admins qui ont ces droits-là
                ),
            );
        }
        else
        {
            // Si ['Locataire'] ou [['User'] et [fonction = id_user]], alors l'utilisateur n'a aucun droit
            return array(
                array('deny', // 'deny' veut dire que l'on renie les droits à l'utilisateur
                    'users' => array('?'),
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
                $model->save();
                $tsql->commit();
                $this->redirect(array('view', 'id' => $model->id_lieu));
            } catch (Exception $erreur)
            {
                $tsql->rollback();
                Yii::app()->user->setFlash('error', 'Erreur à la création d\'un lieu : ' . $erreur->getMessage());
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
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Lieu']))
        {
            $model->attributes = $_POST['Lieu'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id_lieu));
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
            $model->save(true);
            // On commit si tout s'est bien passé, sinon le catch va s'exécuter.
            $tsql->commit();
        } catch (Exception $erreur)
        {
            // Rollback() des changements effectués en cas de problème!
            $tsql->rollback();
            // Apparition d'une banière signifiant la nature de l'erreur.
            Yii::app()->user->setFlash('error', 'Une erreur s\'est produite : <br/>' . $erreur->getMessage());
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
