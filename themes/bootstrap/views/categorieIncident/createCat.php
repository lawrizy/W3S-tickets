<?php

/* @var $this CategorieIncidentController */
/* @var $model CategorieIncident */

$this->breadcrumbs = array(
    'Categorie Incidents' => array('admin'),
    'Create a Category',
);

$this->menu = array(
    array('label' => 'Manage Categories', 'url' => array('admin')),
);
?>


<?php $this->renderPartial('_formCreateCat', array('model' => $model)); ?>