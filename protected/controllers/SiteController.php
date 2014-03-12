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
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-Type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $this->assignLangue();
        if (isset($_GET['expiration'])) {
            if ($_GET['expiration'] === 'logout') {
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
            if ($model->validate() && $model->login()){
                if (Yii::app()->session['Utilisateur'] == 'Locataire')
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
        if (Yii::app()->session['Utilisateur'] == 'User') {
            $model = User::model()->findByPk(Yii::app()->session['Logged']->id_user);
            $model->is_logged = 0;
        } elseif (Yii::app()->session['Utilisateur'] == 'Locataire') {
            $model = Locataire::model()->findByPk(Yii::app()->session['Logged']->id_locataire);
            $model->is_logged = 0;
        }
        $model->save();
        Yii::app()->user->logout();
        Yii::app()->language = Yii::app()->session['_lang'];
        header('Location: ' . Yii::app()->request->baseUrl . '/index.php/site/login?expiration=' . Yii::app()->controller->getAction()->getId());
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
