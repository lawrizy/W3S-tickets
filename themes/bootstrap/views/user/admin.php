<?php
/* @var $this UserController */
/* @var $model User */

$DroitIcone = " ";
Yii::app()->session['Rights']->getUser() & UserController::ACTION_VIEW ? $DroitIcone.=" {view}" : NULL;
Yii::app()->session['Rights']->getUser() & UserController::ACTION_UPDATE ? $DroitIcone.=" {update}" : NULL;
Yii::app()->session['Rights']->getUser() & UserController::ACTION_DELETE ? $DroitIcone.=" {delete}" : NULL;
$this->breadcrumbs = array(
    'Manage',
);

$this->menu = array(
    array('label' => Translate::trad('CreerUtilisateur'), 'url' => array('create'), 'visible' => Yii::app()->session['Rights']->getUser() & UserController::ACTION_CREATE),
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

<h1><?php echo Translate::trad("GestionUtilisateurs"); ?></h1>


<!--<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>-->
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
    'dataProvider' => $model->searchUserAdmin(),
    'columns' => array(
        array('name' => Translate::trad("NomLoc"),
            'value' => '$data->nom',
        ),
        array('name' => 'Email',
            'value' => '$data->email',
        ),
        array('name' => Translate::trad("FonctionUser"),
            'value' => '$data->fkFonction->label',
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => $DroitIcone
        ),
    ),
));
?>
