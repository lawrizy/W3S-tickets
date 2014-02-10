<?php
/* @var $this LieuController */
/* @var $data Lieu */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id_lieu')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id_lieu), array('view', 'id' => $data->id_lieu)); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('adresse')); ?>:</b>
    <?php echo CHtml::encode($data->adresse); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('ville')); ?>:</b>
    <?php echo CHtml::encode($data->ville); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('fk_locataire')); ?>:</b>
    <?php echo CHtml::encode($data->fk_locataire); ?>
    <br />


</div>