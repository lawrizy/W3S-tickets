<?php
/* @var $this CategorieIncidentController */
/* @var $model CategorieIncident */

$this->breadcrumbs=array(
	'Categorie Incidents'=>array('admin'),
	$model->label=>array('view','id'=>$model->id_categorie_incident),
	'Update',
);

$this->menu=array(
array('label'=>'View Categorie', 'url'=>array('view', 'id'=>$model->id_categorie_incident)),
array('label'=>'Manage Categories', 'url'=>array('admin')),
);
?>

<h1>Update Sous-Categorie</h1>

<?php $this->renderPartial('_formUpdateSousCat', array('model'=>$model)); ?>