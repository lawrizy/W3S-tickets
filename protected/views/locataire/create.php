<?php
/* @var $this LocataireController */
/* @var $model Locataire */

$this->breadcrumbs=array(
	'Locataires'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List Locataire', 'url'=>array('index')),
array('label'=>'Manage Locataire', 'url'=>array('admin')),
);
?>

<h1>Create Locataire</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>