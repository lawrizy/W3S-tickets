<?php
/* @var $this TicketController */
/* @var $model Ticket */
?>
<h1>
    <?php echo Translate::trad('CreateTitre'); ?>
</h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>
