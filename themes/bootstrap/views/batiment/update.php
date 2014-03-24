<?php
/* @var $this BatimentController */
/* @var $model Batiment */

$this->breadcrumbs = array(
    'Batiments' => array('admin'),
    $model->nom => array('view', 'id' => $model->id_batiment),
    'Update',
);

$this->menu = array(
    array('label' => 'View Batiment', 'url' => array('view', 'id' => $model->id_batiment), 'visible' => Yii::app()->session['Rights']->getBatiment() & BatimentController::ACTION_VIEW),
    array('label' => 'Manage Batiment', 'url' => array('admin'), 'visible' => Yii::app()->session['Rights']->getBatiment() & BatimentController::ACTION_ADMIN),
);
?>

<h1>Update Batiment <?php echo $model->id_batiment; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>