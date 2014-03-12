<?php
/* @var $this EntrepriseController */
/* @var $model Entreprise */

$this->breadcrumbs=array(
	'Entreprises'=>array('admin'),
	$model->nom=>array('view','id'=>$model->id_entreprise),
	'Update',
);

$this->menu=array(
array('label'=>'View Entreprise', 'url'=>array('view', 'id'=>$model->id_entreprise)),
array('label'=>'Manage Entreprise', 'url'=>array('admin')),
);
?>

<h1>Update Entreprise <?php echo $model->nom; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>