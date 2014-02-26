<?php
/* @var $this LieuController */
/* @var $model Lieu */

$this->breadcrumbs = array(
    'Lieus' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'List Lieu', 'url' => array('index')),
    array('label' => 'Manage Lieu', 'url' => array('admin')),
);
?>

<h1>Create Lieu</h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>