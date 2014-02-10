<?php
/* @var $this HistoriqueTicketController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Historique Tickets',
);

$this->menu = array(
    array('label' => 'Create HistoriqueTicket', 'url' => array('create')),
    array('label' => 'Manage HistoriqueTicket', 'url' => array('admin')),
);
?>

<h1>Historique Tickets</h1>

<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));
?>
