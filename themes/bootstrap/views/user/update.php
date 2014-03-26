<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
    'Users' => array('admin'),
    $model->nom => array('view', 'id' => $model->id_user),
    'Update',
);

$this->menu = array(
    array('label' => 'Détails de l\'utilisateur', 'url' => array('view', 'id' => $model->id_user),'visible'=>  Yii::app()->session['Rights']->getUser()& UserController::ACTION_VIEW),
    array('label' => 'Manage User', 'url' => array('admin'),'visible'=>  Yii::app()->session['Rights']->getUser()& UserController::ACTION_ADMIN),
);
?>

<h1>Update <?php echo $model->nom; ?></h1>

<?php $this->renderPartial('_formUpdate', array('model' => $model)); ?>