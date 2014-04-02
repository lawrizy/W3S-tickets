<?php



/*
 * Pour vérifier le WSDL (le fichier XML) de ce webservice, voir l'URL
 * http://localhost/W3S-tickets/index.php/android/websys
 * 
 * Les méthodes ne sont pas encore utilisables
 */
class AndroidController extends Controller {
    
    
    
    /*
     * Les codes erreurs possibles lorsque le webService est appelé
     */
    const ERROR_DB_INACCESSIBLE = 0;
    const ERROR_USER_INEXISTANT = 1;
    const ERROR_USER_OK = 2;

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('websys'),
                'users' => array('*'),
            ),
            array('deny',
                'users' => array('?'),
                'message' => 'Vous n\'avez pas accès à cette page.'
            ),
        );
    }
    
    public function actions() {
        return array(
            'websys' => array(
                'class' => 'CWebServiceAction',
            ),
        );
    }

    /**
     * @param string $email Email de l'utilisateur
     * @param string $password Mot de passe de l'utilisateur
     * @return int $error un code erreur
     * @soap
     */
    public function testLogin($email, $password) {
        $error = self::ERROR_USER_INEXISTANT;
        try {
            $user = User::model()->findByAttributes(array('email' => $email, 'password' => md5($password)));
            if ($user !== null)
                $error = self::ERROR_USER_OK;
        } catch (CDbException $ex){
            $error = self::ERROR_DB_INACCESSIBLE;
        }
        return $error;
    }
    
    /**
     * @return CategorieIncident[] Liste des catégories parents
     * @soap
     */
    public function getCategorie() {
        $cats = CategorieIncident::model()->findAllByAttributes(
                array('visible' => Constantes::VISIBLE, 'fk_parent' => NULL));
        
        // ????
        return $cats;
    }
    
    /**
     * @param int $parent Id de la catégorie-parent
     * @return CategorieIncident[] Liste des sous-catégories concernées
     * @soap
     */
    public function getSousCategorie($parent) {
        $sousCats = CategorieIncident::model()->findAllByAttributes(
                array('visible' => Constantes::VISIBLE, 'fk_parent' => $parent));
        
        // ????
        return $sousCats;
    }
    
    /**
     * @param int $user Id du locataire
     * @return Batiment[] Liste des bâtiments de ce locataire
     * @soap
     */
    public function getBatiment($user) {
        $bats = Batiment::model()->findBySql(""
                . "SELECT * "
                . "FROM w3sys_batiment as b "
                . "WHERE b.id_batiment IN "
                    . "(SELECT fk_batiment FROM w3sys_lieu as l "
                    . "WHERE l.fk_locataire =". $user ." AND visible = ". Constantes::VISIBLE .")");
        
        // ????
        return $bats;
    }

}
