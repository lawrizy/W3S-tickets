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
                if ($record->password !== md5($this->password)) // si le mot de passe est différent du mot de passe de la db en md5
                    $this->errorCode = self::ERROR_PASSWORD_INVALID; // code error est password error
                else {
                    $this->_id = $record->id_locataire;    //recupération  de l'id du locataire
                    $this->errorCode = self::ERROR_NONE;   // aucune erreur
                    Yii::app()->session['Utilisateur'] = 'Locataire'; // création d'une variable de session pour stocker le type d'user
                    $record->password = ''; // vidage du mot de passe 
                    Yii::app()->session['Logged'] = $record; // enregistrement du record dans la session
                    $this->getLanguage($record);
                }
                return !$this->errorCode; // return le code d'erreur
            } elseif (($record = User::model()->findByAttributes(array('email' => $this->username))) !== NULL) {  //recuperation d'un record User
                if ($record->password !== md5($this->password)) // si le mot de passe est différent du mot de passe de la db en md5
                    $this->errorCode = self::ERROR_PASSWORD_INVALID; // code error est password error
                else {
                    $this->_id = $record->id_user; //recupération  de l'id du user
                    $this->errorCode = self::ERROR_NONE; // aucune erreur
                    Yii::app()->session['Utilisateur'] = 'User'; // création d'une variable de session pour stocker le type d'user
                    $record->password = ''; // vidage du mot de passe 
                    Yii::app()->session['Logged'] = $record; // enregistrement du record dans la session 
                    $this->getLanguage($record);
                }
                return !$this->errorCode; // return le code d'erreur
            }
            Yii::app()->session['Language'] = 'EN';
            return self::ERROR_UNKNOWN_IDENTITY; //return utilisateur inconnu
        } catch (CDbException $ex) {
            Yii::app()->session['erreurDB'] = 'La base de donnnée est indisponible pour le moment'; // message d'erreur lors de db i
        }
    }

    public function getId() {
        return $this->_id; // recupere l'id
    }

    public function getLanguage($record) {
        if ($record->fk_langue == 1) {
            Yii::app()->session['Language'] = 'FR';
        } elseif ($record->fk_langue == 2) {
            Yii::app()->session['Language'] = 'EN';
        } else {
            Yii::app()->session['Language'] = 'NL';
        }
    }

}
