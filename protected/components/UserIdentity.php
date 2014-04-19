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
            if (($record = User::model()->findByAttributes(array('email' => $this->username))) !== NULL) {  //recuperation d'un record User
                if ($record->password !== md5($this->password)) {
                    Yii::app()->user->setFlash('error', '<strong>Le mot de passe ou le nom d\'utilisateur est incorrect.!</strong>');
                    $this->errorCode = self::ERROR_PASSWORD_INVALID;
                } else {// mot de passe correct
                    //--------------Traitement de la session unique-------------
                    if (($Session = Session::model()->findByAttributes(array('email' => $record->email))) != NULL) {
                        // recherche du record dans la table w3sys_Session par l'email de l'utilisateur
                        $Session->fkYiisession->delete();  // on supprime sa ligne /!\ la suppression de cette ligne supprime la ligne correspondante dans la table w3sys_Session delete on cascade
                    }
                    $Session = new Session(); //on crée un nouveau record dans la table w3sys_session
                    $Session->email = $record->email; // on y m'est l'email du locataire
                    $Session->fk_yiisession = Yii::app()->session->sessionID; //on lie la table W3sys_session avec la table yiisession 
                    $Session->save(); // on enregistre le record
                    //--------------------Fin de session unique-----------------


                    $this->_id = $record->id_user; //recupération  de l'id du user
                    $this->errorCode = self::ERROR_NONE; // aucune erreur
                    $record->password = ''; // vidage du mot de passe 
                    Yii::app()->session['Logged'] = $record; // enregistrement du record dans la session 
                    Yii::app()->session['Rights'] = RightsController::getDroits($record->id_user);
                        // Va rechercher et mettre les droits de ce user en session
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
}
