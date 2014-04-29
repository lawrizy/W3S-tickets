<?php

/* @var $this CategorieIncidentController */
/* @var $model CategorieIncident */

$this->breadcrumbs = array(
    'Categorie Incidents' => array('admin'),
    'Create a Category',
);

$this->menu = array(
    array('label' => Translate::trad("GestionCategorieIncident"), 'url' => array('admin'),
        'visible' => Yii::app()->session['Rights']->getCategorie() & CategorieIncidentController::ACTION_ADMIN),
);

$this->renderPartial('_formCreateCat', array('model' => $model, 'trad' => $trad)); ?>
