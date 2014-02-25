<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel {

    public $username;
    public $password;
    public $rememberMe;
    private $_identity;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
        return array(
            // username and password are required
            array('username, password', 'required', 'message' => Yii::t('/model/locataire','ChampVide')),
            array('username', 'email'),
            // rememberMe needs to be a boolean
            array('rememberMe', 'boolean'),
            // password needs to be authenticated
            array('password', 'authenticate'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'rememberMe' => Yii::t('/site/login', 'SeSouvenir'),
            'password'=>  Yii::t('/site/login','MdpForm'),
            'username'=>  Yii::t('/site/login','EmailForm'),
        );
    }

    /**
     * Authenticates the password.
     * This is the 'authenticate' validator as declared in rules().
     */
    public function authenticate($attribute, $params) {
        if (!$this->hasErrors()) {
            $this->_identity = new UserIdentity($this->username, $this->password);

            /*
             * Lorsqu'une erreur de connection à la DB est détectée, renvoie le message suivant.
             * TODO : Trouver à quoi correspond l'attribut dans $this->addError($attribute, $errorMessage);
             */
            if (!$this->_identity->authenticate()) {
                if (isset(Yii::app()->session['erreurDB']))
                    $this->addError('DBConnectionFail', 'La connexion à la base de données a échoué.');
                else
                    $this->addError('username', 'Le mot de passe ou le nom d\'utilisateur est incorrect.');
            }
        }
    }

    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
    public function login() {
        if ($this->_identity === null) {
            $this->_identity = new UserIdentity($this->username, $this->password);
            $this->_identity->authenticate();
        }
        if ($this->_identity->errorCode === UserIdentity::ERROR_NONE) {
            $duration = $this->rememberMe ? 3600 * 24 * 30 : 0; // 30 days
            Yii::app()->user->login($this->_identity, $duration);
            return true;
        } else
            return false;
    }

}
