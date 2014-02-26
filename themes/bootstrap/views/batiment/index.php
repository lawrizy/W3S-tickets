<?php
/* @var $this BatimentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Batiments',
);

$this->menu=array(
	array('label'=>'Create Batiment', 'url'=>array('create')),
	array('label'=>'Manage Batiment', 'url'=>array('admin')),

);
?>

<h1>Batiments</h1>

<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));
?>
