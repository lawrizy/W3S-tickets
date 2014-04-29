<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
    'Users' => array('admin'),
    'Create',
);

$this->menu = array(
    array('label' => Translate::trad("GestionUtilisateurs"), 'url' => array('admin'), 'visible' => Yii::app()->session['Rights']->getUser() & UserController::ACTION_ADMIN),
);
?>

<h1><?php echo Translate::trad("CreerUtilisateur"); ?></h1>

<?php $this->renderPartial('_formCreate', array('model' => $model)); ?>
