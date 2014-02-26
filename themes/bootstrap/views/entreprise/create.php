<?php
/* @var $this EntrepriseController */
/* @var $model Entreprise */

$this->breadcrumbs=array(
	'Entreprises'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Entreprise', 'url'=>array('index')),
	array('label'=>'Manage Entreprise', 'url'=>array('admin')),
);
?>

<h1>Create Entreprise</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>