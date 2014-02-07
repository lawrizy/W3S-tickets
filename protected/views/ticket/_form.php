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
		<?php echo $form->labelEx($model,'id_ticket'); ?>
		<?php echo $form->textField($model,'id_ticket',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'id_ticket'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_sous_categorie'); ?>
		<?php echo $form->textField($model,'id_sous_categorie',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'id_sous_categorie'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_statut_ticket'); ?>
		<?php echo $form->textField($model,'id_statut_ticket',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'id_statut_ticket'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_lieu'); ?>
		<?php echo $form->textField($model,'id_lieu',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'id_lieu'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->