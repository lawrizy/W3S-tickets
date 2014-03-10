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
    public function actionCreateCat() {
        $model = new CategorieIncident();
        // On génère un premier modèle
        // Vérifie si a bien reçu un objet 'CategorieIncident'
        // ==> si non, c'est que c'est la première arrivée sur la page create,
        // ==> si oui, c'est que c'est la page create elle-même qui renvoie ici pour la création d'une catégorie
        if (isset($_POST['CategorieIncident'])) {
            $model->attributes = $_POST['CategorieIncident'];
            $model['fk_priorite'] = Constantes::PRIORITE_LOW;
            // Pour une catégorie parent, il n'y a pas de priorité mais pour la DB
            // qui en exige une, on en met une par défaut (elle n'est jamais utilisée)
            if ($model->validate() && $_POST['fk_entreprise'] != null) {
                // Si la validation du modèle (vérifie que tout est bien présent comme il faut)
                // et que l'entreprise reçu n'est pas null, alors on peut enregistrer
                if ($model->save(FALSE)) {  // Le FALSE indique qu'on ne désire pas 
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
                    $sousCat->save();

                    $secteur = new Secteur();
                    $secteur->fk_entreprise = $_POST['fk_entreprise'];
                    $secteur['fk_categorie'] = $model['id_categorie_incident'];
                    // Nouveau secteur que l'on remplit avec les infos qu'on a déjà
                    $secteur->save();

                    $this->redirect(array('view', 'id' => $model->id_categorie_incident));
                    // Et enfin on redirige
                }
            } else {
                // Si la validation n'est pas bonne ou que l'entreprise est null ...
                if ($_POST['fk_entreprise'] == null) {
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
                    'model' => $model,
                ));
            }
        } else { // Si pas de CategorieIncident, donc premier arrivé sur la page et on se contente de l'afficher
            $this->render('createCat', array(
                'model' => $model,
            ));
        }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreateSousCat() {
        $model = new CategorieIncident();
        // On génère un premier modèle
        // Vérifie si a bien reçu un objet 'CategorieIncident'
        // ==> si non, c'est que c'est la première arrivée sur la page create,
        // ==> si oui, c'est que c'est la page create elle-même qui renvoie ici pour la création d'une catégorie
        if (isset($_POST['CategorieIncident'])) {
            $model->attributes = $_POST['CategorieIncident'];
            if ($model->validate() && $model['fk_parent'] != null) {
                $model->save(FALSE);    // Le FALSE indique qu'on ne désire pas faire la validation avant
                                        // le save. Validation faite au dessus, pas besoin de la refaire
                
                // Si le save s'est bien passé, on redirige
                $this->redirect(array('view', 'id' => $model->id_categorie_incident));
            } else { // Si validation pas ok ou parent null
                if ($model['fk_parent'] == null) // On vérifie si c'est le parent qui pose problème
                    Yii::app()->session['errorParentField'] = true;
                        // Si c'est bien le parent, on met une variable de session pour l'indiquer
                        // Ensuite dans la vue, on affichera un message si cette variable est à true

                // Et enfin on redirige
                $this->render('createSousCat', array(
                    'model' => $model,
                ));
            }
        } else { // Si aucune variable envoyée, alors c'est le premier passage sur la page
            $this->render('createSousCat', array(
                'model' => $model,
            ));
        }
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
            if ($model->save()) // Si la sauvegarde s'est bien passée, on redirige
                $this->redirect(array('view', 'id' => $model->id_categorie_incident));
        }

        // On arrive ici seulement s'il n'y a pas de $_POST[CategorieIncident],
        // donc lors du premier passage sur la page
        $this->render('updateCat', array(// Et enfin on redirige
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
            if ($model->save()) { // Si l'enregistrement se passe bien, on continue
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
