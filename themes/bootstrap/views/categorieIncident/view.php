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
        'linkOptions' => array('submit' => array('delete', 'id' => $model->id_categorie_incident), 'confirm' => Translate::trad('confirmDelete')),
        'visible' => Yii::app()->session['Rights']->getCategorie() & CategorieIncidentController::ACTION_DELETE),
    array('label' => 'Liste Categories', 'url' => array('admin'),
        'visible'=>  Yii::app()->session['Rights']->getCategorie() & CategorieIncidentController::ACTION_ADMIN),
);

$parent = $model->fkParent;
?>

<h1>Détails Categorie: <?php echo Translate::trad($model->label) . ($parent != null ? ' [' . Translate::trad($parent->label) . ']' : ''); ?></h1>

<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'type' => 'striped bordered condensed',
    'data' => $model,
    'attributes' => array(
        array(
            'name' => 'label',
            'value' => Translate::trad($model->label)
        ),
        array(
            'name' => 'Cat&eacute;gorie Parent',
            'value' => $parent != null ? Translate::trad($parent->label) : '-----'
        ),
        array('name' => 'Niveau de Priorit&eacute;',
            'value' => Translate::trad($model->fkPriorite->label))
    ),
));
?>
