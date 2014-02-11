<?php
/* @var $this LieuController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Lieus',
);

$this->menu = array(
    array('label' => 'Create Lieu', 'url' => array('create')),
    array('label' => 'Manage Lieu', 'url' => array('admin')),
);
?>

<h1>Lieus</h1>

<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));
?>
