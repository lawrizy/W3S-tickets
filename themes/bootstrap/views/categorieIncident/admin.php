<?php
/* @var $this CategorieIncidentController */
/* @var $model CategorieIncident */

$this->breadcrumbs = array(
    'Manage',
);

$this->menu = array(
    array('label' => 'Create new Categorie', 'url' => array('create')),
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
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'categorie-incident-grid',
    'dataProvider' => $model->search(),
    'columns' => array(
        'label',
        array(
            'name' => 'Fk Parent',
            'value' => '$data->fk_parent != null ? CategorieIncident::model()->findByPk($data->fk_parent)->label : \'NO PARENT\''),
        array(
            'name' => 'Fk Priorite',
            'value' => 'Priorite::model()->findByPk($data->fk_priorite)->label'),
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));

?>
