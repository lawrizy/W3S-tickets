<?php
/* @var $this HistoriqueTicketController */
/* @var $model HistoriqueTicket */

$this->breadcrumbs=array(
	'Historique Tickets'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List HistoriqueTicket', 'url'=>array('index')),
	array('label'=>'Create HistoriqueTicket', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#historique-ticket-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Historique Tickets</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'historique-ticket-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_historique_ticket',
		'date_update',
		'commentaire',
		'id_ticket',
		'id_statut_ticket',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
