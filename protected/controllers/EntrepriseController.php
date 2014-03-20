<?php

class EntrepriseController extends Controller {

    Const ID_CONTROLLER = 5;
    Const ACTION_VIEW = 1;
    Const ACTION_CREATE = 2;
    COnst ACTION_DELETE = 4;
    const ACTION_UPDATE = 8;
    const ACTION_ADMIN = 16;
    Const ACTION_SECTEUR = 32;

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
            $rights = Yii::app()->session['Rights']->getEntreprise();
            // On initialise ensuite les array qui stockeront les droits
            $allow = array();
            
            // Et enfin on teste chaque droit un à un, et si le droit est bien accordé,
            // on le rajoute à l'array qui sera envoyé dans le return
            if ($rights & self::ACTION_VIEW) array_push($allow, 'view');
            if ($rights & self::ACTION_CREATE) array_push($allow, 'create');
            if ($rights & self::ACTION_DELETE) array_push($allow, 'delete');
            if ($rights & self::ACTION_UPDATE) array_push($allow, 'update');
            if ($rights & self::ACTION_ADMIN) array_push($allow, 'admin');
            if ($rights & self::ACTION_SECTEUR) array_push($allow, 'secteur');
            
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
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionSecteur($id) {

        if (isset($_POST['idCat'])) {
            $secteur = new Secteur();
            $secteur['fk_categorie'] = $_POST['idCat'];
            $secteur['fk_entreprise'] = $_POST['id_entreprise'];
            $secteur->save();
            $this->render('view', array(
                'model' => $this->loadModel($id),
            ));
        } else {
            $this->render('secteur', array(
                'model' => $this->loadModel($id),
            ));
        }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Entreprise;

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

        if (isset($_POST['Entreprise'])) {
            $model->attributes = $_POST['Entreprise'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id_entreprise));
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
        $model = $this->loadModel($id);

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

        if (isset($_POST['Entreprise'])) {
            $model->attributes = $_POST['Entreprise'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id_entreprise));
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
    public function actionDelete($id) { // Soft-delete, on passe un champ visible à 0 plutôt que de supprimer l'enregistrement
        $model = $this->loadModel($id); // On récupère l'enregistrement de cet entreprise
        $model['visible'] = Constantes::INVISIBLE; // et on met l'enregistrement à l'état invisible
        $model->save(FALSE); // et enfin on enregistre cet état invisible dans la DB

        $tickets = Ticket::model()->findAllByAttributes(array('fk_entreprise' => $id, 'visible' => Constantes::VISIBLE));
        // On recherche tous les tickets qui sont liés à cet entreprise
        foreach ($tickets as $ticket) { // et on les passe tous à l'état invisible
            $ticket['visible'] = Constantes::INVISIBLE;
            $ticket->save(FALSE);
        }

        $secteurs = Secteur::model()->findByAttributes(array('fk_entreprise' => $id, 'visible' => Constantes::VISIBLE));
        // On recherche aussi tous les secteurs liés à cet entreprise
        foreach ($secteurs as $secteur) { // et on les passe tous à l'état invisible
            $secteur['visible'] = Constantes::INVISIBLE;
            $secteur->save(FALSE);
            $newSecteur = new Secteur();
            // Il faut aussi que la catégorie ne reste pas vide, pour cela on crée un nouveau secteur avec une entreprise par défaut
            $newSecteur->fk_categorie = $secteur['fk_categorie']; // on garde 
            $newSecteur->fk_entreprise = Constantes::ENTREPRISE_DEFAUT;
            $newSecteur->save(FALSE);
        }

//        $categories = CategorieIncident::model()->findByPk($id);
// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Entreprise');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Entreprise('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Entreprise']))
            $model->attributes = $_GET['Entreprise'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Entreprise the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Entreprise::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Entreprise $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'entreprise-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
