<?php
/* @var $this TicketController */
/* @var $model Ticket */


$this->menu = array(
    array('label' => Translate::trad('MenuTicketTout'), 'url' => array('/ticket/admin/?var=admin')),
    array('label' => Translate::trad('MenuTicketEnCours'), 'url' => array('ticket/admin?var=admin_InProgress')),
    array('label' => Translate::trad('MenuTicketFerme'), 'url' => array('ticket/admin?var=admin_closed')),
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

<h1><?php echo Translate::trad('AdminOpenedTitre');
?></h1>
<!--
<p>
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
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'ticket-grid',
    'dataProvider' => $model->searchOpened(),
    // 'filter' => $model,
    'columns' => array(
        array(
            'name' => Translate::trad('CodeTicket'),
            'value' => '$data->code_ticket'),
        array(
            'name' => Translate::trad('LocataireTicket'),
            'value' => 'Locataire::model()->findByPk($data->fk_locataire)->nom'),
        array(
            'name' => Translate::trad('StatutTicket'),
            'value' => 'Translate::tradPetit(StatutTicket::model()->findByPk($data->fk_statut)->label);'
        ),
        array(
            'name' => Translate::trad('CategTicket'),
            'value' => 'Translate::tradMoyen(CategorieIncident::model()->findByPk(CategorieIncident::model()->findByPk($data->fk_categorie)->fk_parent)->label);'
        ),
        array(
            'name' => Translate::trad('CategorieTicket'),
            'value' => 'Translate::tradMoyen(CategorieIncident::model()->findByPk($data->fk_categorie)->label);'
        ),
        array(
            'name' => Translate::trad('BatimentTicketCirc'),
            'value' => 'Batiment::model()->findByPk($data->fk_batiment)->nom'),
        array(
            'name' => Translate::trad('UserTicketCirc'),
            'value' => 'User::model()->findByPk($data->fk_user)->nom'),
        array
            (
            'class' => 'CButtonColumn',
            'template' => ' {view}'
        ),
    ),
));
?>