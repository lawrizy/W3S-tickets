<?php
/* @var $this LocataireController */
/* @var $model Locataire */




?>

<h1><?php echo Translate::tradPetit('TitreCreateLocataire') ; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>