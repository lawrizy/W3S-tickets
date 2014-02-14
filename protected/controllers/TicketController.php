<?php

class TicketController extends Controller {

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
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'admin', 'delete'),
                'users' => array('@'),
            ),
//			array('allow', // allow admin user to perform 'admin' and 'delete' actions
//				'actions'=>array('admin','delete'),
//				'users'=>array('admin'),
//			),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
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
        $model = new Ticket;

        // Vérifie si a bien reçu un objet 'Ticket'
        // ==> si non, c'est que c'est la première arrivée sur la page create,
        // ==> si oui, c'est que c'est la page create elle-même qui renvoie ici pour la création d'un ticket
        if (isset($_POST['Ticket'])) {
            $ticket = $_POST['Ticket'];

            // Canal par défaut le temps du développement
            $ticket['fk_canal'] = 1;
            $user = 0;
            // Vérifie quel utilisateur est enregistré (si User ou Locataire)
            if (Yii::app()->session['Utilisateur'] == 'Locataire') {
                // Si locataire, on attribue le ticket a un user par défaut (le 1 dans ce cas-ci)
                $ticket['fk_user'] = 1;
                $user = 0;
            } else {
                // Si user, c'est lui-même qui s'occupera de ce ticket-ci
                $logged = Yii::app()->session['Logged'];
                $ticket['fk_user'] = $logged['id_user'];
                $user = $logged['id_user'];
            }

            // Notre modèle prend la valeur reçue de la page et on test un save
            // (dans la méthode save, on fait d'abord une validation des attributs)
            $model->attributes = $ticket;

            try {
                $model->save();
                // Si la sauvegarde du ticket s'est bien passé,
                // on enregistre un évènement opened pour la création du ticket
                $histo = new HistoriqueTicket();
                $histo->date_update = date("Y-m-d H:i:s", time());
                $histo->fk_ticket = $model->id_ticket;
                // Lors de la création, statut forcément à opened
                $histo->fk_statut_ticket = 1;
                $histo->fk_user = $user;
                $histo->save(FALSE);
                $this->redirect(array('view', 'id' => $model->id_ticket));
            } catch (CDbException $e) {
                Yii::app()->session['erreurDB'] = 'La base de donnnée est indisponible pour le moment';
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
    public function actionUpdate($id) {
        // Stocke les anciennes valeurs du modèle, pour comparaison ultérieure.
        $model = $this->loadModel($id);

        // Vérifie si a bien reçu un objet 'Ticket'
        // ==> si non, c'est que c'est la première arrivée sur la page update,
        // ==> si oui, c'est que c'est la page update elle-même qui renvoie ici pour la mise à jour d'un ticket
        if (isset($_POST['Ticket'])) {
            // Le changement du modèle s'opère ici.
            $model->attributes = $_POST['Ticket'];
            if ($model->fk_secteur != NULL) {
                Yii::trace($model->fk_secteur, 'cron');
                $lieu = Lieu::model()->findByPk($model->fk_lieu);
                $model->fk_secteur = $this->getSecteurByFk($model->fk_secteur, $model->fk_categorie, $lieu->fk_batiment);
                $model->fk_statut = 2;
            }
            // Ensuite on sauvegarde les changements normalement.
            if ($model->save()) {
                // Si la sauvegarde du ticket s'est bien passé,
                // on enregistre un évènement pour le ticket
                $histo = new HistoriqueTicket();
                $histo->date_update = date("Y-m-d H:i:s", time());
                $histo->fk_ticket = $model->id_ticket;
                $logged = Yii::app()->session['Logged'];
                $histo->fk_user = $logged['id_user'];
                // TODO TODO
                $histo->fk_statut_ticket = 2;
                $histo->save();
                $this->redirect(array('view', 'id' => $model->id_ticket));
            }

            /*
              // TODO
              // Vérifier si le statut du ticket a changé.
              if ($oldModel->fk_statut != $model->fk_statut) {
              //
              // Si le statut du ticket a changé, récupérer l'email du locataire
              // et lui envoyer le mail de confirmation.
              //
              // L'email du locataire doit être retrouvée via le lieu associé à ce ticket.
              // -> Ticket -> Lieu -> Locataire -> Locataire.email
              //

              $lieu = Lieu::model()->findByPk($model->fk_lieu);                   // Ticket -> Lieu
              $locataire = Locataire::model()->findByPk($lieu->fk_locataire);     // Lieu -> Locataire
              $email = $locataire->email;                                         // Locataire.email
              $this->actionSendNotificationMail($email);                       // appel méthode d'envoi email
              }
              // */
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
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Ticket');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Ticket('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Ticket']))
            $model->attributes = $_GET['Ticket'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Cette méthode est utilisée pour envoyer le mail de notification, lors
     * du changement de statut d'un ticket, au LOCATAIRE qui l'a créé.
     */
    private function actionSendNotificationMail($userEmail) {
        // TODO : Envoi d'un mail au locataire en cas de changement de statut ticket
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Ticket the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Ticket::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Ticket $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'ticket-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function getEntreprise($idTicket) {
        $model = $this->loadModel($idTicket);
        $lieu = Lieu::model()->findByPk($model->fk_lieu);
        $secteurs = Secteur::model()->findAllByAttributes(array('fk_batiment' => $lieu->fk_batiment, 'fk_categorie' => $model->fk_categorie));
        //$secteurs = Secteur::model()->findAllByAttributes(array('fk_batiment' => $lieu->fk_batiment, 'fk_categorie' => $model->fk_categorie));
        $entreprises = array();
        foreach ($secteurs as $secteur) {
            $entreprise = Entreprise::model()->findByPk($secteur->fk_entreprise);
            array_push($entreprises, $entreprise);
        }

        return $entreprises;
    }

    public function getSecteurByFk($entreprise, $categorie, $batiment) {
        $var = Secteur::model()->findByAttributes(array('fk_batiment' => $batiment, 'fk_categorie' => $categorie, 'fk_entreprise' => $entreprise));
        return $var->id_secteur;
    }

}
