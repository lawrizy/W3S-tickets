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
    private $_table;

    public function authenticate() {

        //   $record = Locataire::model()->findByAttributes(array('email' => $this->username));
        if (($record = Locataire::model()->findByAttributes(array('email' => $this->username))) !== null) {
            if ($record->password !== md5($this->password))
                $this->errorCode = self::ERROR_PASSWORD_INVALID;
            else {
                $this->_id = $record->id_locataire;
                $this->errorCode = self::ERROR_NONE;
            }
            return !$this->errorCode;
        } elseif (($record = User::model()->findByAttributes(array('email' => $this->username))) !== NULL) {

            if ($record->password !== md5($this->password))
                $this->errorCode = self::ERROR_PASSWORD_INVALID;
            else {
                $this->_id = $record->id_user;
                $this->errorCode = self::ERROR_NONE;
            }
            return !$this->errorCode;
        }
    }

    public function getId() {
        return $this->_id;
    }

    public function getStatut() {
        return $this->_table;
    }

}
