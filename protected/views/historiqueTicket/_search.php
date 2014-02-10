<?php
/* @var $this HistoriqueTicketController */
/* @var $model HistoriqueTicket */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_historique_ticket'); ?>
		<?php echo $form->textField($model,'id_historique_ticket'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_update'); ?>
		<?php echo $form->textField($model,'date_update'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'commentaire'); ?>
		<?php echo $form->textArea($model,'commentaire',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_ticket'); ?>
		<?php echo $form->textField($model,'fk_ticket',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_statut_ticket'); ?>
		<?php echo $form->textField($model,'fk_statut_ticket',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->