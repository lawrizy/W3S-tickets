<?php
/* @var $this LocataireController */
/* @var $data Locataire */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id_locataire')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id_locataire), array('view', 'id' => $data->id_locataire)); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('nom')); ?>:</b>
    <?php echo CHtml::encode($data->nom); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
    <?php echo CHtml::encode($data->email); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
    <?php echo CHtml::encode($data->password); ?>
    <br />


</div>