
<?php
/* @var $this TicketController */
/* @var $model Ticket */


$this->menu = array(
    array('label' => Translate::tradPetit('MenuTicketEnCours'), 'url' => array('ticket/admin?var=admin_InProgress')),
    array('label' => Translate::tradPetit('MenuTicketNouveau'), 'url' => array('ticket/admin?var=admin_opened')),
    array('label' => Translate::tradPetit('MenuTicketFerme'), 'url' => array('ticket/admin?var=admin_closed'))// */
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

<h1><?php echo Translate::tradPetit('AdminTitre'); ?></h1>

<!--<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>-->

<?php echo CHtml::link(Translate::tradPetit('RechercheAvancee'), '#', array('class' => 'search-button')); ?>
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
        array(
            'name' => Translate::tradPetit('CodeTicket'),
            'value' => '$data->code_ticket'),
        array(
            'name' => Translate::tradPetit('LocataireTicket'),
            'value' => 'Locataire::model()->findByPk($data->fk_locataire)->nom'),
        array(
            'name' => Translate::tradPetit('StatutTicket'),
            'value' => 'Translate::tradPetit(StatutTicket::model()->findByPk($data->fk_statut)->label);'
        ),
        array(
            'name' => Translate::tradPetit('CategTicket'),
            'value' => 'Translate::tradMoyen(CategorieIncident::model()->findByPk(CategorieIncident::model()->findByPk($data->fk_categorie)->fk_parent)->label);'
        ),
        array(
            'name' => Translate::tradPetit('CategorieTicket'),
            'value' => 'Translate::tradMoyen(CategorieIncident::model()->findByPk($data->fk_categorie)->label);'
        ),
        array(
            'name' => Translate::tradPetit('BatimentTicketCirc'),
            'value' => 'Batiment::model()->findByPk($data->fk_batiment)->nom'),
        array(
            'name' => Translate::tradPetit('UserTicketCirc'),
            'value' => 'User::model()->findByPk($data->fk_user)->nom'),
        array
            (
            'class' => 'CButtonColumn',
            'template' => ' {view}'
        ),
    ),
));
?>
