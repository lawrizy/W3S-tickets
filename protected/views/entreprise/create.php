<?php
/* @var $this EntrepriseController */
/* @var $model Entreprise */

$this->breadcrumbs = array(
    'Entreprises' => array('admin'),
    'Create',
);

$this->menu = array(
    array('label' => 'Manage Entreprise', 'url' => array('admin')),
);
?>

<h1>Create Entreprise</h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>