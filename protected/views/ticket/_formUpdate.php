<?php
/* @var $this TicketController */
/* @var $model Ticket */
/* @var $form CActiveForm */
?>

<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'ticket-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Les champs marqués de <span class="required">*</span> sont requis.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php 
            echo $form->labelEx($model, 'fk_categorie');
            echo $form->dropDownList($model, 'fk_categorie', array('prompt' => 'Catégorie principale', CHtml::listData(CategorieIncident::model()->findAllByAttributes(array('fk_parent' => NULL)), 'id_categorie_incident', 'label')));
            echo $form->dropDownList($model, 'fk_categorie', array('' => '', CHtml::listData(CategorieIncident::model()->findAllByAttributes(array('fk_parent' => !NULL)), 'id_categorie_incident', 'label')));
            echo $form->error($model, 'fk_categorie');
        ?>
    </div>


    <div class="row">
        <?php
        echo $form->labelEx($model, 'fk_lieu');
        $lieu = Lieu::model()->findByPk($model->fk_lieu);
        echo $form->dropDownList($model, 'fk_lieu', array('' => '', CHtml::listData(Lieu::model()->findAllByAttributes(array('fk_locataire' => Locataire::model()->findByPk($lieu->fk_locataire)->id_locataire)), 'id_lieu', 'adresse')));
        echo $form->error($model, 'fk_lieu');
        ?>
    </div>

    <?php
            // Affichage de la sélection des entreprises
    if(Yii::app()->session['Utilisateur'] == 'User')
    {
        echo $form->labelEx($model, 'fk_secteur');
        echo $form->dropDownList($model, 'fk_secteur', array('empty' => 'TODO!!'));
        echo $form->error($model, 'fk_secteur');
    }
    ?>
    
    <div class="row">
        <!-- Div pour la PRIORITE -->
        <!-- TODO Priorité -->
    </div>
    
    <div class="row">
        <?php
        echo $form->labelEx($model, 'commentaire');
        echo $form->textArea($model, 'commentaire', array('maxlength' => 800, 'rows' => 5, 'cols' => 50, 'style' => 'resize:none'));
        echo $form->error($model, 'commentaire');
        ?>
    </div>
    
    <div class="row buttons">
        <?php
            echo CHtml::submitButton('Save');
            
            if(Yii::app()->session['Utilisateur'] == 'User')
            {
                $nomMethode = ""; // Nom de la méthode du TicketController sans le "action" ex: create et pas actionCreate
                if($model->getStatusTicket() === "Closed");
                else if($model->getStatusTicket() === "Opened")
                {
                    $nomMethode = "DummyAction"; //TODO
                    echo CHtml::submitButton('Passer le ticket \'En traitement\'', 
                            array('button' => 'TicketController/' . $nomMethode,
                                'submit' => array('ticket/admin'),
                                ));
                }
                else
                {
                    $nomMethode = "DummyAction"; //TODO
                    echo CHtml::submitButton('Clôturer le ticket', array(
                            'button' => array(  'TicketController/' . $nomMethode,
                            'submit' => array('ticket/admin'),
                            )));
                }
            }
            
            echo CHtml::submitButton('Annuler les changements', array('submit' => array('ticket/admin')));
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
