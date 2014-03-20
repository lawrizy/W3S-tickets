<?php

class AdminController extends Controller {

    Const ID_CONTROLLER = 1;
    const ACTION_INDEX = 1;

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
    public function accessRules() {

        $logged = Yii::app()->session['Logged'];
        if ((Yii::app()->session['Utilisateur'] == 'User') && ($logged->fk_fonction == Constantes::FONCTION_ROOT)) {
            // Si ['User'] et [fonction = id_root]
            return array(
                array('allow', // 'allow' veut dire que l'utilisateur a droit à ce qui suit.
                    'actions' => array('index'), // Le root à tous les droits
                    'users' => array('@'),
                // Tous les droits accordés à tout le monde, mais comme il faut être root
                // pour arriver là alors il n'y a que le root qui a ces droits-là
                ),
//                array('deny',
//                    'users' => array('?'),
//                )
            );
        } else {
            // Si ['Locataire'] ou [['User'] et [fonction = id_user ou id_admin]], alors l'utilisateur n'a aucun droit
            return array(
                array('deny', // 'deny' veut dire que l'on renie les droits à l'utilisateur
                    'actions' => array('index'),
                    'users' => array('?'),
                    // Aucun droit à tous ceux qui arrivent ici
                    'message' => 'Vous n\'avez pas accès à cette page.'
                // Message qu'affichera la page d'erreur
                ),
            );
        }
//        return array('deny',
//            'actions' => array('*'),
//            'users' => array('*'),
//            'message' => 'Vous n\'avez pas accès à cette page.');
    }

    public function actionIndex() {
        $this->render('index');
    }

}
