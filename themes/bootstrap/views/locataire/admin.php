<?php
/* @var $this LocataireController */
/* @var $model Locataire */



$this->menu = array(
    array('label' => 'Créer un nouveau locataire', 'url' => array('/locataire/create')),

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

<h1>Choisir un locataire</h1>


<?php echo CHtml::link('Recherche avancée', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'locataire-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
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
