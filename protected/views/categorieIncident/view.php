<?php
/* @var $this CategorieIncidentController */
/* @var $model CategorieIncident */

$this->breadcrumbs=array(
	'Categorie Incidents'=>array('index'),
	$model->id_categorie_incident,
);

$this->menu=array(
	array('label'=>'List CategorieIncident', 'url'=>array('index')),
	array('label'=>'Create CategorieIncident', 'url'=>array('create')),
	array('label'=>'Update CategorieIncident', 'url'=>array('update', 'id'=>$model->id_categorie_incident)),
	array('label'=>'Delete CategorieIncident', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_categorie_incident),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CategorieIncident', 'url'=>array('admin')),
);
?>

<h1>View CategorieIncident #<?php echo $model->id_categorie_incident; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_categorie_incident',
		'label',
		'id_parent_categorie',
	),
)); ?>
