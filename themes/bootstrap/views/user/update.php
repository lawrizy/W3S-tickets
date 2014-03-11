<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
    'Users' => array('admin'),
    $model->id_user => array('view', 'id' => $model->id_user),
    'Update',
);

$this->menu = array(
    array('label' => 'Créer un utilisateur', 'url' => array('create')),
    array('label' => 'Détails des utilisateur ', 'url' => array('view', 'id' => $model->id_user)),
    array('label' => 'Manage User', 'url' => array('admin')),
);
?>

<h1>Update User <?php echo $model->id_user; ?></h1>

<?php $this->renderPartial('_formUpdate', array('model' => $model)); ?>