<?php
/* @var $this BatimentController */
/* @var $dataProvider CActiveDataProvider */

<<<<<<< HEAD:protected/views/batiment/index.php
$this->breadcrumbs=array(
	'Batiments',
);

$this->menu=array(
	array('label'=>'Create Batiment', 'url'=>array('create')),
	array('label'=>'Manage Batiment', 'url'=>array('admin')),
=======
$this->breadcrumbs = array(
    'Statut Tickets',
);

$this->menu = array(
    array('label' => 'Create StatutTicket', 'url' => array('create')),
    array('label' => 'Manage StatutTicket', 'url' => array('admin')),
>>>>>>> 11491a7f40938f72ce5a9d8c131056ced1d02d27:protected/views/statutTicket/index.php
);
?>

<h1>Batiments</h1>

<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));
?>
