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
        <?php echo $form->dropDownList($model, 'fk_categorie', array('' => '', CHtml::listData(CategorieIncident::model()->findAllByAttributes(array('fk_parent' => !NULL)), 'id_categorie_incident', 'label')));//,array('ajax'=>array('type'=>'POST', 'url'=> CController::createUrl('TicketController/dynamic'),'update'=>'#fk_parent')))); ?>
        <div id="sousCategorie"></div>
        <?php //echo $form->labelEx($model, 'fk_categorie'); ?>
        <?php //echo $form->dropDownList('fk_categorie',' ', array()); ?>
    </div>


    <div class="row">
        <?php
        echo $form->labelEx($model, 'fk_batiment');
        echo $form->dropDownList($model, 'fk_batiment', array('' => '', CHtml::listData(Batiment::model()->findAll(), 'id_batiment', 'nom')));
      ; ?>
    </div>
    <div class="row">
        <?php
        echo $form->labelEx($model, 'Etage');
        echo $form->textField($model, 'etage', array('size' => 1, 'maxlength' => 10, 'style' => 'resize:none', 'value' => $model->etage));
        ?>
    </div>
    <div class="row">
        <?php
        echo $form->labelEx($model, 'bureau');
        echo $form->textField($model, 'bureau', array('size' => 15, 'maxlength' => 10, 'value' => $model->bureau));
        ?>
    </div>
    <div class="row">
        <?php
        echo $form->labelEx($model, 'descriptif');
        echo $form->textArea($model, 'descriptif', array('maxlength' => 800, 'rows' => 5, 'cols' => 50, 'style' => 'resize:none'));
        echo $form->error($model, 'descriptif');
        ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>


    <?php $this->endWidget(); ?>

</div><!-- form -->
