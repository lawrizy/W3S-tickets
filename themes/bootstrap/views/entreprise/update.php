<?php
/* @var $this EntrepriseController */
/* @var $model Entreprise */

$this->breadcrumbs=array(
	'Entreprises'=>array('index'),
	$model->id_entreprise=>array('view','id'=>$model->id_entreprise),
	'Update',
);

$this->menu=array(
	array('label'=>'List Entreprise', 'url'=>array('index')),
	array('label'=>'Create Entreprise', 'url'=>array('create')),
	array('label'=>'View Entreprise', 'url'=>array('view', 'id'=>$model->id_entreprise)),
	array('label'=>'Manage Entreprise', 'url'=>array('admin')),
);
?>

<h1>Update Entreprise <?php echo $model->id_entreprise; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>