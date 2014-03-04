<?php
/* @var $this LocataireController */
/* @var $model Locataire */



$this->menu = array(
    array('label' => Yii::t('/locataire/view', 'MenuCreerTicket'), 'url' => array('/ticket/create', 'id' => $model->id_locataire)),
//    array('label' => 'Create Locataire', ','url' => array('create')),
//    array('label' => 'Update Locataire', 'url' => array('update', 'id' => $model->id_locataire)),
//    array('label' => 'Delete Locataire', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id_locataire), 'confirm' => 'Are you sure you want to delete this item?')),
//    array('label' => 'Manage Locataire', 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t('locataire/view', 'Titre') . $model->id_locataire; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'nom',
        'email',
    ),
));
?>
