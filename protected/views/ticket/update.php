<?php
/* @var $this TicketController */
/* @var $model Ticket */


if (Yii::app()->session['Utilisateur'] === 'User') {
    $this->breadcrumbs = array(
        'Tickets' => array('index'),
        $model->id_ticket => array('view', 'id' => $model->id_ticket),
        'Update',
    );
}
?>

<h1>Mettre à jour un ticket<?php echo $model->id_ticket; ?></h1>

<?php $this->renderPartial('_formUpdate', array('model' => $model)); ?>