<?php

class TradController extends Controller
{
    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionAddTraduction()
    {
        $model = new Trad;

        // Yii::trace("Entrée dans actionAddTraduction", "cron"); // OK passe

        if (isset($_POST['Trad']))
        {
            // Yii::trace("Objet trad bien reçu dans actionAddTraduction.", "cron"); // OK passe
            $model->attributes = $_POST['Trad'];
            // Exécution de la validation suivant les règles du modèle (code, fr, en, nl non null, etc...)
            if ($model->validate())
            {
                // Yii::trace("La Trad passe le validate", "cron"); // OK passe
                // Sauvegarde de la nouvelle traduction
                if($model->save(true))
                {
                    Yii::app()->user->setFlash("success", "L'insertion de la nouvelle traduction s'est bien passée.");
                }
                else
                {
                    Yii::app()->user->setFlash("error", "Le code que vous voulez assigner est déjà utilisé.");
                }
                
                if (!isset($_GET['ajax']))
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('addTraduction'));
            }
            else
            {
                // Un soucis s'est produit (champs vide, etc...)
                //Yii::trace("La Trad ne passe pas le validate", "cron");
                Yii::app()->user->setFlash("error", "L'un des champs n'a pas pu être validé.");
                if (!isset($_GET['ajax']))
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('addTraduction'));
            }
        }
        else
        {
            Yii::app()->user->setFlash("error", "Une erreur interne s'est déclenchée, réessayez plus tard svp.");
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('addTraduction'));
        }

        $this->render('addTraduction', array(
            'model' => $model,
        ));
    }

    public function loadModel($code) {
        $model = Batiment::model()->findByAttributes(array('code' => $code));
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }
}
