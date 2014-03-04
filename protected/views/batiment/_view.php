<?php
/* @var $this BatimentController */
/* @var $data Batiment */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id_batiment')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id_batiment), array('view', 'id' => $data->id_batiment)); ?>
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

    <b><?php echo CHtml::encode($data->getAttributeLabel('nom')); ?>:</b>
    <?php echo CHtml::encode($data->nom); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('cpt')); ?>:</b>
    <?php echo CHtml::encode($data->cpt); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('code')); ?>:</b>
    <?php echo CHtml::encode($data->code); ?>
    <br />

    <?php /*
      <b><?php echo CHtml::encode($data->getAttributeLabel('visible')); ?>:</b>
      <?php echo CHtml::encode($data->visible); ?>
      <br />

     */ ?>

</div>