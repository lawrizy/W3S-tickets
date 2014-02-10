<?php
/* @var $this TicketController */
/* @var $model Ticket */

$this->breadcrumbs=array(
	'Tickets'=>array('index'),
	$model->id_ticket,
);

$this->menu=array(
	array('label'=>'List Ticket', 'url'=>array('index')),
	array('label'=>'Create Ticket', 'url'=>array('create')),
	array('label'=>'Update Ticket', 'url'=>array('update', 'id'=>$model->id_ticket)),
	array('label'=>'Delete Ticket', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_ticket),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Ticket', 'url'=>array('admin')),
);
?>

<h1>View Ticket #<?php echo $model->id_ticket; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_ticket',
		'fk_statut',
		'fk_categorie',
		'fk_lieu',
		'fk_user',
		'version',
	),
)); ?>
