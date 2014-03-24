<?php

class AdminController extends Controller {
    /*
     * Les constantes suivantes correspondent aux actions. Il y a une constante
     * pour chaque action de ce contrôleur. Ces constantes serviront à attribuer
     * ou non des droits aux utilisateurs (voir la méthode 'accessRules()' de 
     * ce même contrôleur)
     */

    const ID_CONTROLLER = 1;
    const ACTION_INDEX = 1;
    const ACTION_UPDATE = 2;

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
     * ce controleur et génère les arrays 'allow' (permis) et 'deny' (refusé)
     * selon ces droits-là.
     */
    public function accessRules() { // droit des utilisateur sur les actions
        if (!Yii::app()->user->isGuest) { // Génération des droits selon le user
            // On récupère d'abord le user de la session
            $logged = Yii::app()->session['Logged'];
            // ainsi que ses droits sur ce contrôleur
            $rights = Yii::app()->session['Rights']->getAdmin();
            // La méthode getAdmin() demande à ne récupérer que les droits
            // lié à ce contrôleur-ci (en l'occurence, admin)

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
            // Ces nombres-là sont les valeurs des constantes tout en haut de la classe.
            // Nous avons volontairement choisi des nombres binaires (1, 2, 4, 8, ...) pour que
            // chaque nombre n'ait qu'un seul bit à '1' et n'accorde donc qu'un seul droit
            if ($rights & self::ACTION_INDEX)
                array_push($allow, 'index');
            if ($rights & self::ACTION_UPDATE)
                array_push($allow, 'update');

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
        $model = User::model()->findByPk($id);
        if (isset($_POST['idPost'])) {
            $model = User::model()->findByPk($_POST['idPost']);
        }
        $DroitModel = Droit::model()->findByAttributes(array('fk_user' => $model->id_user, 'fk_controleur' => AdminController::ID_CONTROLLER));
        if (isset($_POST['tmp'])) {
            /*
             *
             */
            $rights = new Rights();

            // Droits sur AdminController
            $droit = 0;
            $droit += isset($_POST['Admin'][0]) ? AdminController::ACTION_INDEX : 0;
             Yii::trace($droit, 'cron');
            // Yii::trace(AdminController::ACTION_UPDATE, 'cron');
            $droit += isset($_POST['Admin'][1]) ? AdminController::ACTION_UPDATE : 0;
            $DroitModel = Droit::model()->findByAttributes(array('fk_user' => $model->id_user, 'fk_controleur' => AdminController::ID_CONTROLLER));
            $DroitModel->droits = $droit;
            $DroitModel->save();

            Yii::trace($droit, 'cron');
            // Droits sur BatimentController
            $droit = 0;
            $droit += isset($_POST['Batiment'][0]) ? BatimentController::ACTION_VIEW : 0;
            $droit += isset($_POST['Batiment'][1]) ? BatimentController::ACTION_ADMIN : 0;
            $droit += isset($_POST['Batiment'][2]) ? BatimentController::ACTION_CREATE : 0;
            $droit += isset($_POST['Batiment'][3]) ? BatimentController::ACTION_UPDATE : 0;
            $droit += isset($_POST['Batiment'][4]) ? BatimentController::ACTION_DELETE : 0;
            $rights->setBatiment($droit);
            $DroitModel = Droit::model()->findByAttributes(array('fk_user' => $model->id_user, 'fk_controleur' => BatimentController::ID_CONTROLLER));
            $DroitModel->droits = $droit;
            $DroitModel->save();
//             Droits sur CategorieIncidentController
            $droit = 0;
            $droit += isset($_POST['Category'][0]) ? CategorieIncidentController::ACTION_VIEW : 0;
            $droit += isset($_POST['Category'][1]) ? CategorieIncidentController::ACTION_ADMIN : 0;
            $droit += isset($_POST['Category'][2]) ?
                    CategorieIncidentController::ACTION_CREATECAT + CategorieIncidentController::ACTION_CREATESOUSCAT : 0;
            $droit += isset($_POST['Category'][3]) ?
                    CategorieIncidentController::ACTION_UPDATECAT + CategorieIncidentController::ACTION_UPDATESOUSCAT : 0;
            $droit += isset($_POST['Category'][4]) ? CategorieIncidentController::ACTION_DELETE : 0;
            $DroitModel = Droit::model()->findByAttributes(array('fk_user' => $model->id_user, 'fk_controleur' => CategorieIncidentController::ID_CONTROLLER));
            $DroitModel->droits = $droit;
            $DroitModel->save();
            $rights->setCategorie($droit);

            // Droits sur DashboardController
            $droit = 0;
            $droit += isset($_POST['DashBoard'][0]) ? DashboardController::ACTION_VUE : 0;
            $DroitModel = Droit::model()->findByAttributes(array('fk_user' => $model->id_user, 'fk_controleur' => DashboardController::ID_CONTROLLER));
            $DroitModel->droits = $droit;
            $DroitModel->save();
            $rights->setDashboard($droit);

            // Droits sur EntrepriseController
            $droit = 0;
            $droit += isset($_POST['Entreprise'][0]) ? EntrepriseController::ACTION_VIEW : 0;
            $droit += isset($_POST['Entreprise'][1]) ? EntrepriseController::ACTION_ADMIN : 0;
            $droit += isset($_POST['Entreprise'][2]) ? EntrepriseController::ACTION_CREATE : 0;
            $droit += isset($_POST['Entreprise'][3]) ? EntrepriseController::ACTION_UPDATE : 0;
            $droit += isset($_POST['Entreprise'][4]) ? EntrepriseController::ACTION_DELETE : 0;
            $droit += isset($_POST['Entreprise'][5]) ? EntrepriseController::ACTION_SECTEUR : 0;
            $DroitModel = Droit::model()->findByAttributes(array('fk_user' => $model->id_user, 'fk_controleur' => EntrepriseController::ID_CONTROLLER));
            $DroitModel->droits = $droit;
            $DroitModel->save();
            $rights->setEntreprise($droit);

            // Droits sur LieuController
            $droit = 0;
            $droit += isset($_POST['Lieu']) ? LieuController::ACTION_VIEW : 0;
            $DroitModel = Droit::model()->findByAttributes(array('fk_user' => $model->id_user, 'fk_controleur' => LieuController::ID_CONTROLLER));
            $DroitModel->droits = $droit;
            $DroitModel->save();
            $rights->setLieu($droit);

            // Droits sur LocataireController
            $droit = 0;
            $droit += isset($_POST['Locataire'][0]) ? LocataireController::ACTION_VIEW : 0;
            $droit += isset($_POST['Locataire'][1]) ? LocataireController::ACTION_ADMIN : 0;
            $droit += isset($_POST['Locataire'][2]) ? LocataireController::ACTION_CREATE : 0;
            $droit += isset($_POST['Locataire'][3]) ? LocataireController::ACTION_UPDATE + LocataireController::ACTION_ADDLIEU + LocataireController::ACTION_DELETELIEU : 0;
            $droit += isset($_POST['Locataire'][4]) ? LocataireController::ACTION_DELETE : 0;
            $DroitModel = Droit::model()->findByAttributes(array('fk_user' => $model->id_user, 'fk_controleur' => LocataireController::ID_CONTROLLER));
            $DroitModel->droits = $droit;
            $DroitModel->save();
            $rights->setLocataire($droit);

            // Droits sur TicketController
            $droit = 0;
            $droit += isset($_POST['Ticket'][0]) ? TicketController::ACTION_VIEW : 0;
            $droit += isset($_POST['Ticket'][1]) ? TicketController::ACTION_ADMIN : 0;
            $droit += isset($_POST['Ticket'][2]) ? TicketController::ACTION_CREATE + TicketController::ACTION_GETSOUSCATEGORIESDYNAMIQUES + TicketController::ACTION_SENDNOTIFICATIONMAIL : 0;
            $droit += isset($_POST['Ticket'][3]) ? TicketController::ACTION_UPDATE : 0;
            $droit += isset($_POST['Ticket'][4]) ? TicketController::ACTION_DELETE : 0;
            $droit += isset($_POST['Ticket'][5]) ? TicketController::ACTION_TRAITEMENT + TicketController::ACTION_CLOSE : 0;
            $DroitModel = Droit::model()->findByAttributes(array('fk_user' => $model->id_user, 'fk_controleur' => TicketController::ID_CONTROLLER));
            $DroitModel->droits = $droit;
            $DroitModel->save();
            $rights->setTicket($droit);

            // Droits sur TradController
            $droit = 0;
            $droit += isset($_POST['Trad']) ? TradController::ACTION_UPDATE + TradController::ACTION_INDEX + TradController::ACTION_ADDTRADUCTION + TradController::ACTION_MODIFYTRADUCTION : 0;
            $DroitModel = Droit::model()->findByAttributes(array('fk_user' => $model->id_user, 'fk_controleur' => TradController::ID_CONTROLLER));
            $DroitModel->droits = $droit;
            $DroitModel->save();
            $rights->setTrad($droit);

            // Droits sur UserController
            $droit = 0;
            $droit += isset($_POST['User'][0]) ? UserController::ACTION_VIEW : 0;
            $droit += isset($_POST['User'][1]) ? UserController::ACTION_ADMIN : 0;
            $droit += isset($_POST['User'][2]) ? UserController::ACTION_CREATE : 0;
            $droit += isset($_POST['User'][3]) ? UserController::ACTION_UPDATE : 0;
            $droit += isset($_POST['User'][4]) ? UserController::ACTION_DELETE : 0;
            $DroitModel = Droit::model()->findByAttributes(array('fk_user' => $model->id_user, 'fk_controleur' => UserController::ID_CONTROLLER));
            $DroitModel->droits = $droit;
            $DroitModel->save();
            $rights->setUser($droit);
            //*/
            Yii::app()->session['Rights'] = UserIdentity::setDroits($model->id_user);
            $this->redirect(array('user/view', 'id' => $model->id_user));
        }

        $this->render('update', array('model' => $model));
    }

}
