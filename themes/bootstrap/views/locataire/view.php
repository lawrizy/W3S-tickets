<?php
/* @var $this LocataireController */
/* @var $model Locataire */

$this->breadcrumbs = array(
    'Locataires' => array('index'),
    $model->id_locataire,
);

$this->menu = array(
    array('label' => 'Update Locataire', 'url' => array('update', 'id' => $model->id_locataire)),
    array('label' => 'Delete Locataire', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id_locataire), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Locataire', 'url' => array('admin')),
    array('label' => 'Rajouter un lieu', 'url' => array('#')),
    array('label' => 'Supprimer un lieu', 'url' => array('#')),
);
?>

<h1>View Locataire #<?php echo $model->id_locataire; ?></h1>

<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'type' => 'striped condensed bordered',
    'data' => $model,
    'attributes' => array(
        'id_locataire',
        'nom',
        'email',
        'password',
        'fk_langue',
        'visible',
    ),
));
?>
