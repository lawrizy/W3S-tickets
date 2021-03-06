<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class ContactForm extends CFormModel {

    public $email;
    public $subject;
    public $body;
    public $verifyCode;
    
    public function __construct()
    {
        if(!Yii::app()->user->isGuest)
            $this->email = Yii::app()->user->name;
    }
    
    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            // name, email, subject and body are required
            //array('name, email, subject, body', 'required', 'message' => 'Le champs {attribute} ne peut être vide.'),
            array('email, subject, body', 'required', 'message' => 'Le champs {attribute} ne peut être vide.'),
            // email has to be a valid email address
            array('email', 'email'),
            // verifyCode needs to be entered correctly
            array('verifyCode', 'captcha', 'allowEmpty' => !CCaptcha::checkRequirements()),
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels() {
        return array(
            'verifyCode' => Translate::trad('TranslationCode'),
            'email' => 'Email',
            'subject' => Translate::trad('Subject'),
            'body' => Translate::trad("MessageBody"),
        );
    }
}
