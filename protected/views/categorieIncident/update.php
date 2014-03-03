<?php
/* @var $this CategorieIncidentController */
/* @var $model CategorieIncident */

$this->breadcrumbs=array(
	'Categorie Incidents'=>array('index'),
	$model->id_categorie_incident=>array('view','id'=>$model->id_categorie_incident),
	'Update',
);

$this->menu=array(
array('label'=>'List CategorieIncident', 'url'=>array('index')),
array('label'=>'Create CategorieIncident', 'url'=>array('create')),
array('label'=>'View CategorieIncident', 'url'=>array('view', 'id'=>$model->id_categorie_incident)),
array('label'=>'Manage CategorieIncident', 'url'=>array('admin')),
);
?>

<h1>Update CategorieIncident <?php echo $model->id_categorie_incident; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>