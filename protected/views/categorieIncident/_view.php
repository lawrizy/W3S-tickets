<?php
/* @var $this CategorieIncidentController */
/* @var $data CategorieIncident */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_categorie_incident')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_categorie_incident), array('view', 'id'=>$data->id_categorie_incident)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('label')); ?>:</b>
	<?php echo CHtml::encode($data->label); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_parent_categorie')); ?>:</b>
	<?php echo CHtml::encode($data->id_parent_categorie); ?>
	<br />


</div>