<?php
/* @var $this StatutTicketController */
/* @var $data StatutTicket */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_statut_ticket')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_statut_ticket), array('view', 'id'=>$data->id_statut_ticket)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('label')); ?>:</b>
	<?php echo CHtml::encode($data->label); ?>
	<br />


</div>