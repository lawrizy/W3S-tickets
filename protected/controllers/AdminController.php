<?php

class AdminController extends Controller {

    /**
     * La fonction permettant d'accorder des droits aux différents utilisateurs.
     * Quand la méthode est appellée, on vérifie le type de l'utilisateur,
     * et en fonction de cela, les droits accordés peuvent varient.
     */
    public function accessRules() {
        if ((Yii::app()->session['Utilisateur'] == 'User') && (Yii::app()->session['Logged']->fk_fonction == Constantes::ID_ROOT)) {
            // Si ['User'] et [fonction = id_root]
            return array(
                array('allow', // 'allow' veut dire que l'utilisateur a droit à ce qui suit.
                    'actions' => array('*'), // Le root à tous les droits
                    'users' => array('*'),
                // Tous les droits accordés à tout le monde, mais comme il faut être root
                // pour arriver là alors il n'y a que le root qui a ces droits-là
                ),
            );
        } else {
            // Si ['Locataire'] ou [['User'] et [fonction = id_user ou id_admin]], alors l'utilisateur n'a aucun droit
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
     * Méthode permettant d'afficher la page d'administration
     */
    public function actionIndex() {
        $this->render('index');
    }

}