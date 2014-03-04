<?php

class AdminController extends Controller {

    /**
     * La fonction permettant d'accorder des droits aux différents utilisateurs.
     * Quand la méthode est appellée, on vérifie le type de l'utilisateur,
     * et en fonction de cela, les droits accordés peuvent varient.
     */
    public function accessRules() {
        if ((Yii::app()->session['Utilisateur'] == 'User') && (Yii::app()->session['Logged']->fk_fonction == Fonction::ID_ADMIN)) {
            // Si ['User'] et [fonction = id_admin], alors c'est un admin
            return array(
                array('allow', // 'allow' veut dire que l'utilisateur a droit à ce qui suit.
                    'actions' => array('*'), // L'admin à tous les droits
                    'users' => array('*'),
                // Tous les droits accordés à tout le monde, mais comme il faut être admin 
                // pour arriver là alors il n'y a que les admins qui ont ces droits-là
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
     * Méthode permettant d'afficher la page d'administration
     */
    public function actionIndex() {
        $this->render('index');
    }

}