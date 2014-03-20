<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    private $_id;

    public function authenticate() {
        try {
            if (($record = Locataire::model()->findByAttributes(array('email' => $this->username))) !== null) { //recupération d'un record en fonction de l'email
                if ($record->password !== md5($this->password)) {// si le mot de passe est différent du mot de passe de la db en md5
                    Yii::app()->user->setFlash('error', '<strong>Le mot de passe ou le nom d\'utilisateur est incorrect.!</strong>');
                    $this->errorCode = self::ERROR_PASSWORD_INVALID; // code error est password error
                } else {
                    //--------------Traitement de la session unique-------------
                    if (($Session = Session::model()->findByAttributes(array('email' => $record->email))) != NULL) { // rechere du record dans la table w3sys_Session par l'email de l'utilisateur
                        $yiisession = Yiisession::model()->findByPk($Session->fk_yiisession); //on recupere le record de sa session dans la table yiisession
                        $yiisession->delete(); // on supprime sa ligne /!\ la suppression de cette ligne supprime la ligne correspondante dans la table w3sys_Session delete on cascade
                    }
                    $Session = new Session(); //on crée un nouveau record dans la table w3sys_session
                    $Session->email = $record->email; // on y m'est l'email du locataire
                    $Session->fk_yiisession = Yii::app()->session->sessionID; //on lie la table W3sys_session avec la table yiisession 
                    $Session->save(); // on enregistre le record
                    //-----------Fin de traitement de session unique------------

                    $this->_id = $record->id_locataire;    //recupération  de l'id du locataire
                    $this->errorCode = self::ERROR_NONE;   // aucune erreur
                    Yii::app()->session['Utilisateur'] = 'Locataire'; // création d'une variable de session pour stocker le type d'user
                    $record->password = ''; // vidage du mot de passe 
                    Yii::app()->session['Logged'] = $record; // enregistrement du record dans la session
                    $this->getLanguage($record);
                    Yii::app()->user->setFlash('success', '<strong>Bienvenue: ' . $record->nom . ' !</strong>'); // message en cas de connexion simultanée
                }

                return !$this->errorCode; // return le code d'erreur
            } elseif (($record = User::model()->findByAttributes(array('email' => $this->username))) !== NULL) {  //recuperation d'un record User
                if ($record->password !== md5($this->password)) {
                    Yii::app()->user->setFlash('error', '<strong>Le mot de passe ou le nom d\'utilisateur est incorrect.!</strong>');
                    $this->errorCode = self::ERROR_PASSWORD_INVALID;
                }// si le mot de passe est différent du mot de passe de la db en md5
                else {
                    //--------------Traitement de la session unique-------------
                    if (($Session = Session::model()->findByAttributes(array('email' => $record->email))) != NULL) {// rechere du record dans la table w3sys_Session par l'email de l'utilisateur
                        $yiisession = Yiisession::model()->findByPk($Session->fk_yiisession); //on recupere le record de sa session dans la table yiisession
                        $yiisession->delete(); // on supprime sa ligne /!\ la suppression de cette ligne supprime la ligne correspondante dans la table w3sys_Session delete on cascade
                    }
                    $Session = new Session(); //on crée un nouveau record dans la table w3sys_session
                    $Session->email = $record->email; // on y m'est l'email du locataire
                    $Session->fk_yiisession = Yii::app()->session->sessionID; //on lie la table W3sys_session avec la table yiisession 
                    $Session->save(); // on enregistre le record
                    //--------------------Fin de session unique-----------------
                    
                    $this->setDroits($record->id_user); // Va rechercher et mettre les droits de ce user en session
                    $this->_id = $record->id_user; //recupération  de l'id du user
                    $this->errorCode = self::ERROR_NONE; // aucune erreur
                    Yii::app()->session['Utilisateur'] = 'User'; // création d'une variable de session pour stocker le type d'user
                    $record->password = ''; // vidage du mot de passe 
                    Yii::app()->session['Logged'] = $record; // enregistrement du record dans la session 
                    $this->getLanguage($record);
                    Yii::app()->user->setFlash('success', '<strong>Bienvenue: ' . $record->nom . ' !</strong>'); // message en cas de connexion simultanée
                }
                return !$this->errorCode; // return le code d'erreur
            }
            Yii::app()->session['Language'] = 'en'; //langue par défaut 
            return !self::ERROR_UNKNOWN_IDENTITY; //return utilisateur inconnu
        } catch (CDbException $ex) {
            Yii::app()->user->setFlash('error', '<strong>La base de donnnée est indisponible pour le moment: ' . $ex->getMessage() . '</strong>'); // message d'erreur lors de db indisponible
        }
    }


    public function getId() {
        return $this->_id; // recupere l'id
    }


    public function getLanguage($record) {
//-----Recupere la langue pour l'application une fois la personne authentifié---

        if ($record->fk_langue == Constantes::LANGUE_FR) {
            Yii::app()->session['_lang'] = 'fr';
        } elseif ($record->fk_langue == Constantes::LANGUE_EN) {
            Yii::app()->session['_lang'] = 'en';
        } else {
            Yii::app()->session['_lang'] = 'nl';
        }
    }
    
    
    /*
     * Cette méthode sert à retrouver les droits de l'utilisateur qui se log.
     * Elle est appelée à partir de la méthode 'authenticate' plus haut.
     * Cette méthode reçoit donc en paramètre l'id de la personne qui se log et
     * instancie un objet 'Rights'. On stocke dans cet objet tous les droits que
     * ce user à sur tous les controleurs en faisant la recherche dans la DB
     * des droits selon le user et le controleur.
     * Une fois cela fait, on met l'objet 'Rights' en variable de session pour
     * pouvoir être utilisé par les méthodes 'accessRules' des controleurs
     * (pour détails, voir classe 'Rights' elle-même et les méthodes
     * 'accessRules()' dans les controleurs)
     */
    public function setDroits($id) {
        $rights = new Rights();
        
        $rights->setAdmin(Droit::model()->findByAttributes(
                array('fk_controleur' => AdminController::ID_CONTROLLER, 'fk_user' => $id))->droits);
        $rights->setBatiment(Droit::model()->findByAttributes(
                array('fk_controleur' => BatimentController::ID_CONTROLLER, 'fk_user' => $id))->droits);
        $rights->setCategorie(Droit::model()->findByAttributes(
                array('fk_controleur' => CategorieIncidentController::ID_CONTROLLER, 'fk_user' => $id))->droits);
        $rights->setDashboard(Droit::model()->findByAttributes(
                array('fk_controleur' => DashboardController::ID_CONTROLLER, 'fk_user' => $id))->droits);
        $rights->setEntreprise(Droit::model()->findByAttributes(
                array('fk_controleur' => EntrepriseController::ID_CONTROLLER, 'fk_user' => $id))->droits);
        $rights->setLieu(Droit::model()->findByAttributes(
                array('fk_controleur' => LieuController::ID_CONTROLLER, 'fk_user' => $id))->droits);
        $rights->setLocataire(Droit::model()->findByAttributes(
                array('fk_controleur' => LocataireController::ID_CONTROLLER, 'fk_user' => $id))->droits);
        $rights->setTicket(Droit::model()->findByAttributes(
                array('fk_controleur' => TicketController::ID_CONTROLLER, 'fk_user' => $id))->droits);
        $rights->setTrad(Droit::model()->findByAttributes(
                array('fk_controleur' => TradController::ID_CONTROLLER, 'fk_user' => $id))->droits);
        $rights->setUser(Droit::model()->findByAttributes(
                array('fk_controleur' => UserController::ID_CONTROLLER, 'fk_user' => $id))->droits);
        
        Yii::app()->session['Rights'] = $rights;
    }
    
}