<?php
/* @var $this LocataireController */
/* @var $model Locataire */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'locataire-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Les champs marqués de <span class="required">*</span> sont requis.</p>

    <?php echo $form->errorSummary($model); ?>

            <div class="row">
            <?php echo $form->labelEx($model,'nom'); ?>
            <?php echo $form->textField($model,'nom',array('size'=>60,'maxlength'=>64)); ?>
            <?php echo $form->error($model,'nom'); ?>
        </div>

                <div class="row">
            <?php echo $form->labelEx($model,'email'); ?>
            <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>64)); ?>
            <?php echo $form->error($model,'email'); ?>
        </div>

                <div class="row">
            <?php echo $form->labelEx($model,'password'); ?>
            <?php echo $form->passwordField($model,'password',array('size'=>32,'maxlength'=>32)); ?>
            <?php echo $form->error($model,'password'); ?>
        </div>

                <div class="row">
            <?php echo $form->labelEx($model,'fk_langue'); ?>
            <?php echo $form->textField($model,'fk_langue'); ?>
            <?php echo $form->error($model,'fk_langue'); ?>
        </div>

                <div class="row">
            <?php echo $form->labelEx($model,'visible'); ?>
            <?php echo $form->textField($model,'visible'); ?>
            <?php echo $form->error($model,'visible'); ?>
        </div>

                <div class="row">
            <?php echo $form->labelEx($model,'is_logged'); ?>
            <?php echo $form->textField($model,'is_logged'); ?>
            <?php echo $form->error($model,'is_logged'); ?>
        </div>

            <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->