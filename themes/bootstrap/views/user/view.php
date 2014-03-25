<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
    'Users' => array('admin'),
    $model->nom,
);

$this->menu = array(
    array('label' => 'List User', 'url' => array('admin')),
    array('label' => 'Update User', 'url' => array('update', 'id' => $model->id_user)),
    array('label' => 'Delete User', 'url' => '#',
        'linkOptions' => array('submit' => array('delete', 'id' => $model->id_user), 'confirm' => 'Are you sure you want to delete this item?')),
);
?>

<h1>Détails <?php echo $model->nom; ?></h1>


<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'type' => 'striped condensed bordered',
    'attributes' => array(
        'nom',
        'email',
        array('name' => 'Fonction',
            'value' => $model->fkFonction->label),
        array('name' => 'Langue',
            'value' => $model->fkLangue->label)
    ),
));
?>

