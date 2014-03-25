<?php
/* @var $this UserController */
/* @var $model User */

$DroitIcone = " ";
Yii::app()->session['Rights']->getLocataire() & UserController::ACTION_VIEW ? $DroitIcone.=" {view}" : NULL;
Yii::app()->session['Rights']->getLocataire() & UserController::ACTION_UPDATE ? $DroitIcone.=" {update}" : NULL;
Yii::app()->session['Rights']->getLocataire() & UserController::ACTION_DELETE ? $DroitIcone.=" {delete}" : NULL;
$this->breadcrumbs = array(
    'Manage',
);

$this->menu = array(
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
$model->visible = Constantes::VISIBLE;
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'user-grid',
    'type' => 'striped condensed bordered',
    'dataProvider' => $model->search(),
    'columns' => array(
        array('name' => 'Nom',
            'value' => '$data->nom',
        ),
        array('name' => 'Email',
            'value' => '$data->email',
        ),
        array('name' => 'Fonction',
            'value' => '$data->fkFonction->label',
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => $DroitIcone
        ),
    ),
));
?>
