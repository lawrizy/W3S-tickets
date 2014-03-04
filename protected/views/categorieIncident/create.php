<?php
/* @var $this CategorieIncidentController */
/* @var $model CategorieIncident */

$this->breadcrumbs = array(
    'Categorie Incidents' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'Manage Categories', 'url' => array('admin')),
);
?>

<h1>Create CategorieIncident</h1>

<?php $this->renderPartial('_formCreate', array('model' => $model)); ?>