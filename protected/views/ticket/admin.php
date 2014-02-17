<?php
/* @var $this TicketController */
/* @var $model Ticket */


$this->menu = array(
    array('label' => 'Recherche locataire', 'url' => array('/locataire/admin')), //*
          array('label' => 'Lister les tickets ouverts', 'url' => array('ticket/admin?var=admin_opened')),
          array('label' => 'Lister les tickets en cours de traitement', 'url' => array('ticket/admin?var=admin_InProgress')),
          array('label' => 'Lister les tickets en fermés', 'url' => array('ticket/admin?var=admin_closed'))// */
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

<h1>Tous les tickets</h1>

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
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'ticket-grid',
    'dataProvider' => $model->search(),
    // 'filter' => $model,
    'columns' => array(
        'id_ticket',
        array(
            'name' => 'fk_statut',
            'value' => 'StatutTicket::model()->findByPk($data->fk_statut)->label'
        ),
        array(
            'name' => 'fk_categorie',
            'value' => 'CategorieIncident::model()->findByPk($data->fk_categorie)->label'),
        array(
            'name' => 'fk_batiment',
            'value' => 'Batiment::model()->findByPk($data->fk_batiment)->adresse'),
        array(
            'name' => 'fk_user',
            'value' => 'User::model()->findByPk($data->fk_user)->nom'),
        /*
          'commentaire',
          'fk_canal',
         */
        array
            (
            'class' => 'CButtonColumn',
            'template' => '{update} {view}',
            'visible' => Yii::app()->session['Utilisateur'] == 'User'
        ),
    ),
));
?>
