<?php
/* @var $this EntrepriseController */
/* @var $model Entreprise */

$this->breadcrumbs=array(
	'Entreprises'=>array('index'),
	$model->id_entreprise,
);

$this->menu=array(
	array('label'=>'List Entreprise', 'url'=>array('index')),
	array('label'=>'Create Entreprise', 'url'=>array('create')),
	array('label'=>'Update Entreprise', 'url'=>array('update', 'id'=>$model->id_entreprise)),
	array('label'=>'Delete Entreprise', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_entreprise),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Entreprise', 'url'=>array('admin')),
);
?>

<h1>View Entreprise #<?php echo $model->id_entreprise; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_entreprise',
		'nom',
		'adresse',
		'tva',
		'commune',
		'cp',
		'tel',
	),
)); ?>
