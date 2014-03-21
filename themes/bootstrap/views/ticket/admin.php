
<?php
/* @var $this TicketController */
/* @var $model Ticket */

$this->breadcrumbs = array(
    'Tickets',
);

$this->menu = array(
    array('label' => Translate::trad('MenuTicketEnCours'), 'url' => array('ticket/admin?var=admin_InProgress')),
    array('label' => Translate::trad('MenuTicketNouveau'), 'url' => array('ticket/admin?var=admin_opened')),
    array('label' => Translate::trad('MenuTicketFerme'), 'url' => array('ticket/admin?var=admin_closed'))// */
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

<h1><?php echo Translate::trad('AdminTitre'); ?></h1>

<!--<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>-->

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
    'id' => 'ticket-grid',
    'dataProvider' => $model->search(),
    // 'filter' => $model,
    'columns' => array(
        array( 
            'name' => Translate::trad('CodeTicket'),
            'value' => '$data->code_ticket'),
//        array(
//            'name' => Translate::trad('LocataireTicket'),
//            'value' => 'User::model()->fi  ndByPk($data->fk_locataire)->nom'),
        array(
            'name' => Translate::trad('StatutTicket'),
            'value' => 'Translate::trad(StatutTicket::model()->findByPk($data->fk_statut)->label);'
        ),
        array(
            'name' => Translate::trad('CategTicket'),
            'value' => 'Translate::trad(CategorieIncident::model()->findByPk(CategorieIncident::model()->findByPk($data->fk_categorie)->fk_parent)->label);'
        ),
        array(
            'name' => Translate::trad('CategorieTicket'),
            'value' => 'Translate::trad(CategorieIncident::model()->findByPk($data->fk_categorie)->label);'
        ),
        array(
            'name' => Translate::trad('BatimentTicketCirc'),
            'value' => 'Batiment::model()->findByPk($data->fk_batiment)->nom'),
        array(
            'name' => Translate::trad('UserTicketCirc'),
            'value' => 'User::model()->findByPk($data->fk_user)->nom'),
        array
            (
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{view}'
        ),
    ),
));
?>

