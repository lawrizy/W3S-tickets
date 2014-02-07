<?php
/* @var $this TicketController */
/* @var $data Ticket */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_ticket')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_ticket), array('view', 'id'=>$data->id_ticket)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_sous_categorie')); ?>:</b>
	<?php echo CHtml::encode($data->id_sous_categorie); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_statut_ticket')); ?>:</b>
	<?php echo CHtml::encode($data->id_statut_ticket); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_lieu')); ?>:</b>
	<?php echo CHtml::encode($data->id_lieu); ?>
	<br />


</div>