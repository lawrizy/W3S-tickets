<?php
/* @var $this BatimentController */
/* @var $model Batiment */

$this->breadcrumbs=array(
	'Batiments'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Batiment', 'url'=>array('index')),
	array('label'=>'Manage Batiment', 'url'=>array('admin')),
);
?>

<h1>Create Batiment</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>