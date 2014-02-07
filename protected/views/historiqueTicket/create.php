<?php
/* @var $this HistoriqueTicketController */
/* @var $model HistoriqueTicket */

$this->breadcrumbs=array(
	'Historique Tickets'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List HistoriqueTicket', 'url'=>array('index')),
	array('label'=>'Manage HistoriqueTicket', 'url'=>array('admin')),
);
?>

<h1>Create HistoriqueTicket</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>