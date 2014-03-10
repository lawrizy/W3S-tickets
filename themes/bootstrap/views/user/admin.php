<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
    'Users' => array('admin'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List User', 'url' => array('index')),
    array('label' => 'Create User', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Users</h1>


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
    'id' => 'user-grid',
    'dataProvider' => $model->search(),
    'columns' => array(
        array('name' => 'Nom',
            'value' => '$data->nom',
        ),
        array('name' => 'Email',
            'value' => '$data->email',
        ),
        array('name' => 'Fonction',
            'value' => 'Fonction::model()->findByPk($data->fk_fonction)->label',
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => ' {view} {update} {delete}'
        ),
    ),
));
?>
