<?php
/* @var $this LocataireController */
/* @var $model Locataire */

$this->breadcrumbs = array(
    'Locataires' => array('admin'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Locataire', 'url' => array('index')),
    array('label' => 'Create Locataire', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$('#locataire-grid').yiiGridView('update', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Manage Locataires</h1>


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
    'type' => 'striped bordered condensed',
    'id' => 'locataire-grid',
    'dataProvider' => $model->search(),
    'columns' => array(
       array('name' => 'Nom',
            'value' => '$data->nom;'
        ),
        array('name' => 'Email',
            'value' => '$data->email;'
        ),
        array('name' => 'Langue',
            'value' => 'Langue::model()->findByPk($data->fk_langue)->label;'
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
));
?>
