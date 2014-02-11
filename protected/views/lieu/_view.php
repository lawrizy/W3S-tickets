<?php
/* @var $this LieuController */
/* @var $data Lieu */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_lieu')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_lieu), array('view', 'id'=>$data->id_lieu)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('etage')); ?>:</b>
	<?php echo CHtml::encode($data->etage); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('appartement')); ?>:</b>
	<?php echo CHtml::encode($data->appartement); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_locataire')); ?>:</b>
	<?php echo CHtml::encode($data->fk_locataire); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_batiment')); ?>:</b>
	<?php echo CHtml::encode($data->fk_batiment); ?>
	<br />


</div>