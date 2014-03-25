<?php
/* @var $this LocataireController */
/* @var $model Locataire */

$this->breadcrumbs = array(
    'Locataires' => array('admin'),
    $model->nom,
);

$this->menu = array(
    //   array('label' => 'Update Locataire', 'url' => array('update', 'id' => $model->id_locataire)),
    array('label' => Translate::trad('CreerTicket'), 'url' => array('ticket/create?id=' . $model->id_user),
        'visible' => Yii::app()->session['Rights']->getLocataire() & LocataireController::ACTION_CREATE),
    array('label' => Translate::trad('DeleteLocataire'), 'url' => '#',
        'linkOptions' => array('submit' => array('delete', 'id' => $model->id_user), 'confirm' => 'Are you sure you want to delete this item?',
            'visible' => Yii::app()->session['Rights']->getLocataire() & LocataireController::ACTION_DELETE)),
    array('label' => Translate::trad('ManageLocataire'), 'url' => array('admin'),
        'visible' => Yii::app()->session['Rights']->getLocataire() & LocataireController::ACTION_ADMIN),
    array('label' => Translate::trad('Rajouterlieu'), 'url' => array('locataire/addLieu?id=' . $model->id_user),
        'visible' => Yii::app()->session['Rights']->getLocataire() & LocataireController::ACTION_UPDATE),
    array('label' => Translate::trad('Supprimerlieu'), 'url' => array('locataire/deleteLieu?id=' . $model->id_user),
        'visible' => Yii::app()->session['Rights']->getLocataire() & LocataireController::ACTION_UPDATE),
    array('label' => Translate::trad('ChangerDroits'), 'url' => array('admin/update?id=' . $model->id_user),
        'visible' => Yii::app()->session['Rights']->getLocataire() & LocataireController::ACTION_UPDATE),
);
?>

<h1>Locataire:&nbsp;<?php echo $model->nom; ?></h1>

<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'type' => 'striped condensed bordered',
    'data' => $model,
    'attributes' => array(
        array(
            'name' => 'Email',
            'value' => $model->email,
        ),
        array(
            'name' => 'Langue',
            'value' => Langue::model()->findByPk($model->fk_langue)->label
        ),
    ),
));
?>
