<?php

class AdminController extends Controller {

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
        if ((Yii::app()->session['Utilisateur'] == 'User') && (Yii::app()->session['Logged']->fk_fonction == 2)) {
            // Si 'User' et fonction à 2, alors c'est un admin
            return array( // L'admin à tous les droits
                array('allow', // 'allow' veut dire que l'utilisateur a droit à ce qui suit.
                    'actions' => array('*'),
                    'users' => array('*'),
                    // Droits accordés à tout le monde, mais comme il faut être admin pour arriver là alors il n'y a que les admins qui ont ces droits-là
                ),
            );
        } else {
            // Si ['Locataire'] ou ['User' et fonction à 1], alors l'utilisateur n'a aucun droit
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
     * Lists all models.
     */
    public function actionIndex() {
        $this->redirect('trdt');
    }
}