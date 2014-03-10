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
//----------------------------------------------------------------------------------------
//-------------------------------------Locataire------------------------------------------
//----------------------------------------------------------------------------------------

        try {
            if (($record = Locataire::model()->findByAttributes(array('email' => $this->username))) !== null) { //recupération d'un record en fonction de l'email
                if ($record->password !== md5($this->password)) {// si le mot de passe est différent du mot de passe de la db en md5
                    Yii::app()->user->setFlash('error', '<strong>Le mot de passe ou le nom d\'utilisateur est incorrect.!</strong>');
                    $this->errorCode = self::ERROR_PASSWORD_INVALID; // code error est password error
                } else {
                    if (!$record->is_logged) {
                        $record['is_logged'] = 1;      //on indique que la personne est loggé plus authentification possible sans un logout
                        $record->save(); // mise a jour dans la db de is_logged = 1
                        $this->_id = $record->id_locataire;    //recupération  de l'id du locataire
                        $this->errorCode = self::ERROR_NONE;   // aucune erreur
                        Yii::app()->session['Utilisateur'] = 'Locataire'; // création d'une variable de session pour stocker le type d'user
                        $record->password = ''; // vidage du mot de passe 
                        Yii::app()->session['Logged'] = $record; // enregistrement du record dans la session
                        $this->getLanguage($record);
                    } else {
                        Yii::app()->user->setFlash('error', '<strong>Vous êtes déjà connecté !</strong>'); // message en cas de connexion simultanée
                    }
                }

                return !$this->errorCode; // return le code d'erreur

//----------------------------------------------------------------------------------------
//---------------------------------------User---------------------------------------------
//----------------------------------------------------------------------------------------
            } elseif (($record = User::model()->findByAttributes(array('email' => $this->username))) !== NULL) {  //recuperation d'un record User
                if ($record->password !== md5($this->password)) {
                    Yii::app()->user->setFlash('error', '<strong>Le mot de passe ou le nom d\'utilisateur est incorrect.!</strong>');
                    $this->errorCode = self::ERROR_PASSWORD_INVALID;
                }// si le mot de passe est différent du mot de passe de la db en md5
                else {
                    if (!$record->is_logged) {
                        $record['is_logged'] = 1; //on indique que la personne est loggé plus authentification possible sans un logout
                        $record->save(); //mise a jour dans la db de is_logged = 1
                        $this->_id = $record->id_user; //recupération  de l'id du user
                        $this->errorCode = self::ERROR_NONE; // aucune erreur
                        Yii::app()->session['Utilisateur'] = 'User'; // création d'une variable de session pour stocker le type d'user
                        $record->password = ''; // vidage du mot de passe 
                        Yii::app()->session['Logged'] = $record; // enregistrement du record dans la session 
                        $this->getLanguage($record);
                    } else {
                        Yii::app()->user->setFlash('error', '<strong>Vous êtes déjà connecté !</strong>'); // message en cas de connexion simultanée
                    }
                }
                return !$this->errorCode; // return le code d'erreur
            }
            Yii::app()->session['Language'] = 'en'; //langue par défaut 
            return !self::ERROR_UNKNOWN_IDENTITY; //return utilisateur inconnu
        } catch (CDbException $ex) {
            Yii::app()->user->setFlash('error', '<strong>La base de donnnée est indisponible pour le moment</strong>'); // message d'erreur lors de db indisponible
        }
    }

//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------

    public function getId() {
        return $this->_id; // recupere l'id
    }

//----------------------------------------------------------------------------------------
//--------------------------------------Langue--------------------------------------------
//----------------------------------------------------------------------------------------

    public function getLanguage($record) {
//----------------------------------------------------------------------------------------
//------------Recupere la langue pour l'application une fois la personne authentifié------
//----------------------------------------------------------------------------------------

        if ($record->fk_langue == Constantes::LANGUE_FR) {
            Yii::app()->session['_lang'] = 'fr';
        } elseif ($record->fk_langue == Constantes::LANGUE_EN) {
            Yii::app()->session['_lang'] = 'en';
        } else {
            Yii::app()->session['_lang'] = 'nl';
        }
    }

//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
}
