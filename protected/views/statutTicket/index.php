<?php
/* @var $this StatutTicketController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Statut Tickets',
);

$this->menu=array(
	array('label'=>'Create StatutTicket', 'url'=>array('create')),
	array('label'=>'Manage StatutTicket', 'url'=>array('admin')),
);
?>

<h1>Statut Tickets</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
