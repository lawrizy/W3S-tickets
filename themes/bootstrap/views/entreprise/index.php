<?php
/* @var $this EntrepriseController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Entreprises',
);

$this->menu=array(
	array('label'=>'Create Entreprise', 'url'=>array('create')),
	array('label'=>'Manage Entreprise', 'url'=>array('admin')),
);
?>

<h1>Entreprises</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
