<?php
/* @var $this CategorieIncidentController */
/* @var $model CategorieIncident */
/* @var $trad Trad */

$this->breadcrumbs = array(
    'Categorie Incidents' => array('admin'),
    $model->label => array('view', 'id' => $model->id_categorie_incident),
    'Update',
);

$this->menu = array(
    array('label' => 'View Categorie', 'url' => array('view', 'id' => $model->id_categorie_incident), 'visible' => Yii::app()->session['Rights']->getCategorie() & CategorieIncidentController::ACTION_VIEW),
    array('label' => 'Manage Categories', 'url' => array('admin'), 'visible' => Yii::app()->session['Rights']->getCategorie() & CategorieIncidentController::ACTION_ADMIN),
);
?>

<h1>Update Categorie</h1>

<?php $this->renderPartial('_formUpdateCat', array('model' => $model, 'trad' => $trad)); ?>