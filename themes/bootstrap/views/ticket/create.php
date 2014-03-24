<?php
/* @var $this TicketController */
/* @var $model Ticket */
//$breadcrumbs = array();
//Yii::app()->session['Rights']->getTicket() & TicketController::ACTION_ADMIN ? array_push($breadcrumbs, array('admin')) : NULL;
//array_push($breadcrumbs, 'Create');
//
//$this->breadcrumbs = $breadcrumbs;


$this->menu = array(
    array('label' => 'Manage', 'url' => array('admin'), 'visible' => Yii::app()->session['Rights']->getTicket() & TicketController::ACTION_ADMIN),
);
?>
<h1>
    <?php echo Translate::trad('CreateTitre'); ?>
</h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>
