<?php
/* @var $this BatimentController */
/* @var $model Batiment */

$this->breadcrumbs = array(
    'Batiments' => array('admin'),
    $model->code,
);

$this->menu = array(
    array('label' => 'Update Batiment', 'url' => array('update', 'id' => $model->id_batiment)),
    array('label' => 'Delete Batiment', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id_batiment), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Batiment', 'url' => array('admin')),
);
?>

<h1>View Batiment: <?php echo $model->nom; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
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
