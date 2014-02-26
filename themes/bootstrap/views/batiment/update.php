<?php
/* @var $this BatimentController */
/* @var $model Batiment */

$this->breadcrumbs=array(
	'Batiments'=>array('index'),
	$model->id_batiment=>array('view','id'=>$model->id_batiment),
	'Update',
);

$this->menu=array(
	array('label'=>'List Batiment', 'url'=>array('index')),
	array('label'=>'Create Batiment', 'url'=>array('create')),
	array('label'=>'View Batiment', 'url'=>array('view', 'id'=>$model->id_batiment)),
	array('label'=>'Manage Batiment', 'url'=>array('admin')),
);
?>

<h1>Update Batiment <?php echo $model->id_batiment; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>