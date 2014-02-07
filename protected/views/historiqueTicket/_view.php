<?php
/* @var $this HistoriqueTicketController */
/* @var $data HistoriqueTicket */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_historique_ticket')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_historique_ticket), array('view', 'id'=>$data->id_historique_ticket)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_update')); ?>:</b>
	<?php echo CHtml::encode($data->date_update); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('commentaire')); ?>:</b>
	<?php echo CHtml::encode($data->commentaire); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_ticket')); ?>:</b>
	<?php echo CHtml::encode($data->id_ticket); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_statut_ticket')); ?>:</b>
	<?php echo CHtml::encode($data->id_statut_ticket); ?>
	<br />


</div>