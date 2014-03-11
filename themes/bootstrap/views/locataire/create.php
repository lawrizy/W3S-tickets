<?php
/* @var $this LocataireController */
/* @var $model Locataire */

$this->breadcrumbs=array(
	'Locataires'=>array('admin'),
	'Create',
);

$this->menu=array(
array('label'=>'Manage Locataire', 'url'=>array('admin')),
);
?>

<h1>Create Locataire</h1>

<?php $this->renderPartial('_formCreate', array('model'=>$model)); ?>