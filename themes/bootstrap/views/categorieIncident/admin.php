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
    array('label' => 'Create new Categorie', 'url' => array('createcat'), 'visible' => Yii::app()->session['Rights']->getCategorie() & CategorieIncidentController::ACTION_CREATE),
    array('label' => 'Create new Categorie', 'url' => array('createsouscat'), 'visible' => Yii::app()->session['Rights']->getCategorie() & CategorieIncidentController::ACTION_CREATE),
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
