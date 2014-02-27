<?php
/* @var $this TicketController */
/* @var $model Ticket */


$this->menu = array(
    array('label' =>Yii::t('/ticket/adminClosed','MenuTicketTout'), 'url' => array('/ticket/admin/?var=admin')),
    array('label' =>Yii::t('/ticket/adminClosed','MenuTicketNouveau'), 'url' => array('/ticket/admin?var=admin_opened')),
    array('label' =>Yii::t('/ticket/adminClosed','MenuTicketInProgress'), 'url' => array('/ticket/admin?var=admin_InProgress')),
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

<h1><?php echo Yii::t('/ticket/adminClosed','AdminClosedTitre');?></h1>

<!--<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>-->

<?php echo CHtml::link(Yii::t('/ticket/adminClosed','RechercheAvancee'), '#', array('class' => 'search-button')); ?>
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
    'dataProvider' => $model->searchClosed(),
    // 'filter' => $model,
    'columns' => array(
        array(
            'name' => Yii::t('/model/ticket', 'CodeTicket'),
            'value' => '$data->code_ticket'),
        array(
            'name' => Yii::t('/model/ticket', 'LocataireTicket'),
            'value' => 'Locataire::model()->findByPk($data->fk_locataire)->nom'),
        array(
            'name' => Yii::t('/model/ticket', 'StatutTicket'),
            'value' => 'Yii::t(\'/model/statutTicket\',StatutTicket::model()->findByPk($data->fk_statut)->label);'
        ),
        array(
            'name' => Yii::t('/model/ticket', 'CategTicket'),
            'value' => 'Yii::t(\'/model/categorieIncident\',CategorieIncident::model()->findByPk(CategorieIncident::model()->findByPk($data->fk_categorie)->fk_parent)->label);'
        ),
        array(
            'name' => Yii::t('/model/ticket', 'CategorieTicket'),
            'value' => 'Yii::t(\'/model/categorieIncident\',CategorieIncident::model()->findByPk($data->fk_categorie)->label);'
        ),
        array(
            'name' => Yii::t('/model/ticket', 'BatimentTicket'),
            'value' => 'Batiment::model()->findByPk($data->fk_batiment)->nom'),
        array(
            'name' => Yii::t('/model/ticket', 'UserTicket'),
            'value' => 'User::model()->findByPk($data->fk_user)->nom'),
        array
            (
            'class' => 'CButtonColumn',
            'template' => ' {view}'
        ),
    ),
));
?>
