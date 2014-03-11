<?php

/* @var $this TradController */
/* @var $model Trad */

$this->breadcrumbs = array(
    'I18N' => array('admin'),
    'Ajouter une nouvelle traduction',
);

$this->menu = array(
    
);

//$this->renderPartial('_formCreateCat', array('model' => $model));
$this->renderPartial('_formCreateTraduction', array('model' => $model));
?>
