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
//TODO Transaction
        if (isset($_POST['idPost'])) {
            $model = User::model()->findByPk($_POST['idPost']);
        } else {
            $model = User::model()->findByPk($id);
        }
        $DroitModel = Droit::model()->findByAttributes(array('fk_user' => $model->id_user, 'fk_controleur' => AdminController::ID_CONTROLLER));
        if (isset($_POST['tmp'])) {
            /*
             *
             */
            $rights = new Rights();

            // Droits sur AdminController
            $droit = 0;

            $droit +=(int) isset($_POST['AdminIndex']) ? AdminController::ACTION_INDEX : 0;
            $droit +=(int) isset($_POST['AdminUpdate']) ? AdminController::ACTION_UPDATE : 0;
            $DroitModel = Droit::model()->findByAttributes(array('fk_user' => $model->id_user, 'fk_controleur' => AdminController::ID_CONTROLLER));
            $DroitModel->droits = $droit;
            $DroitModel->save();

            // Droits sur BatimentController
            $droit = 0;
            $droit += isset($_POST['BatimentView']) ? BatimentController::ACTION_VIEW : 0;
            $droit += isset($_POST['BatimentAdmin']) ? BatimentController::ACTION_ADMIN : 0;
            $droit += isset($_POST['BatimentCreate']) ? BatimentController::ACTION_CREATE : 0;
            $droit += isset($_POST['BatimentUpdate']) ? BatimentController::ACTION_UPDATE : 0;
            $droit += isset($_POST['BatimentDelete']) ? BatimentController::ACTION_DELETE : 0;
            $rights->setBatiment($droit);
            $DroitModel = Droit::model()->findByAttributes(array('fk_user' => $model->id_user, 'fk_controleur' => BatimentController::ID_CONTROLLER));
            $DroitModel->droits = $droit;
            $DroitModel->save();
//             Droits sur CategorieIncidentController
            $droit = 0;
            $droit += isset($_POST['CategoryView']) ? CategorieIncidentController::ACTION_VIEW : 0;
            $droit += isset($_POST['CategoryAdmin']) ? CategorieIncidentController::ACTION_ADMIN : 0;
            $droit += isset($_POST['CategoryCreateCat']) ?
                    CategorieIncidentController::ACTION_CREATECAT + CategorieIncidentController::ACTION_CREATESOUSCAT : 0;
            $droit += isset($_POST['CategoryUpdateCat']) ?
                    CategorieIncidentController::ACTION_UPDATECAT + CategorieIncidentController::ACTION_UPDATESOUSCAT : 0;
            $droit += isset($_POST['CategoryDelete']) ? CategorieIncidentController::ACTION_DELETE : 0;
            $DroitModel = Droit::model()->findByAttributes(array('fk_user' => $model->id_user, 'fk_controleur' => CategorieIncidentController::ID_CONTROLLER));
            $DroitModel->droits = $droit;
            $DroitModel->save();
            $rights->setCategorie($droit);

            // Droits sur DashboardController
            $droit = 0;
            $droit += isset($_POST['DashBoardVue']) ? DashboardController::ACTION_VUE + DashboardController::ACTION_FILTERBYBATIMENT + DashboardController::ACTION_GETCATEGORIESLABEL + DashboardController::ACTION_GETFREQUENCECALLEDBYENTREPRISE + DashboardController::ACTION_GETTICKETBYCATEGORIE + DashboardController::ACTION_GETTICKETBYCATEGORIEFORBATIMENTID + DashboardController::ACTION_GETTICKETBYSTATUSFORBATIMENTID : 0;
            $DroitModel = Droit::model()->findByAttributes(array('fk_user' => $model->id_user, 'fk_controleur' => DashboardController::ID_CONTROLLER));
            $DroitModel->droits = $droit;
            $DroitModel->save();
            $rights->setDashboard($droit);

            // Droits sur EntrepriseController
            $droit = 0;
            $droit += isset($_POST['EntrepriseView']) ? EntrepriseController::ACTION_VIEW : 0;
            $droit += isset($_POST['EntrepriseAdmin']) ? EntrepriseController::ACTION_ADMIN : 0;
            $droit += isset($_POST['EntrepriseCreate']) ? EntrepriseController::ACTION_CREATE : 0;
            $droit += isset($_POST['EntrepriseUpdate']) ? EntrepriseController::ACTION_UPDATE : 0;
            $droit += isset($_POST['EntrepriseDelete']) ? EntrepriseController::ACTION_DELETE : 0;
            $droit += isset($_POST['EntrepriseSecteur']) ? EntrepriseController::ACTION_SECTEUR : 0;
            $DroitModel = Droit::model()->findByAttributes(array('fk_user' => $model->id_user, 'fk_controleur' => EntrepriseController::ID_CONTROLLER));
            $DroitModel->droits = $droit;
            $DroitModel->save();
            $rights->setEntreprise($droit);

            // Droits sur LieuController
            $droit = 0;
            $droit += isset($_POST['LieuView']) ? LieuController::ACTION_VIEW : 0;
            $DroitModel = Droit::model()->findByAttributes(array('fk_user' => $model->id_user, 'fk_controleur' => LieuController::ID_CONTROLLER));
            $DroitModel->droits = $droit;
            $DroitModel->save();
            $rights->setLieu($droit);

            // Droits sur LocataireController
            $droit = 0;
            $droit += isset($_POST['LocataireView']) ? LocataireController::ACTION_VIEW : 0;
            $droit += isset($_POST['LocataireAdmin']) ? LocataireController::ACTION_ADMIN : 0;
            $droit += isset($_POST['LocataireCreate']) ? LocataireController::ACTION_CREATE : 0;
            $droit += isset($_POST['LocataireUpdate']) ? LocataireController::ACTION_UPDATE + LocataireController::ACTION_ADDLIEU + LocataireController::ACTION_DELETELIEU : 0;
            $droit += isset($_POST['LocataireDelete']) ? LocataireController::ACTION_DELETE : 0;
            $DroitModel = Droit::model()->findByAttributes(array('fk_user' => $model->id_user, 'fk_controleur' => LocataireController::ID_CONTROLLER));
            $DroitModel->droits = $droit;
            $DroitModel->save();
            $rights->setLocataire($droit);

            // Droits sur TicketController
            $droit = 0;
            $droit += isset($_POST['TicketView']) ? TicketController::ACTION_VIEW : 0;
            $droit += isset($_POST['TicketAdmin']) ? TicketController::ACTION_ADMIN : 0;
            $droit += isset($_POST['TicketCreate']) ? TicketController::ACTION_CREATE + TicketController::ACTION_GETSOUSCATEGORIESDYNAMIQUES + TicketController::ACTION_SENDNOTIFICATIONMAIL : 0;
            $droit += isset($_POST['TicketUpdate']) ? TicketController::ACTION_UPDATE : 0;
            $droit += isset($_POST['TicketDelete']) ? TicketController::ACTION_DELETE : 0;
            $droit += isset($_POST['TicketTraitement']) ? TicketController::ACTION_TRAITEMENT + TicketController::ACTION_CLOSE : 0;
            $DroitModel = Droit::model()->findByAttributes(array('fk_user' => $model->id_user, 'fk_controleur' => TicketController::ID_CONTROLLER));
            $DroitModel->droits = $droit;
            $DroitModel->save();
            $rights->setTicket($droit);

            // Droits sur TradController
            $droit = 0;
            $droit += isset($_POST['TradIndex']) ? TradController::ACTION_UPDATE + TradController::ACTION_INDEX + TradController::ACTION_ADDTRADUCTION + TradController::ACTION_MODIFYTRADUCTION : 0;
            $DroitModel = Droit::model()->findByAttributes(array('fk_user' => $model->id_user, 'fk_controleur' => TradController::ID_CONTROLLER));
            $DroitModel->droits = $droit;
            $DroitModel->save();
            $rights->setTrad($droit);

            // Droits sur UserController
            $droit = 0;
            $droit += isset($_POST['UserView']) ? UserController::ACTION_VIEW : 0;
            $droit += isset($_POST['UserAdmin']) ? UserController::ACTION_ADMIN : 0;
            $droit += isset($_POST['UserCreate']) ? UserController::ACTION_CREATE : 0;
            $droit += isset($_POST['UserUpdate']) ? UserController::ACTION_UPDATE : 0;
            $droit += isset($_POST['UserDelete']) ? UserController::ACTION_DELETE : 0;
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
