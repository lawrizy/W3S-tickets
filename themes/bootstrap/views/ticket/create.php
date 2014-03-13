<?php
/* @var $this TicketController */
/* @var $model Ticket */

$this->breadcrumbs = array(
    'Tickets' => array('admin'),
    'Nouveau ticket',
);

$this->menu = array(
    array('label' => 'Manage', 'url' => array('admin')),
);
?>
<h1>
    <?php echo Translate::trad('CreateTitre') ;?>
</h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>
