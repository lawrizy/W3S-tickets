<?php
/* @var $this TicketController */
/* @var $model Ticket */


if (Yii::app()->session['Utilisateur'] === 'User') {
    $this->breadcrumbs = array(
        'Tickets' => array('index'),
        $model->id_ticket => array('view', 'id' => $model->id_ticket),
        'Cloturer ticket',
    );
}
?>

<h1><?php echo Translate::trad('CloseTitre'); ?> <?php echo $model->code_ticket; ?></h1>

<?php $this->renderPartial('_formClose', array('model' => $model)); ?>