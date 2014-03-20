<?php

class LocataireController extends Controller
{

    Const ID_CONTROLLER = 7;
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
            $rights = Yii::app()->session['Rights']->getLocataire();
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
        $model = new Locataire;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Locataire']))
        {
            $tsql = $db->beginTransaction();

            $model->attributes = $_POST['Locataire'];
            $model->setAttribute("password", md5($model->password));

            try
            {
                if (!$model->validate())
                {
                    $errMessage = "Une erreur s'est produite : <br/>";
                    foreach ($model->getErrors() as $key => $value)
                    {
                        $errMessage .= "<br/>" . $value[0];
                    }
                    throw new Exception($errMessage);
                }
                $model->save();
                $tsql->commit();
                Yii::app()->user->setFlash('success', 'Le locataire a bien été créé.');
                $this->redirect(array('admin', 'id' => $model->id_locataire));
            } catch (Exception $erreur)
            {
                $tsql->rollback();
                Yii::app()->user->setFlash('error', $erreur->getMessage());
                $this->redirect(array('create', 'id' => $model->id_locataire));
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
        $model = $this->loadModel($id);
        $db = Yii::app()->db;

        if (isset($_POST['Locataire']))
        {
            $locataire = $_POST['Locataire'];
            $locataire['password'] = $model->password; // On ne change pas le MDP par cette interface -> voir changer mot de passe
            $model->attributes = $locataire;
            $tsql = $db->beginTransaction();
            try
            {
                if (!$model->validate())
                {
                    $errMessage = "Une erreur s'est produite : <br/>";
                    foreach ($model->getErrors() as $key => $value)
                    {
                        $errMessage .= "<br/>" . $value[0];
                    }
                    throw new Exception($errMessage);
                }
                $model->save();
                $tsql->commit();
                Yii::app()->user->setFlash('success', 'Le locataire a bien été mis à jour.');
                $this->redirect(array('view', 'id' => $model->id_locataire));
            } catch (Exception $erreur)
            {
                $tsql->rollback();
                Yii::app()->user->setFlash('error', $erreur->getMessage());
                $this->redirect(array('update', 'id' => $model->id_locataire));
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
        /* @var CDbConnection $db */
        /* @var CDbTransaction $tsql */
        $model = $this->loadModel($id);
        // Au lieu de hard delete le locataire, on passe son champs "visible" à 0 (invisible)
        $model->setAttribute("visible", Constantes::INVISIBLE);
        // On sauvegarde ensuite les changements faits
        $db = Yii::app()->db;
        $tsql = $db->beginTransaction();

        try
        {
            if ($model->validate() && $model->save(true))
            {
                Yii::app()->user->setFlash('success', 'Le delete du locataire s\'est bien passé.');
            }
            else
            {
                throw new Exception("Un problème est survenu lors de la suppression du locataire.");
            }

            // Trouver la liste des tickets liés au locataire. On récupère une liste de CActiveRecords
            $idDuLocataireSoftDelete = $model['id_locataire'];
            $listeTicketsLocataire = Ticket::model()->findAllByAttributes(array('fk_locataire' => $idDuLocataireSoftDelete));
            // Boucle foreach sur chaque enregistrement ($key => $value)
            foreach ($listeTicketsLocataire as $key => $activeRecordTicket)
            {
                // Passer le champs visible de chaque enregistrement trouvé à invisible
                $activeRecordTicket->setAttribute('visible', Constantes::INVISIBLE);
                // Faire un save() du changement effectué
                if ($activeRecordTicket->validate() && $activeRecordTicket->save())
                {
                    // Ne rien faire (silencieux)
                }
                else
                {
                    throw new Exception("Un problème est survenu lors de la suppression du locataire.");
                }
            }
            $tsql->commit();
        } catch (Exception $erreur)
        {
            $tsql->rollback();
            Yii::app()->user->setFlash('error', $erreur->getMessage());
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
        $dataProvider = new CActiveDataProvider('Locataire');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Locataire('search');
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
    public function loadModel($id)
    {
        $model = Locataire::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Locataire $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'locataire-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionDeleteLieu()
    {
        /* @var CDbConnection $db */
        /* @var CDbTransaction $tsql */
        $db = Yii::app()->db;
        $tsql = $db->beginTransaction();
        $model = Locataire::model()->findByPk($_GET['id']);

        if (isset($_POST['Batiment']))
        {
            try
            {
                $modelLieu = Lieu::model()->findByAttributes(array('fk_locataire' => $_GET['id'], 'fk_batiment' => $_POST['Batiment'], 'visible' => Constantes::VISIBLE));
                $modelLieu['visible'] = Constantes::INVISIBLE;
                if ($modelLieu->validate() && $modelLieu->save())
                {
                    $tsql->commit();
                    Yii::app()->user->setFlash('success', '<strong> Le propriétaire ' . $model->nom . ' n\'habite plus dans le bâtiment: ' . Batiment::model()->findByPk($_POST['Batiment'])->nom . '</strong>');
                }
                else
                {
                    throw new Exception('<strong>Erreur lors de la suppresion</strong>');
                }
            } catch (Exception $erreur)
            {
                $tsql->rollback();
                Yii::app()->user->setFlash('error', $erreur->getMessage());
            }
        }


        $this->render('deleteLieu', array('model' => $model));
    }

    public function actionaddLieu()
    {
        /* @var CDbConnection $db */
        /* @var CDbTransaction $tsql */
        $db = Yii::app()->db;
        $tsql = $db->beginTransaction();
        
        $model = Locataire::model()->findByPk($_GET['id']);
        if (isset($_POST['Batiment']))
        {
            try
            {
                $modelLieu = new Lieu();
                $modelLieu['fk_locataire'] = $model->id_locataire;
                $modelLieu['fk_batiment'] = $_POST['Batiment'];
                if ($modelLieu->validate() && $modelLieu->save())
                {
                    $tsql->commit();
                    Yii::app()->user->setFlash('success', '<strong>Cette adresse a bien été ajoutée pour: ' . $model->nom . '</strong>');
                }
                else
                {
                    throw new Exception('<strong>Cette adresse a bien été ajoutée pour: ' . $model->nom . '</strong>');
                }
            } catch(Exception $erreur)
            {
                Yii::app()->user->setFlash('error', $erreur->getMessage());
                $tsql->rollback();
            }
        }

        $this->render('addLieu', array('model' => $model));
    }

    public function actionChangePassword()
    {
        /* @var CDbConnection $db */
        /* @var CDbTransaction $tsql */
        $db = Yii::app()->db;
        $tsql = $db->beginTransaction(); //TODO transaction
        
        $model = Locataire::model()->findByPk($_GET['id']);
        if (isset($_POST['AncienMdp']))
        {
            if (md5($_POST['AncienMdp']) === $model->password)
            {
                if ($_POST['NouveauMdp'] != NULL && $_POST['NouveauMdp'] === $_POST['NouveauMdp1'])
                {
                    $model->password = md5($_POST['NouveauMdp1']);
                    if ($model->save())
                        Yii::app()->user->setFlash('success', '<strong>Votre nouveau mot de passe a bien été enregistré!' . '</strong>');
                }
                else
                {
                    Yii::app()->user->setFlash('error', '<strong>Erreur les nouveaux mots de passe sont différents !' . '</strong>');
                }
            }
            else
            {
                Yii::app()->user->setFlash('error', '<strong>Erreur votre ancien mot de passe est erroné !' . '</strong>');
            }
        }
        $this->render('changePassword');
    }

}

?>
