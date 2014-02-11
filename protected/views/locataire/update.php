<?php
/* @var $this LocataireController */
/* @var $model Locataire */

$this->breadcrumbs = array(
    'Locataires' => array('index'),
    $model->id_locataire => array('view', 'id' => $model->id_locataire),
    'Update',
);

$this->menu = array(
    array('label' => 'List Locataire', 'url' => array('index')),
    array('label' => 'Create Locataire', 'url' => array('create')),
    array('label' => 'View Locataire', 'url' => array('view', 'id' => $model->id_locataire)),
    array('label' => 'Manage Locataire', 'url' => array('admin')),
);
?>

<h1>Update Locataire <?php echo $model->id_locataire; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>