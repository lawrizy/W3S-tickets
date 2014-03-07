<?php
/* @var $this CategorieIncidentController */
/* @var $model CategorieIncident */

$this->breadcrumbs = array(
    'Categorie Incidents' => array('admin'),
    $model->id_categorie_incident,
);

$this->menu = array(
    array('label' => 'Update Categorie', 'url' => array('update', 'id' => $model->id_categorie_incident)),
    array('label' => 'Delete Categorie', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id_categorie_incident), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Categories', 'url' => array('admin')),
);

$parent = CategorieIncident::model()->findByPk($model->fk_parent);
?>

<h1>View Categorie: <?php echo $model->label . ($parent != null ? ' [' . $parent->label . ']' : ''); ?></h1>

<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'type' => 'striped bordered condensed',
    'data' => $model,
    'attributes' => array(
        'label',
        array(
            'name' => 'fk_parent',
            'value' => $parent != null ? $parent->label : null
        ),
        'fk_priorite',
    ),
));
?>
