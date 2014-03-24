<?php
/* @var $this BatimentController */
/* @var $model Batiment */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'batiment-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note"><?php echo Translate::trad('Required'); ?></p>


    <?php echo $form->labelEx($model, 'nom'); ?>
    <?php echo $form->textField($model, 'nom', array('size' => 45, 'maxlength' => 45)); ?>
    <?php echo $form->error($model, 'nom'); ?>

    <?php echo $form->labelEx($model, 'code'); ?>
    <?php echo $form->textField($model, 'code', array('size' => 4, 'maxlength' => 4)); ?>
    <?php echo $form->error($model, 'code'); ?>

    <?php echo $form->labelEx($model, 'adresse'); ?>
    <?php echo $form->textField($model, 'adresse', array('size' => 45, 'maxlength' => 45)); ?>
    <?php echo $form->error($model, 'adresse'); ?>

    <?php echo $form->labelEx($model, 'commune'); ?>
    <?php echo $form->textField($model, 'commune', array('size' => 45, 'maxlength' => 45)); ?>
    <?php echo $form->error($model, 'commune'); ?>

    <?php echo $form->labelEx($model, 'cp'); ?>
    <?php echo $form->textField($model, 'cp'); ?>
    <?php echo $form->error($model, 'cp'); ?>

    <div class="buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->