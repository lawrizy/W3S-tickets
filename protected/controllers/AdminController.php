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
        if (Yii::app()->session['Utilisateur'] == 'Locataire') { // Locataire a des droits fixes
            return array(
                array('deny', // refuse autre users
                    'users' => array('@'), //tous utilisateur
                    'message' => 'Vous n\'avez pas accès à cette page.'
                ),
            );
        } elseif (Yii::app()->session['Utilisateur'] == 'User') { // Génération des droits selon le user
            
            // On récupère d'abord le user et ses droits de la session
            $logged = Yii::app()->session['Logged'];
            $rights = Yii::app()->session['Rights']->getAdmin();
            // On initialise ensuite les array qui stockeront les droits
            $allow = array();
            
            // Et enfin on teste chaque droit un à un, et si le droit est bien accordé,
            // on le rajoute à l'array qui sera envoyé dans le return
            if ($rights & self::ACTION_INDEX) array_push($allow, 'index');
            if ($rights & self::ACTION_DROIT) array_push ($allow, 'droit');
            
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
        $model = User::model()->findByPk($id);
        
        
    }

}
