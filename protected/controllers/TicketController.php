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
     * La fonction permettant d'accorder des droits aux différents utilisateurs.
     * Quand la méthode est appellée, on vérifie le type de l'utilisateur,
     * et en fonction de cela, les droits accordés peuvent varient.
     */
    public function accessRules() { // // droit des utilisateur sur les urls
        $logged = Yii::app()->session['Logged'];
        if (Yii::app()->session['Utilisateur'] == 'Locataire') {
            return array(
                array('allow', // le locataire peut juste creer un ticket et voir
                    'actions' => array('view', 'create', 'getsouscategoriesdynamiques', 'sendnotificationmail'),
                    'users' => array('@'), // user authentifier
                ),
                array('deny', // refuse autre users
                    'users' => array('*'), //tous utilisateur
                    'message' => 'Vous n\'avez pas accès à cette page.'
                ),
            );
        } elseif ((Yii::app()->session['Utilisateur'] == 'User') && ($logged->fk_fonction == Constantes::ID_USER)) { // Utilisateur peut creer ,voir ,manager,traiter et fermer des ticket
            return array(
                array('allow', // allow authenticated user to perform 'create' and 'update' actions
                    'actions' => array('create', 'update', 'view', 'admin', 'traitement', 'getsouscategoriesdynamiques', 'close', 'sendnotificationmail'),
                    'users' => array('@'), //user logger
                ),
            );
        } elseif ((Yii::app()->session['Utilisateur'] == 'User') &&

                (($logged->fk_fonction == Constantes::ID_ADMIN) || ($logged->fk_fonction == Constantes::ID_ROOT))
        ) { // Utilisateur peut creer ,voir ,manager,traiter et fermer des ticket
            return array(
                array('allow', // allow authenticated user to perform 'create' and 'update' actions
                    'actions' => array('create', 'update', 'view', 'admin', 'traitement', 'getsouscategoriesdynamiques', 'close', 'sendnotificationmail', 'delete'),
                    'users' => array('@'), //user logger
                ),
            );
        } else {
            return array(
                array('deny',
                    'users' => array('?'), //user non loger peut rien faire
                    'message' => 'Vous n\'avez pas accès à cette page.'
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

    public function actionClose($id) {
        if (isset($_POST['Ticket'])) {
            $var = $_POST['Ticket'];
            $model = $this->loadModel($id);
            $model->descriptif = $model->descriptif . ' ---------- Cloture ---------- ' . $var['descriptif'];
            $model->fk_statut = Constantes::ID_CLOSED;
            try {
                $model->save(false);
                $loc = Locataire::model()->findByPk($model['fk_locataire']);
                Yii::app()->session['EmailSend'] = 'Un mail vous a été envoyé à l\' adresse : ' . $loc['email'];
                $histo = new HistoriqueTicket();
                $histo->date_update = date("Y-m-d H:i:s", time());
                $histo->fk_ticket = $model->id_ticket;
// Lors de la cloture, statut forcément à Closed
                $histo->fk_statut_ticket = Constantes::ID_CLOSED;
                $logged = Yii::app()->session['Logged'];
                $histo->fk_user = $logged['id_user'];
                $histo->save(FALSE);
                Yii::trace('apres save de l\'historique', 'cron');
                $this->actionSendNotificationMail($model);
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
                $this->redirect(array('traitement', 'id' => $oldmodel['id_ticket']));
            }
            $oldmodel['date_intervention'] = $model['date_intervention'];
            $oldmodel['fk_entreprise'] = $model['fk_entreprise'];
            $oldmodel['fk_statut'] = Constantes::ID_TREATMENT;
            try {
                $oldmodel->save(FALSE);
                $loc = Locataire::model()->findByPk($oldmodel['fk_locataire']);
                Yii::app()->session['EmailSend'] = 'Un mail vous a été envoyé à l\' adresse : ' . $loc['email'];
                Yii::trace('apres save du model', 'cron');
// Si la sauvegarde du ticket s'est bien passé,
// on enregistre un évènement InProgress pour le traitement du ticket
                $histo = new HistoriqueTicket();
                $histo->date_update = date("Y-m-d H:i:s", time());
                $histo->fk_ticket = $oldmodel->id_ticket;
// Lors du traitement, statut forcément à InProgress
                $histo->fk_statut_ticket = Constantes::ID_TREATMENT;
                $logged = Yii::app()->session['Logged'];
                $histo->fk_user = $logged['id_user'];
                $histo->save(FALSE);
                Yii::trace('apres save de l\'historique', 'cron');
                $this->actionSendNotificationMail($oldmodel);
                $this->redirect(array('view', 'id' => $oldmodel['id_ticket']));
            } catch (CDbException $ex) {
                Yii::trace('dans catch', 'cron');
                echo 'erreur' . $ex->getMessage();
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
                $ticket['fk_canal'] = Constantes::ID_WEB;
// Et si locataire, on reprend son propre id pour la création du ticket
                $ticket['fk_locataire'] = $logged->id_locataire;
            } else {
// Si user, c'est lui-même qui s'occupera de ce ticket-ci
                $ticket['fk_user'] = $logged['id_user'];
// Si user, c'est que le locataire a appelé pour créer le ticket, donc canal à 1
                $ticket['fk_canal'] = Constantes::ID_PHONE;
// Et si user, on reprend l'id passé en paramètre précedemment
                $ticket['fk_locataire'] = $_GET['id'];
            }

// On met à jour la sous-catégorie (qui est liée elle-même à une catégorie mère unique).
            if (isset($_POST['DD_sousCat']))
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
                $loc = Locataire::model()->findByPk($model['fk_locataire']);
                Yii::app()->session['EmailSend'] = 'Un mail vous a été envoyé à l\' adresse : ' . $loc['email'];
// Si la sauvegarde du ticket s'est bien passé,
// on enregistre un évènement opened pour la création du ticket
                $histo = new HistoriqueTicket();
                $histo->date_update = date("Y-m-d H:i:s", time());
                $histo->fk_ticket = $model->id_ticket;
// Lors de la création, statut forcément à opened
                $histo->fk_statut_ticket = Constantes::ID_OPENED;
                $histo->fk_user = $model['fk_user'];
                $histo->save(FALSE);
                $this->actionSendNotificationMail($model);
// Si tout s'est bien passé, on redirige vers la page view
                Yii::app()->session['NouveauTicket'] = 'nouveau';
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
        //COMMENTS
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
            if (isset($_POST['DD_sousCat']))
                $model->fk_categorie = $_POST['DD_sousCat'];
            else
                $ticket['fk_categorie'] = 'null';

// Ensuite on sauvegarde les changements normalement.
            try {
                $model->save();
                $loc = Locataire::model()->findByPk($model['fk_locataire']);
                Yii::app()->session['EmailSend'] = 'Un mail vous a été envoyé à l\' adresse : ' . $loc['email'];
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
                $this->actionSendNotificationMail($model);
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
        //$this->loadModel($id)->delete();
        $model = $this->loadModel($id);
        $model->setAttribute("visible", 0);
        $model->save(true);
        $this->redirect(admin);
// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
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
    private function actionSendNotificationMail($modelTicket) {
        $message = new YiiMailMessage;
        $locataire = Locataire::model()->findByPk($modelTicket->fk_locataire);
        $message->from = 'mailer@web3sys.com';
        $message->addTo($locataire->email);

        switch ($modelTicket->fk_statut) {
            case Constantes::ID_OPENED: // Cas création d'un ticket
                $message->subject = "Un nouveau ticket a été créé";
                $message->setBody(
                        "<div style='text-align: center;'><h2>Votre ticket n&ordm; " . $modelTicket->code_ticket . " a &eacute;t&eacute; cr&eacute;&eacute;.</h2></div>"
                        . "<div style='border-style: solid; border-width: 2px; margin-left: 10em; margin-right: 10em; padding: 2em; border-radius: 3em;'>"
                        . "<u>R&eacute;sum&eacute; des informations du ticket:</u><br/><br/>"
                        . "<b>Cr&eacute;ateur du ticket</b>: " . $locataire->nom . "<br/>"
                        . "<b>Catégorie du ticket</b>: " . CategorieIncident::model()->findByPk(CategorieIncident::model()->findByPk($modelTicket->fk_categorie)->fk_parent)->label . "<br/>"
                        . "<b>Sous-catégorie du ticket</b>: " . CategorieIncident::model()->findByPk($modelTicket->fk_categorie)->label . "<br/>"
                        . "<b>Bâtiment concern&eacute;</b>: " . Batiment::model()->findByPk($modelTicket->fk_batiment)->nom . "<br/>"
                        . "<b>Adresse</b>: " . Batiment::model()->findByPk($modelTicket->fk_batiment)->adresse . "<br/>"
                        . "<b>Commentaire</b>: " . $modelTicket->descriptif . "<br/>"
                        . "<b>Gestionnaire de votre ticket</b>: " . User::model()->findByPk($modelTicket->fk_user)->nom . "<br/>"
                        . "<br/>"
                        . "<b><center>Merci d'avoir rapporté votre problème.</center>   </b>"
                        . "</div>"
                        , 'text/html'
                );
                break;

            case Constantes::ID_TREATMENT: // Cas en traitement
                $message->subject = "Le statut de votre ticket a changé.";
                $message->setBody(
                        "<div style='text-align: center;'><h2>Le statut de votre ticket n° " . $modelTicket->code_ticket . " a chang&eacute;.</h2></div>"
                        . "<div style='border-style: solid; border-width: 2px; margin-left: 10em; margin-right: 10em; padding: 2em; border-radius: 3em;'>"
                        . "R&eacute;sum&eacute; des informations du ticket:<br/>"
                        . "Cr&eacute;ateur du ticket: " . $locataire->nom . "<br/>"
                        . "Catégorie du ticket: " . CategorieIncident::model()->findByPk(CategorieIncident::model()->findByPk($modelTicket->fk_categorie)->fk_parent)->label . "<br/>"
                        . "Sous-catégorie du ticket: " . CategorieIncident::model()->findByPk($modelTicket->fk_categorie)->label . "<br/>"
                        . "Bâtiment concern&eacute;: " . Batiment::model()->findByPk($modelTicket->fk_batiment)->nom . "<br/>"
                        . "Adresse : " . Batiment::model()->findByPk($modelTicket->fk_batiment)->adresse . "<br/>"
                        . "Commentaire: " . $modelTicket->descriptif . "<br/>"
                        . "Gestionnaire de votre ticket: " . User::model()->findByPk($modelTicket->fk_user)->nom
                        . "</div>"
                        , 'text/html'
                );
                break;

            case Constantes::ID_CLOSED: // Cas clôture
                $message->subject = "Votre ticket n° " . $modelTicket->code_ticket . " à été clôturé";
                $message->setBody(
                        "<div style='border-style: solid; border-width: 2px; margin-left: 10em; margin-right: 10em; padding: 2em; border-radius: 3em;'>"
                        . "Votre ticket n&ordm; " . $modelTicket->code_ticket . " &agrave; &eacute;t&eacute; cl&ocirc;tur&eacute;. <br/>"
                        . "Commentaire: " . $modelTicket->descriptif . "<br/>"
                        . "<br/><br/>"
                        . "Si votre probl&egrave;me persiste, veuillez r&eacute;ouvrir un ticket &agrave; l'adresse suivante: "
                        . "http://localhost/w3s-tickets" // TODO changer l'adresse ici!!
                        . "</div>"
                        , 'text/html'
                );
                break;

            default:
                return;
        }

        Yii::app()->mail->send($message);
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
        //TODO commenter
        $lieu = Lieu::model()->findByPk($model->fk_lieu);
        $secteurs = Secteur::model()->findAllByAttributes(array('fk_batiment' => $lieu->fk_batiment, 'fk_categorie' => $model->fk_categorie, 'visible' => 1));
        $entreprises = array();
        foreach ($secteurs as $secteur)
        {
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
        $var = Secteur::model()->findByAttributes(array('fk_batiment' => $batiment, 'fk_categorie' => $categorie, 'fk_entreprise' => $entreprise, 'visible' => 1));
        return $var->id_secteur;
    }

    /**
     * Retourne la liste de tous les bâtiments de la DB.
     * @return array|CActiveRecord|mixed|null La liste de tous les bâtiments de la DB
     */
    public function getBatiment() {
        $batiments = Batiment::model()->findAllByAttributes(array('visible' => 1));
        foreach ($batiments as $batiment) {
            $batiment['name'] = $batiment->adresse . ', ' . $batiment->cp . ' ' . $batiment->commune . ' - nom: ' . $batiment->nom;
        }
        return $batiments;
    }

    /**
     * Cette méthode s'occupe du chargement dynamique des sous-catégories en fonction de la catégorie principale sélectionnée.
     * Elle crée elle même les tags <option value="...">...</option> qui formeront le form (qui se trouve dans la vue).
     */
    public function actionGetSousCategoriesDynamiques() {
// Yii::trace("Entrée dans la méthode de recherche des sous-catégories dynamiques..."); // Passe
// Exécution d'une query qui récupère toutes les sous-catégories possibles pour la catégorie principale choisie.
        $data = CategorieIncident::model()->findAll('fk_parent=:toFind, visible=:visible', array(':toFind' => $_POST['paramID'], ':visible' => 1));
// On formatte les données reçues dans une DataList
        $dataList = CHtml::listData($data, 'id_categorie_incident', 'label');

// Pour chaque clé=>valeur contenues dans la DataList, on crée un tag <options...> avec les valeurs récupérées.
        foreach ($dataList as $key => $value) {
// Yii::trace("clé: " . $key . " | valeur: " . $value, "cron"); // Passe

            echo CHtml::tag
                    (
// Le type de tag, ex.: <option..>, <input..>, ...
                    'option',
                    // On attribue la valeur ("cachée") à attribuer au champs ex.: <option value="1">...</option>
                    array('value' => $key, 'name' => 'clef'),
                    // On attribue un label au champs ex.: <option value="1">Sanitaire</option>
                    CHtml::encode(Translate::trad($value)),
                    // true pour fermer le tag, false pour le laisser ouvert
                    true
            );
        }
    }

    public function getCategoriesLabel() { //return list categorie's label
        $datas = CategorieIncident::model()->findAllByAttributes(array('fk_parent' => NULL, 'visible' => 1));
        $datasList = CHtml::listData($datas, 'id_categorie_incident', 'label');

        foreach ($datasList as $key => $value) {
            $datasList[$key] = CHtml::encode(Translate::trad($datasList[$key]));
        }

        //print_r($datasList);

        return $datasList;
    }

}
