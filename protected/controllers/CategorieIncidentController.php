<?php

class CategorieIncidentController extends Controller {
    /*
     * Les constantes suivantes correspondent aux actions. Il y a une constante
     * pour chaque action de ce contrôleur. Ces constantes serviront à attribuer
     * ou non des droits aux utilisateurs (voir la méthode 'accessRules()' de 
     * ce même contrôleur)
     */
    Const ID_CONTROLLER = 3;
    Const ACTION_VIEW = 1;
    Const ACTION_CREATE = 2;
    // const ACTION_CREATECAR = 2;
    //COnst ACTION_CREATESOUSCAT = 4;
    const ACTION_UPDATE = 8;
    // const ACTION_UPDATECAR = 8;
    //const ACTION_UPDATESOUSCAT = 16;
    const ACTION_ADMIN = 32;
    const ACTION_DELETE = 64;

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
     * ce controleur et génère l'array 'allow' (permis) selon ces droits-là.
     */
    public function accessRules() { // droit des utilisateur sur les actions
        if (!Yii::app()->user->isGuest) { // Génération des droits selon le user
            
            // On récupère d'abord le user de la session
            $logged = Yii::app()->session['Logged'];
            // ainsi que ses droits sur ce contrôleur
            $rights = Yii::app()->session['Rights']->getCategorie();
                // La méthode getCategorie() demande à ne récupérer que les droits
                // lié à ce contrôleur-ci (en l'occurence, categorie)
            
            $allow = array('noright');
                // On initialise ensuite l'array qui stockera les droits
                // On lui met une action inexistante car la méthode accessRules
                // considère qu'un array vide c'est avoir tous les droits
            
            /* Et enfin on teste chaque droit un à un, et si le droit est bien accordé,
             * on le rajoute à l'array qui sera envoyé dans le return
             */
            // Le test s'effectue grâce à un opérateur de comparaison de bit.
            // On vérifie que dans l'integer représentant les droits sur ce contrôleur,
            // le bit correspondant à un certain nombre soit bien à un.
            // Ces nombres-là sont les valeurs des constantes tout en haut de la classe,
            // on a volontairement choisi des nombres binaires (1, 2, 4, 8, ...) pour que
            // chaque nombre n'ait qu'un seul bit à '1' et n'accorde donc qu'un seul droit
            if ($rights & self::ACTION_VIEW) array_push($allow, 'view');
            if ($rights & self::ACTION_CREATE) {
                array_push($allow, 'createcat');
                array_push($allow, 'createsouscat');
            }
            if ($rights & self::ACTION_UPDATE) {
                array_push($allow, 'update');
                array_push($allow, 'updatecat');
                array_push($allow, 'updatesouscat');
            }
            if ($rights & self::ACTION_ADMIN) array_push($allow, 'admin');
            if ($rights & self::ACTION_DELETE) array_push($allow, 'delete');

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
     * LA DOCUMENTATION POUR CETTE FONCTION SE TROUVE ICI : http://web3sys.com/tickets/wiki/index.php?title=Fonction_%22AttemptSave%22
     *
     * Tente une sauvegarde de l'objet passé en paramètre sur la DB, et ce en utilisant les transactions SQL.
     * Les validations seront de toutes façon effectuées car elles sont nécéssaires à l'intégrité des données.
     * @param null $objectToSave L'active record dont les changements doivent être commit vers la DB.
     * @return bool Un booléen qui signifie si la sauvegarde s'est bien passé ou non.
     */
    private function attemptSave($objectToSave)
    {
        /* @var CDbConnection $db */
        /* @var CDbTransaction $tsql */
        $db = Yii::app()->db;
        $tsql = $db->beginTransaction();

        if($objectToSave === null) return false;
        try
        {
            // Si la validation est passée ET qu'aucune erreur n'est retournée par la DB
            if($objectToSave->validate() && $objectToSave->save(true))
            {
                // On commite les changements
                $tsql->commit();
            }
            else // Non validé
            {
                // Si la validation n'est pas passée, on génère le message d'erreur
                $err = "Une erreur est survenue : <br/>";
                // ici on récupère les strings d'erreur contenues dans le modèle, pour les ajouter à la string d'erreur "principale"
                foreach($objectToSave->getErrors() as $k=>$v)
                    $err .= $v[0] . "<br/>";
                // On lance une exception qui sera catchée juste ci-dessous pour le rollback et l'affichage du TbAlert
                throw new Exception($err);
            }
        }
        catch(Exception $e)
        {
            // On annule les changements préparés
            $tsql->rollback();
            // On affiche un TbAlert avec le message d'erreur
            Yii::app()->user->setFlash('error', $e->getMessage());
            return false;
        }
        return true;
    }
    
    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreateCat() {
        $db = Yii::app()->db;
        $tsql = $db->beginTransaction();
        
        $trad = new Trad();
        $trad->fr = '';
        $trad->en = '';
        $trad->nl = '';
        
        $model = new CategorieIncident();
        // On génère un premier modèle
        // Vérifie si a bien reçu un objet 'CategorieIncident'
        // ==> si non, c'est que c'est la première arrivée sur la page create,
        // ==> si oui, c'est que c'est la page create elle-même qui renvoie ici pour la création d'une catégorie
        if (isset($_POST['CategorieIncident'])) {
            $trad->fr = $_POST['tradFR'];
            $trad->nl = $_POST['tradNL'];
            $trad->en = $_POST['tradEN'];
            $model->attributes = $_POST['CategorieIncident'];
            $model['fk_priorite'] = Constantes::PRIORITE_LOW;
            // Pour une catégorie parent, il n'y a pas de priorité mais pour la DB
            // qui en exige une, on en met une par défaut (elle n'est jamais utilisée)
            if ($model->validate() && $_POST['fk_entreprise'] != null &&
                    ($_POST['tradFR'] != '' && $_POST['tradNL'] != '' && $_POST['tradEN'] != '')) {
                // Si la validation du modèle (vérifie que tout est bien présent comme il faut)
                // et que l'entreprise reçu n'est pas null, alors on peut enregistrer
                //if ($model->save(FALSE)) {  // Le FALSE indique qu'on ne désire pas
                if($this->attemptSave($model)) {
                    // faire la validation avant le save. Validation
                    // faite au dessus, pas besoin de la refaire
                    // Si le save s'est bien passé, on crée une sous-catégorie 'Autre'
                    // pour cette catégorie parent et aussi un secteur pour le lier à l'entreprise
                    $sousCat = new CategorieIncident();
                    $sousCat['fk_parent'] = $model['id_categorie_incident'];
                    // On a déjà enregistré le parent et Yii a automatiquement repris son id
                    $sousCat['label'] = 'Autre';
                    $sousCat['fk_priorite'] = Constantes::PRIORITE_LOW;
                    // Une sous-catégorie 'Autre' est toujours à priorité basse
                    $sousCat->save(true);
                    
                    $secteur = new Secteur();
                    $secteur->fk_entreprise = $_POST['fk_entreprise'];
                    $secteur['fk_categorie'] = $model['id_categorie_incident'];
                    // Nouveau secteur que l'on remplit avec les infos qu'on a déjà
                    $secteur->save();

                    $this->redirect(array('view', 'id' => $model->id_categorie_incident));
                    // Et enfin on redirige
                }
            } else {
                // Si la validation n'est pas bonne, que l'entreprise est null
                // ou que les traductions n'ont pas bien été remplies...
                if ($_POST['tradFR'] == '' || $_POST['tradNL'] == '' || $_POST['tradEN'] == '') {
                    // On vérifie si c'est l'une des traductions qui pose problème
                    Yii::app()->session['errorTradField'] = true;
                    // Si oui, on met une variable indiquant qu'il y a une erreur
                    // Cette variable servira à afficher un message indiquant qu'il faut remplir les traductions
                } elseif ($_POST['fk_entreprise'] == null) {
                    // On vérifie si c'est l'entreprise qui pose problème
                    Yii::app()->session['errorEntrepriseField'] = true;
                    // Si oui, on met une variable indiquant qu'il y a une erreur
                    // Cette variable servira à afficher un message indiquant qu'il faut remplir l'entreprise
                } else {
                    // Si pas de problème avec l'entreprise, variable pour envoyer l'entreprise
                    // Cette variable-ci servira à mettre une entreprise par défaut lors
                    // du retour sur la page sinon la page est remise à 0 même si correct
                    Yii::app()->session['id_entreprise'] = $_POST['fk_entreprise'];
                }
                $this->render('createCat', array(// Et dans les deux cas, on redirige
                    'model' => $model, 'trad' => $trad
                ));
            }
        } else { // Si pas de CategorieIncident, donc premier arrivé sur la page et on se contente de l'afficher
            $this->render('createCat', array(
                'model' => $model, 'trad' => $trad
            ));
        }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreateSousCat() {
        
        $trad = new Trad();
        $trad->fr = '';
        $trad->en = '';
        $trad->nl = '';
        
        $model = new CategorieIncident();
        // On génère un premier modèle
        // Vérifie si a bien reçu un objet 'CategorieIncident'
        // ==> si non, c'est que c'est la première arrivée sur la page create,
        // ==> si oui, c'est que c'est la page create elle-même qui renvoie ici pour la création d'une catégorie
        if (isset($_POST['CategorieIncident'])) {
            $trad->fr = $_POST['tradFR'];
            $trad->nl = $_POST['tradNL'];
            $trad->en = $_POST['tradEN'];
            $model->attributes = $_POST['CategorieIncident'];
            if ($model['fk_parent'] != null && ($_POST['tradFR'] != '' && $_POST['tradNL'] != ''
                    && $_POST['tradEN'] != '') && $this->attemptSave($model)) {
                $this->redirect(array('view', 'id' => $model->id_categorie_incident));
            } else { // Si validation pas ok, traductions pas ok ou parent null
                if ($model['fk_parent'] == null) // On vérifie si c'est le parent qui pose problème
                    Yii::app()->session['errorParentField'] = true;
                // Si c'est bien le parent, on met une variable de session pour l'indiquer
                // Ensuite dans la vue, on affichera un message si cette variable est à true
                // Et enfin on redirige
                $this->render('createSousCat', array(
                    'model' => $model, 'trad' => $trad
                ));
            }
        } else { // Si aucune variable envoyée, alors c'est le premier passage sur la page
            $this->render('createSousCat', array(
                'model' => $model, 'trad' => $trad
            ));
        }
    }
    
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        if($model->fk_parent == null) // Si c'est une catégorie parente, rediriger vers actionUpdateCat($id);
            $this->redirect(array('updatecat', 'id'=>$id));
        else
            $this->redirect(array('updatesouscat', 'id'=>$id));
    }
    
    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdateSousCat($id) {
        $model = $this->loadModel($id);
        // On retrouve d'abord l'enregistrement que l'on veut updater
        // Vérifie si a bien reçu un objet 'CategorieIncident'
        // ==> si non, c'est que c'est la première arrivée sur la page create,
        // ==> si oui, c'est que c'est la page create elle-même qui renvoie ici pour la création d'une catégorie
        if (isset($_POST['CategorieIncident'])) {
            // Dans le cas de la mise à jour de la sous-catégorie, il est impossible 
            // de ne pas avoir de parent ou de priorité étant donné qu'ils ont déjà été
            // introduits lors de la création. Dans la page update il n'y a pas la possibilité
            // de repasser ces champs à null, par contre on peut supprimer le label d'ou le
            // fait de laisser la validation se faire dans le "$model->save()"
            $model->attributes = $_POST['CategorieIncident'];
            //if ($model->save()) // Si la sauvegarde s'est bien passée, on redirige
            if($this->attemptSave($model))
                $this->redirect(array('view', 'id' => $model->id_categorie_incident));
        }

        // On arrive ici seulement s'il n'y a pas de $_POST[CategorieIncident],
        // donc lors du premier passage sur la page
        $this->render('updateSousCat', array(// Et enfin on redirige
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdateCat($id) {
        $model = $this->loadModel($id);
        // On retrouve d'abord l'enregistrement que l'on veut updater

        $secteur = Secteur::model()->findByAttributes(array('visible' => Constantes::VISIBLE, 'fk_categorie' => $id));
        // On retrouve déjà pour plus tard le secteur lié à cette catégorie
        // Vérifie si a bien reçu un objet 'CategorieIncident'
        // ==> si non, c'est que c'est la première arrivée sur la page create,
        // ==> si oui, c'est que c'est la page create elle-même qui renvoie ici pour la création d'une catégorie
        if (isset($_POST['CategorieIncident'])) {
            // Dans le cas de la mise à jour de la catégorie, il est impossible 
            // de ne pas avoir d'entreprise ou de priorité étant donné qu'ils ont déjà été
            // introduits lors de la création. Dans la page update il n'y a pas la possibilité
            // de repasser ces champs à null, par contre on peut supprimer le label d'ou le
            // fait de laisser la validation se faire dans le "$model->save()"
            $model->attributes = $_POST['CategorieIncident'];
            //if ($model->save()) { // Si l'enregistrement se passe bien, on continue
            if($this->attemptSave($model)) {
                $secteur['visible'] = Constantes::INVISIBLE;
                $secteur->save(); // On passe ce secteur à invisible

                $newSecteur = new Secteur(); // Et on en crée un nouveau avec les mêmes infos
                $newSecteur['fk_categorie'] = $secteur['fk_categorie'];
                $newSecteur['fk_entreprise'] = $secteur['fk_entreprise'];
                $newSecteur->save(); // On le sauve
                $this->redirect(array('view', 'id' => $model->id_categorie_incident));
                // Et enfin on redirige l'utilisateur
            }
        }

        // On arrive ici seulement s'il n'y a pas de $_POST[CategorieIncident],
        // donc lors du premier passage sur la page

        Yii::app()->session['id_entreprise'] = $secteur['fk_entreprise'];
        // Cette variable de session est initialisée pour pouvoir mettre une
        // valeur par défaut dans la comboBox entreprise. Etant donné que l'entreprise
        // n'est pas un champ de la catégorie, la comboBox ne prendra pas par défaut le champ entreprise
        $this->render('updateCat', array(// Et enfin on redirige
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
            //$model->save(FALSE); // et enfin on enregistre cet état invisible dans la DB
            $this->attemptSave($model);
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
                    //$sousCat->save(FALSE);
                    $this->attemptSave($sousCat);

                    // Retrouver tous les tickets qui sont liés à cette sous-catégorie
                    $tickets = Ticket::model()->findAllByAttributes(
                            array('fk_categorie' => $sousCat['id_categorie_incident'], 'visible' => Constantes::VISIBLE));
                    foreach ($tickets as $ticket) { // Et aussi les passer à l'état invisible
                        $ticket['visible'] = Constantes::INVISIBLE;
                        //$ticket->save(FALSE);
                        $this->attemptSave($ticket);
                    }
                }
                // Il faut aussi retrouver le secteur lié à cette catégories
                $secteur = Secteur::model()->findByAttributes(
                        array('fk_categorie' => $model['id_categorie_incident'], 'visible' => Constantes::VISIBLE));
                $secteur['visible'] = Constantes::INVISIBLE;
//                $secteur->save(FALSE);
                $this->attemptSave($secteur);
            } else { // Si fk_parent n'est pas null, c'est donc un enfant
                // Et si c'est un enfant, il faut juste 'delete' tous les tickets qui sont liés à lui
                $tickets = Ticket::model()->findAllByAttributes(array('fk_categorie' => $id)); // On recherche tous les tickets qui sont liés à cette catégorie
                foreach ($tickets as $ticket) { // et on les passe tous à l'état invisible
                    $ticket['visible'] = Constantes::INVISIBLE;
//                    $ticket->save(FALSE);
                    $this->attemptSave($ticket);
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
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
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
