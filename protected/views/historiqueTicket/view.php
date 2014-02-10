<?php
/* @var $this HistoriqueTicketController */
/* @var $model HistoriqueTicket */

$this->breadcrumbs = array(
    'Historique Tickets' => array('index'),
    $model->id_historique_ticket,
);

$this->menu = array(
    array('label' => 'List HistoriqueTicket', 'url' => array('index')),
    array('label' => 'Create HistoriqueTicket', 'url' => array('create')),
    array('label' => 'Update HistoriqueTicket', 'url' => array('update', 'id' => $model->id_historique_ticket)),
    array('label' => 'Delete HistoriqueTicket', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id_historique_ticket), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage HistoriqueTicket', 'url' => array('admin')),
);
?>

<h1>View HistoriqueTicket #<?php echo $model->id_historique_ticket; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id_historique_ticket',
        'date_update',
        'commentaire',
        'fk_ticket',
        'fk_statut_ticket',
    ),
));
?>
