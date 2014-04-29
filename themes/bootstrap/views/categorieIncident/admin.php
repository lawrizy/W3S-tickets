<?php
/* @var $this CategorieIncidentController */
/* @var $model CategorieIncident */

$DroitIcone = " ";
Yii::app()->session['Rights']->getCategorie() & CategorieIncidentController::ACTION_VIEW ? $DroitIcone.=" {view}" : NULL;
Yii::app()->session['Rights']->getCategorie() & CategorieIncidentController::ACTION_UPDATE ? $DroitIcone.=" {update}" : NULL;
Yii::app()->session['Rights']->getCategorie() & CategorieIncidentController::ACTION_DELETE ? $DroitIcone.=" {delete}" : NULL;
$this->breadcrumbs = array(
    'Liste',
);

$this->menu = array(
    array('label' => Translate::trad("CreerCategorie"), 'url' => array('createcat'), 'visible' => Yii::app()->session['Rights']->getCategorie() & CategorieIncidentController::ACTION_CREATE),
    array('label' => Translate::trad("CreerSousCategorie"), 'url' => array('createsouscat'), 'visible' => Yii::app()->session['Rights']->getCategorie() & CategorieIncidentController::ACTION_CREATE),
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

<h1><?php echo Translate::trad("GestionCategorieIncident"); ?></h1>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'categorie-incident-grid',
    'dataProvider' => $model->search(),
    'columns' => array(
        array(
            'name' => 'label',
            'value' => 'Translate::trad($data->label)'
        ),
        array(
            'name' => Translate::trad("CategorieParente"),
            'value' => '$data->fkParent != null ? Translate::trad($data->fkParent->label) : \'-----\''),
        array(
            'name' => Translate::trad("Priority"),
            'value' => 'Translate::trad($data->fkPriorite->label)'),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => $DroitIcone
        ),
    ),
));
?>
