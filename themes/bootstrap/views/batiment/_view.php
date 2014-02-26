<?php
/* @var $this BatimentController */
/* @var $data Batiment */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_batiment')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_batiment), array('view', 'id'=>$data->id_batiment)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('adresse')); ?>:</b>
	<?php echo CHtml::encode($data->adresse); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('commune')); ?>:</b>
	<?php echo CHtml::encode($data->commune); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cp')); ?>:</b>
	<?php echo CHtml::encode($data->cp); ?>
	<br />


</div>