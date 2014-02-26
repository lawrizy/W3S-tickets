<?php
/* @var $this BatimentController */
/* @var $model Batiment */

$this->breadcrumbs=array(
	'Batiments'=>array('index'),
	$model->id_batiment,
);

$this->menu=array(
	array('label'=>'List Batiment', 'url'=>array('index')),
	array('label'=>'Create Batiment', 'url'=>array('create')),
	array('label'=>'Update Batiment', 'url'=>array('update', 'id'=>$model->id_batiment)),
	array('label'=>'Delete Batiment', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_batiment),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Batiment', 'url'=>array('admin')),
);
?>

<h1>View Batiment #<?php echo $model->id_batiment; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_batiment',
		'adresse',
		'commune',
		'cp',
	),
)); ?>
