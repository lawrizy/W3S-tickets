<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
    'Users' => array('admin'),
    'Create',
);

$this->menu = array(
    array('label' => 'Gérer les utilisateurs', 'url' => array('admin')),
);
?>

<h1>Create User</h1>

<?php $this->renderPartial('_formCreate', array('model' => $model)); ?>