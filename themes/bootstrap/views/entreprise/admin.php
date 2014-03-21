<?php
/* @var $this EntrepriseController */
/* @var $model Entreprise */

$this->breadcrumbs = array(
    'Manage',
);

$this->menu = array(
    array('label' => 'Create Entreprise', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$('#entreprise-grid').yiiGridView('update', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Manage Entreprises</h1>



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
    'id' => 'entreprise-grid',
    'dataProvider' => $model->search(),
    'columns' => array(
        'nom',
        'adresse',
        'tva',
        'tel',
        'commune',
        'cp',
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => ' {view} {update} {delete}'
        ),
    ),
));
?>
