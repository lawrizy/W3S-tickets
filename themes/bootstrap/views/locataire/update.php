<?php
/* @var $this LocataireController */
/* @var $model Locataire */

$this->breadcrumbs = array(
    'Locataires' => array('admin'),
    $model->nom => array('view', 'id' => $model->id_user),
    'Update',
);

$this->menu = array(
    array('label' => 'Détails Locataire', 'url' => array('view', 'id' => $model->id_user)),
    array('label' => 'Liste Locataire', 'url' => array('admin')),
);
?>

<h1>Update Locataire <?php echo $model->nom; ?></h1>

<?php $this->renderPartial('_formUpdate', array('model' => $model)); ?>