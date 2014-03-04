<?php
/* @var $this BatimentController */
/* @var $model Batiment */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    ));
    ?>

    <div class="row">
        <?php echo $form->label($model, 'nom'); ?>
        <?php echo $form->textField($model, 'nom', array('size' => 45, 'maxlength' => 45)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'code'); ?>
        <?php echo $form->textField($model, 'code', array('size' => 4, 'maxlength' => 4)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'cp'); ?>
        <?php echo $form->textField($model, 'cp'); ?>
    </div>



    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->