<?php

class AdminController extends Controller {

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl',
            'postOnly + delete',
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
            $allow = array('noright');
            // On initialise avec déjà une fausse action car un array vide est
            // considéré comme permettant tout
            
            if (Yii::app()->session['Logged']->fk_fonction == Constantes::FONCTION_ROOT) {
                // Les Root ont tous les droits
                array_push($allow, 'update');
                array_push($allow, 'index');
            } elseif (Yii::app()->session['Logged']->fk_fonction != Constantes::FONCTION_LOCATAIRE) {
                // Les User et Admin ont juste le droit d'accès à l'action index
                array_push($allow, 'index');
            } // Les Locataires n'ont aucun droit sur cette page
            
            return array(// Ici on a plus qu'à envoyer la liste des droits
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
            return array(// Ici on a plus qu'à envoyer la liste des droits
                array('deny', // Refuse autre users
                    'users' => array('?'), // Refus aux visiteurs non loggés
                    'message' => 'Vous n\'avez pas accès à cette page.'
                // Le message qui sera affiché
                ),
            );
        }
    }

    public function actionIndex() {
        $this->render('index');
    }

    public function actionUpdate($id) {
        //TODO Transaction
        if (isset($_POST['idPost'])) {
            $model = User::model()->findByPk($_POST['idPost']);
        } else {
            $model = User::model()->findByPk($id);
        }

        if (isset($_POST['tmp'])) {

            // Droits sur BatimentController
            $droit = 0;
            $droit += isset($_POST['BatimentView']) ? BatimentController::ACTION_VIEW : 0;
            $droit += isset($_POST['BatimentAdmin']) ? BatimentController::ACTION_ADMIN : 0;
            $droit += isset($_POST['BatimentCreate']) ? BatimentController::ACTION_CREATE : 0;
            $droit += isset($_POST['BatimentUpdate']) ? BatimentController::ACTION_UPDATE : 0;
            $droit += isset($_POST['BatimentDelete']) ? BatimentController::ACTION_DELETE : 0;
            $droitModel = Droit::model()->findByAttributes(array('fk_user' => $model->id_user, 'fk_controleur' => BatimentController::ID_CONTROLLER));
            $droitModel->droits = $droit;
            $droitModel->save();
            
            // Droits sur CategorieIncidentController
            $droit = 0;
            $droit += isset($_POST['CategoryView']) ? CategorieIncidentController::ACTION_VIEW : 0;
            $droit += isset($_POST['CategoryAdmin']) ? CategorieIncidentController::ACTION_ADMIN : 0;
            $droit += isset($_POST['CategoryCreate']) ? CategorieIncidentController::ACTION_CREATE : 0;
                    // Ce droit regroupe les actions createCat et createSousCat
            $droit += isset($_POST['CategoryUpdate']) ? CategorieIncidentController::ACTION_UPDATE : 0;
                    // Ce droit regroupe les actions updateCat et updateSousCat
            $droit += isset($_POST['CategoryDelete']) ? CategorieIncidentController::ACTION_DELETE : 0;
            $droitModel = Droit::model()->findByAttributes(array('fk_user' => $model->id_user, 'fk_controleur' => CategorieIncidentController::ID_CONTROLLER));
            $droitModel->droits = $droit;
            $droitModel->save();

            // Droits sur DashboardController
            $droit = 0;
            $droit += isset($_POST['DashBoardVue']) ? DashboardController::ACTION_TOUS : 0;
                    // Dans le cas du dashboard, on a tous les droits ou on en a aucun
            $droitModel = Droit::model()->findByAttributes(array('fk_user' => $model->id_user, 'fk_controleur' => DashboardController::ID_CONTROLLER));
            $droitModel->droits = $droit;
            $droitModel->save();

            // Droits sur EntrepriseController
            $droit = 0;
            $droit += isset($_POST['EntrepriseView']) ? EntrepriseController::ACTION_VIEW : 0;
            $droit += isset($_POST['EntrepriseAdmin']) ? EntrepriseController::ACTION_ADMIN : 0;
            $droit += isset($_POST['EntrepriseCreate']) ? EntrepriseController::ACTION_CREATE : 0;
            $droit += isset($_POST['EntrepriseUpdate']) ? EntrepriseController::ACTION_UPDATE : 0;
            $droit += isset($_POST['EntrepriseDelete']) ? EntrepriseController::ACTION_DELETE : 0;
            $droitModel = Droit::model()->findByAttributes(array('fk_user' => $model->id_user, 'fk_controleur' => EntrepriseController::ID_CONTROLLER));
            $droitModel->droits = $droit;
            $droitModel->save();

            // Droits sur LocataireController
            $droit = 0;
            $droit += isset($_POST['LocataireView']) ? LocataireController::ACTION_VIEW : 0;
            $droit += isset($_POST['LocataireAdmin']) ? LocataireController::ACTION_ADMIN : 0;
            $droit += isset($_POST['LocataireCreate']) ? LocataireController::ACTION_CREATE : 0;
            $droit += isset($_POST['LocataireUpdate']) ? LocataireController::ACTION_UPDATE : 0;
            $droit += isset($_POST['LocataireDelete']) ? LocataireController::ACTION_DELETE : 0;
            $droitModel = Droit::model()->findByAttributes(array('fk_user' => $model->id_user, 'fk_controleur' => LocataireController::ID_CONTROLLER));
            $droitModel->droits = $droit;
            $droitModel->save();

            // Droits sur TicketController
            $droit = 0;
            $droit += isset($_POST['TicketView']) ? TicketController::ACTION_VIEW : 0;
            $droit += isset($_POST['TicketAdmin']) ? TicketController::ACTION_ADMIN : 0;
            $droit += isset($_POST['TicketCreate']) ? TicketController::ACTION_CREATE : 0;
            $droit += isset($_POST['TicketUpdate']) ? TicketController::ACTION_UPDATE : 0;
            $droit += isset($_POST['TicketDelete']) ? TicketController::ACTION_DELETE : 0;
            $droitModel = Droit::model()->findByAttributes(array('fk_user' => $model->id_user, 'fk_controleur' => TicketController::ID_CONTROLLER));
            $droitModel->droits = $droit;
            $droitModel->save();

            // Droits sur UserController
            $droit = 0;
            $droit += isset($_POST['UserView']) ? UserController::ACTION_VIEW : 0;
            $droit += isset($_POST['UserAdmin']) ? UserController::ACTION_ADMIN : 0;
            $droit += isset($_POST['UserCreate']) ? UserController::ACTION_CREATE : 0;
            $droit += isset($_POST['UserUpdate']) ? UserController::ACTION_UPDATE : 0;
            $droit += isset($_POST['UserDelete']) ? UserController::ACTION_DELETE : 0;
            $droitModel = Droit::model()->findByAttributes(array('fk_user' => $model->id_user, 'fk_controleur' => UserController::ID_CONTROLLER));
            $droitModel->droits = $droit;
            $droitModel->save();

            $this->redirect(array('user/view', 'id' => $model->id_user));
        }

        $this->render('update', array('model' => $model));
    }

}
