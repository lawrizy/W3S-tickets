<?php

class LocataireController extends Controller
{

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

        if ((Yii::app()->session['Utilisateur'] == 'User') && ((Yii::app()->session['Logged']->fk_fonction == Constantes::FONCTION_ROOT) || (Yii::app()->session['Logged']->fk_fonction == Constantes::FONCTION_ADMIN)))
        {
            // Si ['User'] et [fonction = id_admin], alors c'est un admin

            return array(
                array('allow', // 'allow' veut dire que l'utilisateur a droit à ce qui suit.
                    'actions' => array('admin', 'view', 'create', 'update', 'delete', 'deletelieu', 'addlieu', 'changepassword'), // L'admin à tous les droits
                    'users' => array('@'),
                    // Tous les droits accordés à tout le monde, mais comme il faut être admin 
                    // pour arriver là alors il n'y a que les admins qui ont ces droits-là
                ),
                array('deny', // 'deny' veut dire que l'on renie les droits à l'utilisateur
                    'users' => array('@'),
                    // Aucun droit à tous ceux qui arrivent ici
                    'message' => 'Vous n\'avez pas accès à cette page.'
                    // Message qu'affichera la page d'erreur
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
