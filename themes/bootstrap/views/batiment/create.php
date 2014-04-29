<?php
/* @var $this BatimentController */
/* @var $model Batiment */

$this->breadcrumbs = array(
    Translate::trad("AllBatiment") => array('admin'),
    'Create',
);

$this->menu = array(
    array('label' => Translate::trad("ManageBatiment"), 'url' => array('admin'), 'visible' => Yii::app()->session['Rights']->getBatiment() & BatimentController::ACTION_ADMIN),
);
?>

<h1>Create Batiment</h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>
