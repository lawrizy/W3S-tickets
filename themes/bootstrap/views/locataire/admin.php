<?php
/* @var $this LocataireController */
/* @var $model Locataire */



$this->menu = array(
    array('label' => Translate::trad('CreerLocataire'), 'url' => array('/locataire/create')),
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

<h1><?php echo Translate::trad('ListLocataire') ?></h1>


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
    'id' => 'locataire-grid',
    'dataProvider' => $model->search(),
    'columns' => array(
        'nom',
        'email',
        array
            (
            'class' => 'CButtonColumn',
            'template' => '{view}',
            'visible' => Yii::app()->session['Utilisateur'] == 'User'
        ),
    ),
));
?>
