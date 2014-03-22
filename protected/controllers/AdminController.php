<?php

class AdminController extends Controller {

    const ID_CONTROLLER = 1;
    const ACTION_INDEX = 1;
    const ACTION_DROIT = 2;

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
            
            // On récupère d'abord le user et ses droits de la session
            $logged = Yii::app()->session['Logged'];
            $rights = Yii::app()->session['Rights']->getAdmin();
            
            $allow = array('noright');
                // On initialise ensuite l'array qui stockera les droits
                // On lui met une action inexistante car la méthode accessRules
                // considère qu'un array vide c'est avoir tous les droits
            
            Yii::trace(decbin($rights),'cron');
            
            // Et enfin on teste chaque droit un à un, et si le droit est bien accordé,
            // on le rajoute à l'array qui sera envoyé dans le return
            if ($rights & self::ACTION_INDEX){
                array_push($allow, 'index');
                Yii::trace('index ok','cron');
            }
            if ($rights & self::ACTION_DROIT){
                array_push($allow, 'droit');
                Yii::trace('droit ok','cron');
            }
            
            
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
    
    
    
    public function actionDroit($id) {
        Yii::trace('actionDroit','cron');
        $model = User::model()->findByPk($id);
        Yii::trace('actionDroit après find','cron');
//        if (isset($_POST['Batiment'])) {
//            
//            $this->redirect(array('user/view', 'id' => $model->id_user));
//        }
        
        $this->render('droit', array('model' => $model));
        Yii::trace('actionDroit après render','cron');
    }

}
