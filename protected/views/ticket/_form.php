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
    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'fk_statut'); ?>
        <input type="hidden" value="<?php  ?>" >
        <?php echo $form->error($model, 'fk_statut'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'fk_categorie'); ?>
        <?php echo $form->dropDownList($model, 'fk_categorie', CHtml::listData(CategorieIncident::model()->findAllByAttributes(array('fk_parent'=>! NULL)), 'id_categorie_incident', 'label')); ?>
        <?php echo $form->error($model, 'fk_categorie'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'fk_lieu'); ?>
        <?php echo $form->dropDownList($model, 'fk_lieu', CHtml::listData(Lieu::model()->findAll(), 'id_lieu', 'adresse')); ?>
        <?php echo $form->error($model, 'fk_lieu'); ?>
    </div>

<!--    <div class="row">
      
    </div>-->

    <div class="row">
        <?php echo $form->labelEx($model, 'version'); ?>
        <?php echo $form->textField($model, 'version', array('size' => 2, 'maxlength' => 2)); ?>
        <?php echo $form->error($model, 'version'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->