<?php
/* @var $this UserController */
/* @var $data User */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id_user')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id_user), array('view', 'id' => $data->id_user)); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('nom')); ?>:</b>
    <?php echo CHtml::encode($data->nom); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('prenom')); ?>:</b>
    <?php echo CHtml::encode($data->prenom); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
    <?php echo CHtml::encode($data->email); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
    <?php echo CHtml::encode($data->password); ?>
    <br />


</div>