<?php
/* @var $this LocataireController */
/* @var $model Locataire */
$DroitIcone = " ";
Yii::app()->session['Rights']->getLocataire() & LocataireController::ACTION_VIEW ? $DroitIcone.=" {view}" : NULL;
Yii::app()->session['Rights']->getLocataire() & LocataireController::ACTION_UPDATE ? $DroitIcone.=" {update}" : NULL;
Yii::app()->session['Rights']->getLocataire() & LocataireController::ACTION_DELETE ? $DroitIcone.=" {delete}" : NULL;
$this->breadcrumbs = array(
    'Manage',
);

$this->menu = array(
    array('label' => Translate::trad("AjouterLocataire"), 'url' => array('create'), 'visible' => Yii::app()->session['Rights']->getLocataire() & LocataireController::ACTION_CREATE),
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

<h1><?php echo Translate::trad("ManageLocataire"); ?></h1>


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
    'dataProvider' => $model->searchLocataire(),
    'columns' => array(
        array('name' => Translate::trad("NomLoc"),
            'value' => '$data->nom;'
        ),
        array('name' => 'Email',
            'value' => '$data->email;'
        ),
        array('name' => Translate::trad("Langue"),
            'value' => 'Langue::model()->findByPk($data->fk_langue)->label;'
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => $DroitIcone
        ),
    ),
));
?>
