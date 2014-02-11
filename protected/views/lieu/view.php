<?php
/* @var $this LieuController */
/* @var $model Lieu */

$this->breadcrumbs=array(
	'Lieus'=>array('index'),
	$model->id_lieu,
);

$this->menu=array(
	array('label'=>'List Lieu', 'url'=>array('index')),
	array('label'=>'Create Lieu', 'url'=>array('create')),
	array('label'=>'Update Lieu', 'url'=>array('update', 'id'=>$model->id_lieu)),
	array('label'=>'Delete Lieu', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_lieu),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Lieu', 'url'=>array('admin')),
);
?>

<h1>View Lieu #<?php echo $model->id_lieu; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_lieu',
		'etage',
		'appartement',
		'fk_locataire',
		'fk_batiment',
	),
)); ?>
