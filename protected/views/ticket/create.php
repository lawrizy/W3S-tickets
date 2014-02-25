<?php
/* @var $this TicketController */
/* @var $model Ticket */
?>
<h1>
    <?php echo Yii::t('/ticket/create','CreateTitre') ;?>
</h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>
