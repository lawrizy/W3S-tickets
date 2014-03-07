<?php

class CategorieIncidentController extends Controller {

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
     * La fonction permettant d'accorder des droits aux différents utilisateurs.
     * Quand la méthode est appellée, on vérifie le type de l'utilisateur,
     * et en fonction de cela, les droits accordés peuvent varient.
     */
    public function accessRules() {
        if ((Yii::app()->session['Utilisateur'] == 'User') && (Yii::app()->session['Logged']->fk_fonction == Constantes::FONCTION_ROOT)) {
            // Si ['User'] et [fonction = id_root]
            return array(
                array('allow', // 'allow' veut dire que l'utilisateur a droit à ce qui suit.
                    'actions' => array('*'), // Le root à tous les droits
                    'users' => array('*'),
                // Tous les droits accordés à tout le monde, mais comme il faut être root
                // pour arriver là alors il n'y a que ui qui a ces droits-là
                ),
            );
        } else {
            // Si ['Locataire'] ou [['User'] et [fonction = id_user]], alors l'utilisateur n'a aucun droit
            return array(
                array('deny', // 'deny' veut dire que l'on renie les droits à l'utilisateur
                    'users' => array('*'),
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
        Yii::trace('teststs','cron');
        $modelCategorie = new CategorieIncident;
        if (isset($_POST['categorieIncident'])) {
            $Categorie = $_POST['categorieIncident'];
            $varSecteur = new Secteur();
            $varSecteur->fk_entreprise = $_POST['Entreprise'];
            $modelCategorie->attributes = $Categorie;
            $modelCategorie->save(false);
            $this->render('view', array(
                'model' => $modelCategorie,
            ));
        }
// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);
//        if (isset($_POST['CategorieIncident'])) {
//            $model->attributes = $_POST['CategorieIncident'];
//            if ($model->save())
//                $this->redirect(array('view', 'id' => $model->id_categorie_incident));
//        }

        $this->render('create', array(
            'model' => $modelCategorie,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

        if (isset($_POST['CategorieIncident'])) {
            $model->attributes = $_POST['CategorieIncident'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id_categorie_incident));
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
        try {
            $model = $this->loadModel($id); // On récupère l'enregistrement de cette catégorie
            $model['visible'] = Constantes::INVISIBLE; // et on met l'enregistrement à l'état invisible
            $model->save(FALSE); // et enfin on enregistre cet état invisible dans la DB
            // ---------------------

            /*
             * Ensuite, si on supprime une catégorie, il faut aussi supprimer tous les tickets qui sont liées à cette catégorie.
             * Et si la catégorie en question est un parent, il faut faire pareil pour tous ses enfants
             * (c'est-à-dire, 'delete' tous ses enfants et les tickets qui sont liés à ces enfants)
             */
            if ($model['fk_parent'] == NULL) { // Si fk_parent est null, c'est une catégorie parent
                // Et donc si c'est un parent, on doit d'abord trouver toutes les sous-catégories qui sont ses enfants
                $sousCats = CategorieIncident::model()->findAllByAttributes(
                        array('fk_parent' => $id, 'visible' => Constantes::VISIBLE));
                foreach ($sousCats as $sousCat) { // parcourir toutes les sous-catégories et les passer à l'état invisible
                    $sousCat['visible'] = Constantes::INVISIBLE;
                    $sousCat->save(FALSE);

                    // Retrouver tous les tickets qui sont liés à cette sous-catégorie
                    $tickets = Ticket::model()->findAllByAttributes(
                            array('fk_categorie' => $sousCat['id_categorie_incident'], 'visible' => Constantes::VISIBLE));
                    foreach ($tickets as $ticket) { // Et aussi les passer à l'état invisible
                        $ticket['visible'] = Constantes::INVISIBLE;
                        $ticket->save(FALSE);
                    }

                    // Il faut aussi retrouver tous les secteurs liés à ces sous-catégories
                    $secteurs = Secteur::model()->findAllByAttributes(
                            array('fk_categorie' => $sousCat['id_categorie_incident'], 'visible' => Constantes::VISIBLE));
                    foreach ($secteurs as $secteur) { // Et aussi les passer à l'état invisible
                        $secteur['visible'] = Constantes::INVISIBLE;
                        $secteur->save(FALSE);
                    }
                }
            } else { // Si fk_parent n'est pas null, c'est donc un enfant
                // Et si c'est un enfant, il faut juste 'delete' tous les tickets qui sont liés à lui
                $tickets = Ticket::model()->findAllByAttributes(array('fk_categorie' => $id)); // On recherche tous les tickets qui sont liés à cette catégorie
                foreach ($tickets as $ticket) { // et on les passe tous à l'état invisible
                    $ticket['visible'] = Constantes::INVISIBLE;
                    $ticket->save(FALSE);
                }

                // Il faut aussi retrouver tous les secteurs liés à cette sous-catégorie
                $secteurs = Secteur::model()->findAllByAttributes(
                        array('fk_categorie' => $sousCat['id_categorie_incident'], 'visible' => Constantes::VISIBLE));
                foreach ($secteurs as $secteur) { // Et aussi les passer à l'état invisible
                    $secteur['visible'] = Constantes::INVISIBLE;
                    $secteur->save(FALSE);
                }
            }
            // ---------------------
            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } catch (CDbException $e) {

            $this->render('error', 'Erreur avec la base de données, veuillez contacter votre administrateur');
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('CategorieIncident');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new CategorieIncident('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['CategorieIncident']))
            $model->attributes = $_GET['CategorieIncident'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return CategorieIncident the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = CategorieIncident::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CategorieIncident $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'categorie-incident-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
