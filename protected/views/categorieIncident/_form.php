<?php
/* @var $this CategorieIncidentController */
/* @var $model CategorieIncident */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'categorie-incident-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Les champs marqués de <span class="required">*</span> sont requis.</p>

    <?php echo $form->errorSummary($model); ?>

            <div class="row">
            <?php echo $form->labelEx($model,'label'); ?>
            <?php echo $form->textField($model,'label',array('size'=>60,'maxlength'=>64)); ?>
            <?php echo $form->error($model,'label'); ?>
        </div>

                <div class="row">
            <?php echo $form->labelEx($model,'fk_parent'); ?>
            <?php echo $form->textField($model,'fk_parent'); ?>
            <?php echo $form->error($model,'fk_parent'); ?>
        </div>

                <div class="row">
            <?php echo $form->labelEx($model,'fk_priorite'); ?>
            <?php echo $form->textField($model,'fk_priorite'); ?>
            <?php echo $form->error($model,'fk_priorite'); ?>
        </div>

                <div class="row">
            <?php echo $form->labelEx($model,'visible'); ?>
            <?php echo $form->textField($model,'visible'); ?>
            <?php echo $form->error($model,'visible'); ?>
        </div>

            <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->