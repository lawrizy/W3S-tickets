<?php
/* @var $this LocataireController */
/* @var $model Locataire */




?>

<h1><?php echo Translate::trad('TitreCreateLocataire') ; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>