<?php

class BatimentController extends Controller
{

    Const ID_CONTROLLER = 2;
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
        if (!Yii::app()->user->isGuest) { // Génération des droits selon le user
            
            // On récupère d'abord le user et ses droits de la session
            $logged = Yii::app()->session['Logged'];
            $rights = Yii::app()->session['Rights']->getBatiment();
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
        /*
         * CDbCommand failed to execute the SQL statement: SQLSTATE[23000]: Integrity constraint violation: 1062 
         * Duplic6ate entry 'test' for key 'code_UNIQUE'. The SQL statement executed was: 
         * INSERT INTO `w3sys_batiment` (`cpt`, `visible`, `nom`, `code`, `adresse`, `commune`, `cp`) VALUES (:yp0, :yp1, :yp2, :yp3, :yp4, :yp5, :yp6)
         */
        /* @var CDbConnection $db */
        /* @var CDbTransaction $tsql */
        $db = Yii::app()->db;
        $tsql = $db->beginTransaction();
        
        $model = new Batiment;
        
// Uncomment the following line if AJAX validation is needed
//$this->performAjaxValidation($model);

        if (isset($_POST['Batiment']))
        {
            try
            {
                $model->attributes = $_POST['Batiment'];
                if ($model->validate() && $model->save())
                {
                    $tsql->commit();
                    $this->redirect(array('view', 'id' => $model->id_batiment));
                }
                else
                {
                    $errMessage = "Une erreur est survenue : <br/>";
                    foreach ($model->getErrors() as $key => $value)
                    {
                        $errMessage .= "<br/>" . $value[0];
                    }
                    throw new Exception($errMessage);
                }
            } catch (Exception $erreur)
            {
                $tsql->rollback();
                Yii::app()->user->setFlash('error', $erreur->getMessage());
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
    public function actionUpdate($id)
    {
        /* @var CDbConnection $db */
        /* @var CDbTransaction $tsql */
        $db = Yii::app()->db;
        $tsql = $db->beginTransaction();

        $model = $this->loadModel($id);

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

        if (isset($_POST['Batiment']))
        {
            try
            {
                $model->attributes = $_POST['Batiment'];
                if ($model->save(true))
                {
                    $tsql->commit();
                    $this->redirect(array('view', 'id' => $model->id_batiment));
                }
                else
                {
                    $errMessage = "Une erreur est survenue : <br/>";
                    foreach ($model->getErrors() as $key => $value)
                        $errMessage .= "<br/>" . $value[0];
                    throw new Exception($errMessage);
                }
            } catch (Exception $erreur)
            {
                $tsql->rollback();
                Yii::app()->user->setFlash('error', $erreur->getMessage());
                $this->redirect(array('update', 'id' => $model->id_batiment));
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
    { // Soft-delete, on passe un champ visible à 0 plutôt que de supprimer l'enregistrement
        /* @var CDbConnection $db */
        /* @var CDbTransaction $tsql */
        $db = Yii::app()->db;
        $tsql = $db->beginTransaction();

        $model = $this->loadModel($id); // On récupère l'enregistrement de ce bâtiment
        $model['visible'] = Constantes::INVISIBLE; // et on met l'enregistrement à l'état invisible
        try
        {
            if ($model->save(true)) // et enfin on enregistre cet état invisible dans la DB
            {
                $tsql->commit();
                Yii::app()->user->setFlash('success', 'La suppression du bâtiment s\'est bien passée.');
                $this->redirect(array('admin'));
            }
            else
            {
                throw new Exception("Une erreur est survenue à la suppression du bâtiment.");
            }
        } catch (Exception $erreur)
        {
            $tsql->rollback();
            Yii::app()->user->setFlash('success', $erreur->getMessage());
        }

        $tickets = Ticket::model()->findAllByAttributes(array('fk_batiment' => $id)); // On recherche tous les tickets qui sont liés à ce bâtiment
        foreach ($tickets as $ticket)
        { // et on les passe tous à l'état invisible
            $ticket['visible'] = Constantes::INVISIBLE;
            try
            {
                $ticket->save(true);
                $tsql->commit();
            } catch(Exception $erreur)
            {
                $tsql->rollback();
                Yii::app()->user->setFlash('error', $erreur->getMessage());
            }
        }

        $lieux = Lieu::model()->findAllByAttributes(array('fk_batiment' => $id)); // On recherche tous les lieux qui sont liés à ce bâtiment
        foreach ($lieux as $lieu)
        { // et on les passe tous à l'état invisible
            $lieu['visible'] = Constantes::INVISIBLE;
            try
            {
                $lieu->save(true);
                $tsql->commit();
            } catch(Exception $erreur)
            {
                Yii::app()->user->setFlash('error', $erreur->getMessage());
                $tsql->rollback();
            }

            // Par contre, si le lieu d'un locataire est supprimé, et que ce locataire n'a plus d'autres lieux, on 'delete' aussi ce locataire
            $locataires = Lieu::model()->findAllByAttributes(array('fk_locataire' => $lieu['fk_locataire'], 'visible' => Constantes::VISIBLE));
            // On recherche donc les autres lieux pour ce locataires (lieux encore visible bien sûr)
            if ($locataires == NULL)
            { // S'il n'y a pas d'autres lieux pour ce locataire, on le 'delete'
                $locataire = Locataire::model()->findByPk($lieu['fk_locataire']);
                $locataire['visible'] = Constantes::INVISIBLE;
                try
                {
                    $locataire->save(true);
                } catch(Exception $erreur)
                {
                    Yii::app()->user->setFlash('error', $erreur->getMessage());
                    $tsql->rollback();
                }
            }
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
        $dataProvider = new CActiveDataProvider('Batiment');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Batiment('search');
        $model->unsetAttributes(); // clear any default values
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
    public function loadModel($id)
    {
        $model = Batiment::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Batiment $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'batiment-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
