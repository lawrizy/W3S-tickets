<?php

/* @var $this CategorieIncidentController */
/* @var $model CategorieIncident */

$this->breadcrumbs = array(
    'Categorie Incidents' => array('admin'),
    'Create a SubCategory',
);

$this->menu = array(
    array('label' => 'Manage Categories', 'url' => array('admin'),'visible'=>  Yii::app()->session['Rights']->getCategorie() & CategorieIncidentController::ACTION_ADMIN),
);
?>


<?php $this->renderPartial('_formCreateSousCat', array('model' => $model)); ?>