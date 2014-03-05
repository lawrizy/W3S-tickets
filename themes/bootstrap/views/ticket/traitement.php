<?php
/* @var $this TicketController */
/* @var $model Ticket */


?>

<h1><?php echo Translate::trad('TraitementTitre') ;?><?php echo $model->code_ticket; ?></h1>
<?php $this->renderPartial('_formTraitement', array('model' => $model)); ?>