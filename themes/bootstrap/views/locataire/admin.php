<?php
/* @var $this LocataireController */
/* @var $model Locataire */



$this->menu = array(
    array('label' => Translate::tradPetit('MenuTitre'), 'url' => array('/locataire/create')),

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

<h1><?php echo Translate::tradPetit(    'AdminTitre') ?></h1>


<?php echo CHtml::link(Translate::tradPetit('RechercheAvancee'), '#', array('class' => 'search-button')); ?>
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
        array
            (
            'class' => 'CButtonColumn',
            'template' => '{view}',
            'visible' => Yii::app()->session['Utilisateur'] == 'User'
        ),
    ),
));
?>
