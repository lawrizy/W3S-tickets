<?php
/* @var $this LocataireController */
/* @var $model Locataire */

$this->breadcrumbs=array(
	Translate::trad('ManageLocataire')=>array('admin'),
	'Create',
);

$this->menu=array(
array('label'=>Translate::trad("ManageLocataire"), 'url'=>array('admin'),'visible'=>  Yii::app()->session['Rights']->getLocataire()& LocataireController::ACTION_ADMIN),
);
?>

<h1><?php echo Translate::trad("AjouterLocataire"); ?></h1>

<?php $this->renderPartial('_formCreate', array('model'=>$model)); ?>
