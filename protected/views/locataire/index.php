<?php
/* @var $this LocataireController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Locataires',
);

$this->menu=array(
array('label'=>'Create Locataire', 'url'=>array('create')),
array('label'=>'Manage Locataire', 'url'=>array('admin')),
);
?>

<h1>Locataires</h1>

<?php $this->widget('zii.widgets.CListView', array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
