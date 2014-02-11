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
		<?php echo $form->labelEx($model,'etage'); ?>
		<?php echo $form->textField($model,'etage'); ?>
		<?php echo $form->error($model,'etage'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'appartement'); ?>
		<?php echo $form->textField($model,'appartement',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'appartement'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fk_locataire'); ?>
		<?php echo $form->textField($model,'fk_locataire',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'fk_locataire'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fk_batiment'); ?>
		<?php echo $form->textField($model,'fk_batiment'); ?>
		<?php echo $form->error($model,'fk_batiment'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->