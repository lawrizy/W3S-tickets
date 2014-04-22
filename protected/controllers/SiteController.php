<?php

class SiteController extends Controller {

    private $id;

    public static function assignLangue() {  // fonction statique qui permet soit de recuperer la langue soit de remettre la langue de l'application par défaut = en
        if (!empty(Yii::app()->session['_lang'])) { // si il y a une langue 
            Yii::app()->language = Yii::app()->session['_lang'];  // la langue de l'application est definie par l'utilisateur
        } else {   // sinon 
            Yii::app()->session['_lang'] = 'en'; // la langue est l'anglais par défaut 
            Yii::app()->language = Yii::app()->session['_lang']; // la langue de l'application est assignée
        }
    }

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
// captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
// They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        $this->assignLangue();
        $this->render('index');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if (!empty(Yii::app()->session['_lang'])) {

            Yii::app()->language = Yii::app()->session['_lang'];
        } else {
            Yii::app()->session['_lang'] = 'en';
            Yii::app()->language = Yii::app()->session['_lang'];
        }
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        $this->assignLangue();
        $model = new ContactForm;
        
        if (isset($_POST['ContactForm']))
        {
            $model->attributes = $_POST['ContactForm'];
            if($model->validate())
            {
                $from = Yii::app()->params["adminEmail"];
                $to = Yii::app()->params["emailReceptionMessageContact"];
                $subject = "=?UTF-8?B?" . base64_encode(Translate::trad("ContactIncomingMessageFrom") . $model->subject) . '?=';
                $body = $model->body;
                
                $toSend = new YiiMailMessage($subject, $body, "text/plain", "UTF-8");
                $toSend->addTo($to);
                $toSend->addFrom($from);
                
                try {
                    Yii::app()->mail->send($toSend);
                } catch (Swift_SwiftException $mailException) {
                    Yii::app()->user->setFlash('error', 'L\'envoi du mail a échoué.<br/>' . $mailException->getMessage());
                }
                
                Yii::app()->user->setFlash('info', Translate::trad("ContactMessageSuccessAlert"));
            }
        }
        $this->render('contact', array('model' => $model));
    }
    
    public function actionTest() {
        $this->render('test');
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $this->assignLangue();
        if (isset($_GET['expiration'])) {
            if ($_GET['expiration'] === Constantes::ISAJAX_TRUE) {
                echo Yii::app()->user->setFlash('info', '<strong>Session expirée: Vous avez été déconnecté </strong>');
                unset($_GET['expiration']);
            }
        }
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
                if (Yii::app()->session['Logged']->fk_fonction == Constantes::FONCTION_LOCATAIRE)
                    $this->redirect(array('./ticket/create'));
                else {
                    $this->redirect(array('./ticket/admin?var=admin'));
                }
            }
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        if (!isset($_GET['isAjax']))
            $varIsAjax = Constantes::ISAJAX_FALSE;
        else {
            $varIsAjax = Constantes::ISAJAX_TRUE;
        }
        $model = User::model()->findByPk(Yii::app()->session['Logged']->id_user);
        $Session = Session::model()->findByAttributes(array('email' => $model->email));
        $yiisession = Yiisession::model()->findByPk($Session->fk_yiisession);
        $yiisession->delete();
        $model->save();
        Yii::app()->user->logout();
        Yii::app()->language = Yii::app()->session['_lang'];
        header('Location: ' . Yii::app()->request->baseUrl . '/index.php/site/login?expiration=' . $varIsAjax);
    }

// ---------------------------------------- //
// ---------- Choix de la langue ---------- //
// ---------------------------------------- //
    public function actionChooseLanguageFr() {
        $ctr = $_GET['ctr'];
        Yii::app()->session['_lang'] = 'fr';
        header("Location: $ctr");
    }

    public function actionChooseLanguageEn() {
        $ctr = $_GET['ctr'];
        Yii::app()->session['_lang'] = 'en';
        header("Location: $ctr");
    }

    public function actionChooseLanguageNl() {
        $ctr = $_GET['ctr'];
        Yii::app()->session['_lang'] = 'nl';
        header("Location: $ctr");
    }

// ---------------------------------------- //
// ---------------------------------------- //
// ---------------------------------------- //
}
