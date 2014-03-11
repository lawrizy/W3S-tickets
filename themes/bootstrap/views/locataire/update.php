<?php
/* @var $this LocataireController */
/* @var $model Locataire */

$this->breadcrumbs=array(
	'Locataires'=>array('admin'),
	$model->id_locataire=>array('view','id'=>$model->id_locataire),
	'Update',
);

$this->menu=array(
array('label'=>'Détails Locataire', 'url'=>array('view', 'id'=>$model->id_locataire)),
array('label'=>'Liste Locataire', 'url'=>array('admin')),
);
?>

<h1>Update Locataire <?php echo $model->id_locataire; ?></h1>

<?php $this->renderPartial('_formUpdate', array('model'=>$model)); ?>