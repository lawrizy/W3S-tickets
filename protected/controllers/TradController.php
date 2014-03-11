<?php

class TradController extends Controller
{
    public function actionIndex()
    {
        $this->render('index');
    }

    /**
     * Cette action est appelée lors de la création d'une traduction via l'interface admin.
     */
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
                try
                {
                    $model->save(true);
                    Yii::app()->user->setFlash("success", "L'insertion de la nouvelle traduction s'est bien passée.<br/>
                                Vous pouvez désormais l'utiliser en écrivant Translate::trad(\"" . $model->code . "\");");
                } catch (CDbException $cdbe)
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

        $this->render('addTraduction', array(
            'model' => $model,
        ));
    }
    
    public function actionModifyTraduction()
    {
        
    }

    public function loadModel($code)
    {
        $model = Batiment::model()->findByAttributes(array('code' => $code));
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }
}
