<?php
/* @var $this BatimentController */
/* @var $model Batiment */

$this->breadcrumbs = array(
    'Batiments' => array('admin'),
    $model->code,
);

$this->menu = array(
    array('label' => 'Mise à jour Batiment', 'url' => array('update', 'id' => $model->id_batiment), 'visible' => Yii::app()->session['Rights']->getBatiment() & BatimentController::ACTION_UPDATE),
    array('label' => 'Suppression Batiment', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id_batiment), 'confirm' => 'Are you sure you want to delete this item?'), 'visible' => Yii::app()->session['Rights']->getBatiment() & BatimentController::ACTION_DELETE),
    array('label' => 'Liste Batiment', 'url' => array('admin'), 'visible' => Yii::app()->session['Rights']->getBatiment() & BatimentController::ACTION_ADMIN),
);
?>

<h1>Détails Batiment: <?php echo $model->nom; ?></h1>

<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'type' => 'striped condensed bordered',
    'data' => $model,
    'attributes' => array(
        'nom',
        'code',
        'adresse',
        'commune',
        'cp',
    ),
));
?>
