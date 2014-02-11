<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
    'Users' => array('index'),
    $model->id_user,
);

$this->menu = array(
    array('label' => 'List User', 'url' => array('index')),
    array('label' => 'Create User', 'url' => array('create')),
    array('label' => 'Update User', 'url' => array('update', 'id' => $model->id_user)),
    array('label' => 'Delete User', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id_user), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage User', 'url' => array('admin')),
);
?>

<h1>View User #<?php echo $model->id_user; ?></h1>

<<<<<<< HEAD
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_user',
		'nom',
		'email',
		'password',
		'fk_fonction',
	),
)); ?>
=======
<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id_user',
        'nom',
        'prenom',
        'email',
        'password',
    ),
));
?>
>>>>>>> 11491a7f40938f72ce5a9d8c131056ced1d02d27
