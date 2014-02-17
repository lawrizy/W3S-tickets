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

<h1>Update Ticket <?php echo $model->id_ticket; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>