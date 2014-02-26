<?php
/* @var $this TicketController */
/* @var $data Ticket */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id_ticket')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id_ticket), array('view', 'id' => $data->id_ticket)); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('fk_statut')); ?>:</b>
    <?php echo CHtml::encode($data->getStatusTicket()); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('fk_categorie')); ?>:</b>
    <?php echo CHtml::encode($data->getCategorieIncident()); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('fk_batiment')); ?>:</b>
    <?php echo CHtml::encode($data->getLieu()); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('fk_user')); ?>:</b>
    <?php echo CHtml::encode($data->fk_user); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('descriptif')); ?>:</b>
    <?php echo CHtml::encode($data->descriptif); ?>
    <br />

  
</div>