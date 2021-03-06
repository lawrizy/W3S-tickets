<?php
/* @var $this EntrepriseController */
/* @var $model Entreprise */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'entreprise-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note"><?php echo Translate::trad("Required"); ?></p>
    
        <?php echo $form->labelEx($model, 'nom'); ?>
        <?php echo $form->textField($model, 'nom', array('size' => 45, 'maxlength' => 45)); ?>
        <?php echo $form->error($model, 'nom'); ?>

        <?php echo $form->labelEx($model, 'adresse'); ?>
        <?php echo $form->textField($model, 'adresse', array('size' => 45, 'maxlength' => 45)); ?>
        <?php echo $form->error($model, 'adresse'); ?>

        <?php echo $form->labelEx($model, 'tva'); ?>
        <?php echo $form->textField($model, 'tva', array('size' => 45, 'maxlength' => 45)); ?>
        <?php echo $form->error($model, 'tva'); ?>

        <?php echo $form->labelEx($model, 'commune'); ?>
        <?php echo $form->textField($model, 'commune', array('size' => 45, 'maxlength' => 45)); ?>
        <?php echo $form->error($model, 'commune'); ?>

        <?php echo $form->labelEx($model, 'cp'); ?>
        <?php echo $form->textField($model, 'cp'); ?>
        <?php echo $form->error($model, 'cp'); ?>

        <?php echo $form->labelEx($model, 'tel'); ?>
        <?php echo $form->textField($model, 'tel', array('size' => 45, 'maxlength' => 45)); ?>
        <?php echo $form->error($model, 'tel'); ?>

    <div class="buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
