<?php
/* @var $this TicketController */
/* @var $data Ticket */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id_ticket')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id_ticket), array('view', 'id' => $data->id_ticket)); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('fk_statut')); ?>:</b>
    <?php echo CHtml::encode($data->fk_statut); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('fk_categorie')); ?>:</b>
    <?php echo CHtml::encode($data->fk_categorie); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('fk_lieu')); ?>:</b>
    <?php echo CHtml::encode($data->fk_lieu); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('fk_user')); ?>:</b>
    <?php echo CHtml::encode($data->fk_user); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('version')); ?>:</b>
    <?php echo CHtml::encode($data->version); ?>
    <br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('commentaire')); ?>:</b>
	<?php echo CHtml::encode($data->commentaire); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_canal')); ?>:</b>
	<?php echo CHtml::encode($data->fk_canal); ?>
	<br />

	*/ ?>

</div>