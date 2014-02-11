<?php
/* @var $this EntrepriseController */
/* @var $model Entreprise */


$this->breadcrumbs=array(
	'Entreprises'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Entreprise', 'url'=>array('index')),
	array('label'=>'Create Entreprise', 'url'=>array('create')),

);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#entreprise-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Entreprises</h1>

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

<<<<<<< HEAD:protected/views/entreprise/admin.php
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'entreprise-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_entreprise',
		'nom',
		'adresse',
		'tva',
		'commune',
		'cp',
		/*
		'tel',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
=======
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'categorie-incident-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id_categorie_incident',
        'label',
        'fk_parent',
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
>>>>>>> 11491a7f40938f72ce5a9d8c131056ced1d02d27:protected/views/categorieIncident/admin.php
