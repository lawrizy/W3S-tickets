<?php
/* @var $this TicketController */
/* @var $model Ticket */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ticket-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'fk_statut'); ?>
		<?php echo $form->textField($model,'fk_statut',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'fk_statut'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fk_categorie'); ?>
		<?php echo $form->textField($model,'fk_categorie',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'fk_categorie'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fk_lieu'); ?>
		<?php echo $form->textField($model,'fk_lieu',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'fk_lieu'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fk_user'); ?>
		<?php echo $form->textField($model,'fk_user',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'fk_user'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'version'); ?>
		<?php echo $form->textField($model,'version',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'version'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'commentaire'); ?>
		<?php echo $form->textArea($model,'commentaire',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'commentaire'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fk_canal'); ?>
		<?php echo $form->textField($model,'fk_canal'); ?>
		<?php echo $form->error($model,'fk_canal'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->