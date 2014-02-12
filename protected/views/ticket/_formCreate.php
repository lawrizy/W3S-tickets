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
        <?php echo $form->labelEx($model, 'fk_categorie'); ?>
        <?php echo $form->dropDownList($model, 'fk_categorie', array('' => '', CHtml::listData(CategorieIncident::model()->findAllByAttributes(array('fk_parent' => !NULL)), 'id_categorie_incident', 'label'))); ?>
        <?php echo $form->dropDownList($model, 'fk_categorie', array('' => '', CHtml::listData(CategorieIncident::model()->findAllByAttributes(array('fk_parent' => NULL)), 'id_categorie_incident', 'label'))); ?>
        <?php echo $form->error($model, 'fk_categorie'); ?>
    </div>


    <div class="row">
        <?php
        echo $form->labelEx($model, 'fk_lieu');
        if ((Yii::app()->session['Locataire'] == 'Locataire')) {
            echo $form->dropDownList($model, 'fk_lieu', array('' => '', CHtml::listData(Lieu::model()->findAllByAttributes(array('fk_locataire' => Yii::app()->session['Logged']->id_locataire)), 'id_lieu', 'adresse')));
            echo $form->error($model, 'fk_lieu');
            $var = 0;
            $var = Yii::app()->session['Logged'];
        } else {
            echo $form->dropDownList($model, 'fk_lieu', array('' => '', CHtml::listData(Lieu::model()->findAllByAttributes(array('fk_locataire' => $_GET['id'])), 'id_lieu', 'adresse')));
        }
        ?>
    </div>

    <div class="row">
        <?php
        echo $form->labelEx($model, 'commentaire');
        echo $form->textArea($model, 'commentaire', array('maxlength' => 800, 'rows' => 5, 'cols' => 50, 'style' => 'resize:none'));
        echo $form->error($model, 'commentaire');
        ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Create'); ?>
    </div>


    <?php $this->endWidget(); ?>

</div><!-- form -->
