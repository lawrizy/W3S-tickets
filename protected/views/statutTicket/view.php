<?php
/* @var $this StatutTicketController */
/* @var $model StatutTicket */

$this->breadcrumbs=array(
	'Statut Tickets'=>array('index'),
	$model->id_statut_ticket,
);

$this->menu=array(
	array('label'=>'List StatutTicket', 'url'=>array('index')),
	array('label'=>'Create StatutTicket', 'url'=>array('create')),
	array('label'=>'Update StatutTicket', 'url'=>array('update', 'id'=>$model->id_statut_ticket)),
	array('label'=>'Delete StatutTicket', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_statut_ticket),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage StatutTicket', 'url'=>array('admin')),
);
?>

<h1>View StatutTicket #<?php echo $model->id_statut_ticket; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_statut_ticket',
		'label',
	),
)); ?>
