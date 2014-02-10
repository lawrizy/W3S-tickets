<?php
/* @var $this LieuController */
/* @var $model Lieu */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'lieu-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'adresse'); ?>
		<?php echo $form->textField($model,'adresse',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'adresse'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ville'); ?>
		<?php echo $form->textField($model,'ville',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'ville'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fk_locataire'); ?>
		<?php echo $form->textField($model,'fk_locataire',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'fk_locataire'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->