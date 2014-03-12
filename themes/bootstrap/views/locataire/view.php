<?php
/* @var $this LocataireController */
/* @var $model Locataire */

$this->breadcrumbs = array(
    'Locataires' => array('admin'),
    $model->id_locataire,
);

$this->menu = array(
    //   array('label' => 'Update Locataire', 'url' => array('update', 'id' => $model->id_locataire)),
    array('label' => 'Créer un ticket', 'url' => array('ticket/create?id=' . $model->id_locataire)),
    array('label' => 'Delete Locataire', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id_locataire), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Locataire', 'url' => array('admin')),
    array('label' => 'Rajouter un lieu', 'url' => array('locataire/addLieu?id='.$model->id_locataire)),
    array('label' => 'Supprimer un lieu', 'url' => array('locataire/deleteLieu?id=' . $model->id_locataire)),
);
?>

<h1>Locataire:&nbsp;<?php echo $model->nom; ?></h1>

<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'type' => 'striped condensed bordered',
    'data' => $model,
    'attributes' => array(
        'email',
        array(
            'name' => 'Langue',
            'value' => Langue::model()->findByPk($model->fk_langue)->label
        ),
    ),
));
?>
