<?php
/* @var $this TicketController */
/* @var $model Ticket */


?>

<h1><?php echo Yii::t('/ticket/traitement','TraitementTitre') ;?><?php echo $model->code_ticket; ?></h1>
<?php $this->renderPartial('_formTraitement', array('model' => $model)); ?>