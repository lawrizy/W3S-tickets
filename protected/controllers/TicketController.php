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

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Ticket'])) {
            $var = $_POST['Ticket'];
            $var['fk_canal'] = 1;
            if (Yii::app()->session['Utilisateur'] == 'Locataire')
                $var['fk_user'] = 1;
            else {
                $var1 = Yii::app()->session['Logged'];
                $var['fk_user'] = $var1['id_user'];
            }
            $model->attributes = $var;
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id_ticket));
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
        // Stocke les anciennes valeurs du modèle, pour comparaison ultérieure.
        $oldModel = $model;
        
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Ticket'])) {
            // Le changement du modèle s'opère ici.
            $model->attributes = $_POST['Ticket'];
            
            // Vérifier si le statut du ticket a changé.
            if($oldModel->fk_statut != $model->fk_statut)
            {
                /* 
                 * Si le statut du ticket a changé, récupérer l'email du locataire
                 * et lui envoyer le mail de confirmation.
                 */
                $lieu = Lieu::model()->findByPk($model->fk_lieu);
                $locataire = Locataire::model()->findByPk($lieu->fk_locataire);
                $email = $locataire->email;
                $this->actionSendNotificationMail($email);
            }
            
            // Ensuite on sauvegarde les changements normalement.
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id_ticket));
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
     * Cette méthode change le statut courant du ticket vers le statut indiqué en paramètre.
     * Lorsque le changement de statut se fait, un mail est envoyé au LOCATAIRE
     * pour lui indiquer le changement de statut de son ticket.
     * @param integer $newStatusID L'ID du nouveau statut à attribuer au ticket.
     */
    public function actionChangeStatutTicket($newStatusID)
    {
        
    }
    
    /**
     * Cette méthode est utilisée pour envoyer le mail de notification, lors
     * du changement de statut d'un ticket, au LOCATAIRE qui l'a créé.
     */
    private function actionSendNotificationMail($userEmail)
    {
        echo "
            <script>
            alert('Envoi Email to client');
            </script>
            ";
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

}
