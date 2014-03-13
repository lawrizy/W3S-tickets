<?php
/* @var $this TicketController */
/* @var $model Ticket */

$this->breadcrumbs = array(
    'Tickets' => array('admin'),
    $model->code_ticket => array('view', 'id' => $model->id_ticket),
    'Cloturer ticket',
);

$this->menu = array(
    array('label' => 'View', 'url' => array('view', 'id' => $model->id_ticket)),
    array('label' => 'Manage', 'url' => array('admin')),
);

?>

<h1><?php echo Translate::trad('CloseTitre'); ?> <?php echo $model->code_ticket; ?></h1>
<?php $this->renderPartial('_formClose', array('model' => $model)); ?>