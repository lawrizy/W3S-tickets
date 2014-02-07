<?php
/* @var $this CategorieIncidentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Categorie Incidents',
);

$this->menu=array(
	array('label'=>'Create CategorieIncident', 'url'=>array('create')),
	array('label'=>'Manage CategorieIncident', 'url'=>array('admin')),
);
?>

<h1>Categorie Incidents</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
