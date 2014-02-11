<?php
/* @var $this LieuController */
/* @var $model Lieu */

$this->breadcrumbs = array(
    'Lieus' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Lieu', 'url' => array('index')),
    array('label' => 'Create Lieu', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#lieu-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Lieus</h1>

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

<<<<<<< HEAD
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'lieu-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_lieu',
		'etage',
		'appartement',
		'fk_locataire',
		'fk_batiment',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
=======
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'lieu-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id_lieu',
        'adresse',
        'ville',
        'fk_locataire',
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
>>>>>>> 11491a7f40938f72ce5a9d8c131056ced1d02d27