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
            if ($rights & self::ACTION_INDEX) array_push($allow, 'index');
            if ($rights & self::ACTION_UPDATE) array_push($allow, 'update');
            
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

    public function actionIndex() {
        $this->render('index');
    }
    
    
    
    public function actionUpdate($id) {
        Yii::trace('actionUpdate','cron');
        $model = User::model()->findByPk($id);
        Yii::trace('actionUpdate après find','cron');
        if (isset($_POST['tmp'])) {
            /*
            // Droits sur AdminController
            $right = 0;
            $right += isset($_POST['Admin[index]']) ? AdminController::ACTION_INDEX : 0 ;
            $right += isset($_POST['Admin[update]']) ? AdminController::ACTION_UPDATE : 0 ;
            // save dans DB
            
            $right = 0;
            $right += isset($_POST['Batiment[view]']) ? BatimentController::ACTION_VIEW : 0 ;
            $right += isset($_POST['Batiment[admin]']) ? BatimentController::ACTION_ADMIN : 0 ;
            $right += isset($_POST['Batiment[create]']) ? BatimentController::ACTION_CREATE : 0 ;
            $right += isset($_POST['Batiment[update]']) ? BatimentController::ACTION_UPDATE : 0 ;
            $right += isset($_POST['Batiment[delete]']) ? BatimentController::ACTION_DELETE : 0 ;
            // save dans DB
            
            $right = 0;
            $right += isset($_POST['Category[view]']) ? CategorieIncidentController::ACTION_VIEW : 0 ;
            $right += isset($_POST['Category[admin]']) ? CategorieIncidentController::ACTION_ADMIN : 0 ;
            $right += isset($_POST['Category[create]']) ? 
                    CategorieIncidentController::ACTION_CREATECAT 
                    + CategorieIncidentController::ACTION_CREATESOUSCAT : 0 ;
            $right += isset($_POST['Category[update]']) ? 
                    CategorieIncidentController::ACTION_UPDATECAT 
                    + CategorieIncidentController::ACTION_UPDATESOUSCAT : 0 ;
            $right += isset($_POST['Category[delete]']) ? CategorieIncidentController::ACTION_DELETE : 0 ;
            // save dans DB
            
            $right = 0;
            $right += isset($_POST['DashBoard[vue]']) ? DashboardController::ACTION_VUE : 0 ;
            // save dans DB
            
            $right = 0;
            $right += isset($_POST['Entreprise[view]']) ? EntrepriseController::ACTION_VIEW : 0 ;
            $right += isset($_POST['Entreprise[admin]']) ? EntrepriseController::ACTION_ADMIN : 0 ;
            $right += isset($_POST['Entreprise[create]']) ? EntrepriseController::ACTION_CREATE : 0 ;
            $right += isset($_POST['Entreprise[update]']) ? EntrepriseController::ACTION_UPDATE : 0 ;
            $right += isset($_POST['Entreprise[delete]']) ? EntrepriseController::ACTION_DELETE : 0 ;
            $right += isset($_POST['Entreprise[secteur]']) ? EntrepriseController::ACTION_SECTEUR : 0 ;
            // save dans DB
            
            $right = 0;
            $right += isset($_POST['Lieu[view]']) ? LieuController::ACTION_VIEW : 0 ;
            // save dans DB
            
            $right = 0;
            $right += isset($_POST['Locataire[view]']) ? LocataireController::ACTION_VIEW : 0 ;
            $right += isset($_POST['Locataire[admin]']) ? LocataireController::ACTION_ADMIN : 0 ;
            $right += isset($_POST['Locataire[create]']) ? LocataireController::ACTION_CREATE : 0 ;
            $right += isset($_POST['Locataire[update]']) ? LocataireController::ACTION_UPDATE 
                    + LocataireController::ACTION_ADDLIEU 
                    + LocataireController::ACTION_DELETELIEU : 0 ;
            $right += isset($_POST['Locataire[delete]']) ? LocataireController::ACTION_DELETE : 0 ;
            // save dans DB
            
            $right = 0;
            $right += isset($_POST['Ticket[view]']) ? TicketController::ACTION_VIEW : 0 ;
            $right += isset($_POST['Ticket[admin]']) ? TicketController::ACTION_ADMIN : 0 ;
            $right += isset($_POST['Ticket[create]']) ? TicketController::ACTION_CREATE : 0 ;
            $right += isset($_POST['Ticket[update]']) ? TicketController::ACTION_UPDATE : 0 ;
            $right += isset($_POST['Ticket[delete]']) ? TicketController::ACTION_DELETE : 0 ;
            $right += isset($_POST['Ticket[traitement]']) ? TicketController::ACTION_TRAITEMENT
                    + TicketController::ACTION_CLOSE : 0 ;
            // save dans DB
            
            $right = 0;
            $right += isset($_POST['Trad[index]']) ? TradController::ACTION_ : 0 ;
            // save dans DB
            
            $right = 0;
            $right += isset($_POST['User[view]']) ? UserController::ACTION_ : 0 ;
            $right += isset($_POST['User[admin]']) ? UserController::ACTION_ : 0 ;
            $right += isset($_POST['User[create]']) ? UserController::ACTION_ : 0 ;
            $right += isset($_POST['User[update]']) ? UserController::ACTION_ : 0 ;
            $right += isset($_POST['User[delete]']) ? UserController::ACTION_ : 0 ;
            // save dans DB
            */
            
            $this->redirect(array('user/view', 'id' => $model->id_user));
        }
        
        $this->render('update', array('model' => $model));
        Yii::trace('actionUpdate après render','cron');
    }

}
