<?php
/* @var $this StatutTicketController */
/* @var $model StatutTicket */

$this->breadcrumbs=array(
	'Statut Tickets'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List StatutTicket', 'url'=>array('index')),
	array('label'=>'Manage StatutTicket', 'url'=>array('admin')),
);
?>

<h1>Create StatutTicket</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>