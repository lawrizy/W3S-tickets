<?php
/* @var $this TicketController */
/* @var $model Ticket */



$this->menu = array(
    array('label' => 'Recherche locataire', 'url' => array('/locataire/admin')),
    array('label' => 'Lister tous les tickets ', 'url' => array('/ticket/admin/?var=admin')),
    array('label' => 'Lister les nouveaux tickets s', 'url' => array('/ticket/admin?var=admin_opened')),
    array('label' => 'Lister les tickets fermés', 'url' => array('/ticket/admin?var=admin_closed')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#ticket-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1> Tickets en cours de traitement</h1>
<!--
<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>-->

<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'ticket-grid',
    'dataProvider' => $model->searchInProgress(),
    // 'filter' => $model,
    'columns' => array(
        array(
            'name' => 'Code ticket',
            'value' => '$data->code_ticket'),
        array(
            'name' => 'Locataire',
            'value' => 'Locataire::model()->findByPk($data->fk_locataire)->nom'),
        array(
            'name' => 'Statut du ticket',
            'value' => 'StatutTicket::model()->findByPk($data->fk_statut)->label'
        ),
        array(
            'name' => 'Cat&eacute;gorie',
            'value' => 'CategorieIncident::model()->findByPk(CategorieIncident::model()->findByPk($data->fk_categorie)->fk_parent)->label'),
        array(
            'name' => 'Sous - Cat&eacute;gorie',
            'value' => 'CategorieIncident::model()->findByPk($data->fk_categorie)->label'),
        array(
            'name' => 'B&acirc;timent',
            'value' => 'Batiment::model()->findByPk($data->fk_batiment)->nom'),
        array(
            'name' => 'Assign&eacute; &agrave;',
            'value' => 'User::model()->findByPk($data->fk_user)->nom'),
        /*
          'commentaire',
          'fk_canal',
         */
        array
            (
            'class' => 'CButtonColumn',
            'template' => ' {view}'
        ),
    ),
));
?>
