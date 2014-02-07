<?php
/* @var $this HistoriqueTicketController */
/* @var $model HistoriqueTicket */

$this->breadcrumbs=array(
	'Historique Tickets'=>array('index'),
	$model->id_historique_ticket=>array('view','id'=>$model->id_historique_ticket),
	'Update',
);

$this->menu=array(
	array('label'=>'List HistoriqueTicket', 'url'=>array('index')),
	array('label'=>'Create HistoriqueTicket', 'url'=>array('create')),
	array('label'=>'View HistoriqueTicket', 'url'=>array('view', 'id'=>$model->id_historique_ticket)),
	array('label'=>'Manage HistoriqueTicket', 'url'=>array('admin')),
);
?>

<h1>Update HistoriqueTicket <?php echo $model->id_historique_ticket; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>