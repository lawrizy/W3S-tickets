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
                'actions' => array('create', 'update', 'admin', 'delete', 'admin_open', 'traitement', 'getsouscategoriesdynamiques', 'close'),
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

    public function actionClose($id) {
        if (isset($_POST['Ticket'])) {
            $var = $_POST['Ticket'];
            $model = $this->loadModel($id);
            $model->descriptif = $model->descriptif . '\n---------- Cloture ----------\n' . $var['descriptif'];
            $model->fk_statut = 3;
            try {
                $model->save(false);
                $histo = new HistoriqueTicket();
                $histo->date_update = date("Y-m-d H:i:s", time());
                $histo->fk_ticket = $model->id_ticket;
                // Lors de la cloture, statut forcément à Closed
                $histo->fk_statut_ticket = 3;
                $logged = Yii::app()->session['Logged'];
                $histo->fk_user = $logged['id_user'];
                $histo->save(FALSE);
                Yii::trace('apres save de l\'historique', 'cron');
                $this->redirect(array('view', 'id' => $model['id_ticket']));
            } catch (CDbException $ex) {

            }
        } else {
            $this->render('close', array(
                'model' => $this->loadModel($id),
            ));
        }
    }

    public function actionTraitement($id) {
        if (isset($_POST['Ticket'])) {
            $oldmodel = $this->loadModel($id);
            $model = $_POST['Ticket'];
            if (($model['fk_entreprise'] == NULL) || ($model['date_intervention'] == NULL)) {
                Yii::trace('entreprise ou date null', 'cron');
                $this->redirect(array('traitement', 'id' => $oldmodel['id_ticket']));
            }
            Yii::trace('entreprise et date non null', 'cron');
            $oldmodel['date_intervention'] = $model['date_intervention'];
            $oldmodel['fk_entreprise'] = $model['fk_entreprise'];
            $oldmodel['fk_statut'] = 2;
            try {
                Yii::trace('dans Try', 'cron');
                $oldmodel->save(FALSE);
                Yii::app()->session['EmailSend'] = 'Un mail vous a été envoyé à l\' adresse : ' . Yii::app()->session['Logged']->email;
                Yii::trace('apres save du model', 'cron');
                // Si la sauvegarde du ticket s'est bien passé,
                // on enregistre un évènement InProgress pour le traitement du ticket
                $histo = new HistoriqueTicket();
                $histo->date_update = date("Y-m-d H:i:s", time());
                $histo->fk_ticket = $oldmodel->id_ticket;
                // Lors du traitement, statut forcément à InProgress
                $histo->fk_statut_ticket = 2;
                $logged = Yii::app()->session['Logged'];
                $histo->fk_user = $logged['id_user'];
                $histo->save(FALSE);
                Yii::trace('apres save de l\'historique', 'cron');
                $this->redirect(array('view', 'id' => $oldmodel['id_ticket']));
            } catch (CDbException $ex) {
                Yii::trace('dans catch', 'cron');
                echo 'erreru' . $ex->getMessage();
                Yii::app()->session['erreurDB'] = 'Souci avec la base de données, veuillez contacter votre administrateur';
            }
            Yii::trace('Après catch', 'cron');
        }
        $this->render('traitement', array(
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
            $logged = Yii::app()->session['Logged'];
            // Vérifie quel utilisateur est enregistré (si User ou Locataire)
            if (Yii::app()->session['Utilisateur'] == 'Locataire') {
                // Si locataire, on attribue le ticket a un user par défaut (le 1 dans ce cas-ci)
                $ticket['fk_user'] = 1;
                // Si locataire, on met le canal à web automatiquement
                $ticket['fk_canal'] = 2;
                // Et si locataire, on reprend son propre id pour la création du ticket
                $ticket['fk_locataire'] = $logged->id_locataire;
            } else {
                // Si user, c'est lui-même qui s'occupera de ce ticket-ci
                $ticket['fk_user'] = $logged['id_user'];
                // Si user, c'est que le locataire a appelé pour créer le ticket, donc canal à 1
                $ticket['fk_canal'] = 1;
                // Et si user, on reprend l'id passé en paramètre précedemment
                $ticket['fk_locataire'] = $_GET['id'];
            }

            // On met à jour la sous-catégorie (qui est liée elle-même à une catégorie mère unique).
            if(isset($_POST['DD_sousCat']))
                $ticket['fk_categorie'] = $_POST['DD_sousCat'];
            else
                $ticket['fk_categorie'] = 'null';

            // Génère le code_ticket (unique à chaque ticket) selon le batiment
            $ticket['code_ticket'] = $ticket['fk_batiment'] != null ? $this->createCodeTicket($ticket['fk_batiment']) : null;
            // Notre modèle prend la valeur reçue de la page et on test un save
            // (dans la méthode save, on fait d'abord une validation des attributs)
            $model->attributes = $ticket;
            try {
                Yii::trace('Dans try avant save', 'cron');
                $model->save();
                Yii::trace('Dans try apres save', 'cron');
                Yii::app()->session['EmailSend'] = 'Un mail vous a été envoyé à l\' adresse : ' . Yii::app()->session['Logged']->email;
                // Si la sauvegarde du ticket s'est bien passé,
                // on enregistre un évènement opened pour la création du ticket
                $histo = new HistoriqueTicket();
                $histo->date_update = date("Y-m-d H:i:s", time());
                $histo->fk_ticket = $model->id_ticket;
                // Lors de la création, statut forcément à opened
                $histo->fk_statut_ticket = 1;
                $histo->fk_user = $model['fk_user'];
                $histo->save(FALSE);
                // Si tout s'est bien passé, on redirige vers la page view
                Yii::app()->session['NouveauTicket']='nouveau';
                $this->redirect(array('view', 'id' => $model->id_ticket));
            } catch (CDbException $e) {

                Yii::app()->session['erreurDB'] = $e->getMessage();
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    private function createCodeTicket($fk_batiment) {
        // Table batiment contient un code (4 caractères différents pour chaque bâtiment) et un compteur (qui s'incrémente de 1 à chaque ajout de ticket)
        $batiment = Batiment::model()->findByPk($fk_batiment);
        // On incrémente le compteur de 1
        $batiment->cpt += 1;
        // On save pour enregistrer l'incrémentation sinon recommence toujours du même nombre
        $batiment->save(false);
        // On return le string du code_ticket
        return $batiment->code . $batiment->cpt;
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $oldmodel = $this->loadModel($id);

        // Vérifie si a bien reçu un objet 'Ticket'
        // ==> si non, c'est que c'est la première arrivée sur la page update,
        // ==> si oui, c'est que c'est la page update elle-même qui renvoie ici pour la mise à jour d'un ticket
        if (isset($_POST['Ticket'])) {
            // Stocke les anciennes valeurs du modèle, pour comparaison ultérieure.
            // Le changement du modèle s'opère ici.
            $model->attributes = $_POST['Ticket'];
            // On génère un code ticket selon le bâtiment selectionné SEULEMENT si le batiment a changé
            $model->code_ticket = $model->fk_batiment != $oldmodel->fk_batiment ? $this->createCodeTicket($model->fk_batiment) : $model->code_ticket;

            // On met à jour la sous-catégorie (qui est liée elle-même à une catégorie mère unique).
            if(isset($_POST['DD_sousCat']))
                $model->fk_categorie = $_POST['DD_sousCat'];
            else
                $ticket['fk_categorie'] = 'null';

            // Ensuite on sauvegarde les changements normalement.
            try {
                $model->save();
                Yii::app()->session['EmailSend'] = 'Un mail vous a été envoyé à l\' adresse : ' . Yii::app()->session['Logged']->email;
                // Si la sauvegarde du ticket s'est bien passé,
                // on enregistre un évènement pour le ticket
                $histo = new HistoriqueTicket();
                $histo->date_update = date("Y-m-d H:i:s", time());
                $histo->fk_ticket = $model->id_ticket;
                $logged = Yii::app()->session['Logged'];
                $histo->fk_user = $logged['id_user'];
                // TODO TODO
                $histo->fk_statut_ticket = $model->fk_statut;
                $histo->save();
                $this->redirect(array('view', 'id' => $model->id_ticket));
            } catch (Exception $ex) {

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
        Yii::trace('je parle', 'cron');
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
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Ticket']))
            $model->attributes = $_GET['Ticket'];

        $var = !isset($_GET['var']) ? 'admin' : $_GET['var'];
        $this->render($var, array(
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

    /**
     * Retourne une liste d'entreprises pouvant être contactées dans le cadre d'un ticket
     * @param $idTicket L'identifiant du ticket concerné
     * @return array La liste des entreprises "sélectionnables"
     */
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

    /**
     * Retourne une liste de secteurs possibles pour une catégorie d'incident donnée
     * @param $entreprise ???
     * @param $categorie La catégorie d'incident concernée
     * @param $batiment Le bâtiment concerné
     * @return array|mixed|null
     */
    public function getSecteurByFk($entreprise, $categorie, $batiment) {
        $var = Secteur::model()->findByAttributes(array('fk_batiment' => $batiment, 'fk_categorie' => $categorie, 'fk_entreprise' => $entreprise));
        return $var->id_secteur;
    }

    /**
     * Retourne la liste de tous les bâtiments de la DB.
     * @return array|CActiveRecord|mixed|null La liste de tous les bâtiments de la DB
     */
    public function getBatiment() {
        $batiments = Batiment::model()->findAll();
        foreach ($batiments as $batiment) {
            $batiment['name'] = $batiment->adresse . ', ' . $batiment->cp . ' ' . $batiment->commune . ' - nom: ' . $batiment->nom;
        }
        return $batiments;
    }

    /**
     * Cette méthode s'occupe du chargement dynamique des sous-catégories en fonction de la catégorie principale sélectionnée.
     * Elle crée elle même les tags <option value="...">...</option> qui formeront le form (qui se trouve dans la vue).
     */
    public function actionGetSousCategoriesDynamiques()
    {
        // Yii::trace("Entrée dans la méthode de recherche des sous-catégories dynamiques..."); // Passe

        // Exécution d'une query qui récupère toutes les sous-catégories possibles pour la catégorie principale choisie.
        $data = CategorieIncident::model()->findAll('fk_parent=:toFind', array(':toFind' => $_POST['paramID']));
        // On formatte les données reçues dans une DataList
        $dataList = CHtml::listData($data, 'id_categorie_incident', 'label');

        // Pour chaque clé=>valeur contenues dans la DataList, on crée un tag <options...> avec les valeurs récupérées.
        foreach($dataList as $key=>$value)
        {
            // Yii::trace("clé: " . $key . " | valeur: " . $value, "cron"); // Passe

            echo CHtml::tag
            (
                // Le type de tag, ex.: <option..>, <input..>, ...
                    'option',
                // On attribue la valeur ("cachée") à attribuer au champs ex.: <option value="1">...</option>
                    array('value'=>$key, 'name'=>'clef'),
                // On attribue un label au champs ex.: <option value="1">Sanitaire</option>
                CHtml::encode($value),
                // true pour fermer le tag, false pour le laisser ouvert
                true
            );
        }
    }
}
