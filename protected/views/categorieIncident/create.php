<?php
/* @var $this CategorieIncidentController */
/* @var $model CategorieIncident */

$this->breadcrumbs=array(
	'Categorie Incidents'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List CategorieIncident', 'url'=>array('index')),
array('label'=>'Manage CategorieIncident', 'url'=>array('admin')),
);
?>

<h1>Create CategorieIncident</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>