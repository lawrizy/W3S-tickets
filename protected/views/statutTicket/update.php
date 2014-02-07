<?php
/* @var $this StatutTicketController */
/* @var $model StatutTicket */

$this->breadcrumbs=array(
	'Statut Tickets'=>array('index'),
	$model->id_statut_ticket=>array('view','id'=>$model->id_statut_ticket),
	'Update',
);

$this->menu=array(
	array('label'=>'List StatutTicket', 'url'=>array('index')),
	array('label'=>'Create StatutTicket', 'url'=>array('create')),
	array('label'=>'View StatutTicket', 'url'=>array('view', 'id'=>$model->id_statut_ticket)),
	array('label'=>'Manage StatutTicket', 'url'=>array('admin')),
);
?>

<h1>Update StatutTicket <?php echo $model->id_statut_ticket; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>