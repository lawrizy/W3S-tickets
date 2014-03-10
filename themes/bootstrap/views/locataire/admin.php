<?php
/* @var $this LocataireController */
/* @var $model Locataire */

$this->breadcrumbs = array(
    'Locataires' => array('index'),
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
        'id_locataire',
        'nom',
        'email',
        'password',
        'fk_langue',
        'visible',
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
));
?>
