<?php
/* @var $this TicketController */
/* @var $dataProvider CActiveDataProvider */


$this->menu = array(
    array('label' => 'Create Ticket', 'url' => array('create')),
    array('label' => 'Manage Ticket', 'url' => array('admin')),
);
?>

<h1>Tickets</h1>

<?php
$model = new Ticket();
$model->fk_locataire;
    $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'ticket-grid',
    'dataProvider' => $model->searchByLocataire($model->fk_locataire),
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
        array
            (
            'class' => 'CButtonColumn',
            'template' => ' {view}'
        ),
    ),
));
?>
