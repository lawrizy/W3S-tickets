<?php
/* @var $this CategorieIncidentController */
/* @var $model CategorieIncident */

$this->breadcrumbs = array(
    'Categorie Incidents' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List CategorieIncident', 'url' => array('index')),
    array('label' => 'Create CategorieIncident', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#categorie-incident-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Categorie Incidents</h1>

<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'categorie-incident-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id_categorie_incident',
        'label',
        'fk_parent',
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
