<?php
/* @var $this TicketController */
/* @var $model Ticket */
?>
<h1>
<!--    <img src="/images/age.png"><br>-->
    Créer un nouveau ticket
</h1>
<?php echo Yii::app()->getController()->getAction()->id ?>

<?php $this->renderPartial('_form', array('model' => $model)); ?>
