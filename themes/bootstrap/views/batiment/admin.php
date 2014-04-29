<?php
/* @var $this BatimentController */
/* @var $model Batiment */

$DroitIcone = " ";
Yii::app()->session['Rights']->getLocataire() & BatimentController::ACTION_VIEW ? $DroitIcone.=" {view}" : NULL;
Yii::app()->session['Rights']->getLocataire() & BatimentController::ACTION_UPDATE ? $DroitIcone.=" {update}" : NULL;
Yii::app()->session['Rights']->getLocataire() & BatimentController::ACTION_DELETE ? $DroitIcone.=" {delete}" : NULL;

$this->breadcrumbs = array(
    'Manage',
);

$this->menu = array(
    array('label' => Translate::trad("CreateBatiment"), 'url' => array('create'), 'visible' => Yii::app()->session['Rights']->getBatiment() & BatimentController::ACTION_CREATE),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$('#batiment-grid').yiiGridView('update', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1 class="h1"><?php echo Translate::trad('ManageBatiment'); ?></h1>



<?php echo CHtml::link(Translate::trad('RechercheAvancee'), '#', array('class' => 'search-button')); ?>
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
    'id' => 'batiment-grid',
    'dataProvider' => $model->search(),
    'columns' => array(
        'nom',
        'code',
        'adresse',
        'cp',
        'commune',
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => $DroitIcone
        ),
    ),
));
?>
