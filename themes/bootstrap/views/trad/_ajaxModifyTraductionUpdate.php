<?php
/* @var $this TradController */
/* @var $model Trad */
/* @var $form CActiveForm */

$form = $_POST['TradForm'];
$model = $_POST['TradModel'];

echo $form->labelEx($model, 'fr');
echo $form->textArea($model, 'fr');
echo $form->error($model, 'fr');

echo $form->labelEx($model, 'en');
echo $form->textArea($model, 'en');
echo $form->error($model, 'en');

echo $form->labelEx($model, 'nl');
echo $form->textArea($model, 'nl');
echo $form->error($model, 'nl');
?>
