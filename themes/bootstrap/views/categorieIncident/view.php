<?php
/* @var $this CategorieIncidentController */
/* @var $model CategorieIncident */

$this->breadcrumbs = array(
    'Categorie Incidents' => array('admin'),
    $model->label,
);

$this->menu = array(
    array('label' => 'Mise à jour Sous-Categorie', 'url' => array('updateSousCat', 'id' => $model->id_categorie_incident),
        'visible' => $model->fk_parent != null && Yii::app()->session['Rights']->getCategorie() & CategorieIncidentController::ACTION_UPDATE),
    array('label' => 'Mise à jour Categorie', 'url' => array('updateCat', 'id' => $model->id_categorie_incident),
        'visible' => $model->fk_parent == null && Yii::app()->session['Rights']->getCategorie() & CategorieIncidentController::ACTION_UPDATE),
    array('label' => 'Suppression Categorie', 'url' => '#', 
        'linkOptions' => array('submit' => array('delete', 'id' => $model->id_categorie_incident), 'confirm' => 'Are you sure you want to delete this item?'),
        'visible' => Yii::app()->session['Rights']->getCategorie() & CategorieIncidentController::ACTION_DELETE),
    array('label' => 'Liste Categories', 'url' => array('admin'),
        'visible'=>  Yii::app()->session['Rights']->getCategorie() & CategorieIncidentController::ACTION_ADMIN),
);

$parent = CategorieIncident::model()->findByPk($model->fk_parent);
?>

<h1>Détails Categorie: <?php echo $model->label . ($parent != null ? ' [' . $parent->label . ']' : ''); ?></h1>

<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'type' => 'striped bordered condensed',
    'data' => $model,
    'attributes' => array(
        'label',
        array(
            'name' => 'Cat&eacute;gorie Parent',
            'value' => $parent != null ? $parent->label : '-----'
        ),
        array('name' => 'Niveau de Priorit&eacute;',
            'value' => Priorite::model()->findByPk($model->fk_priorite)->label)
    ),
));
?>
