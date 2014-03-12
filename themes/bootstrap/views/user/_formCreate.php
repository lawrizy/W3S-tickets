<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>
<br>
<div class="table-bordered">
    <div class="form">


        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'user-form',
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'enableAjaxValidation' => false,
        ));
        ?>

        <p class="note">Les champs marqués de <span class="required">*</span> sont requis.</p>


        <?php echo $form->labelEx($model, 'nom'); ?>
        <?php echo $form->textField($model, 'nom', array('size' => 60, 'maxlength' => 64)); ?>
        <?php echo $form->error($model, 'nom'); ?>

        <?php echo $form->labelEx($model, 'email'); ?>
        <?php echo $form->textField($model, 'email', array('size' => 60, 'maxlength' => 64)); ?>
        <?php echo $form->error($model, 'email'); ?>

        <?php echo $form->labelEx($model, 'password'); ?>
        <?php echo $form->passwordField($model, 'password', array('size' => 32, 'maxlength' => 32)); ?>
        <?php echo $form->error($model, 'password'); ?>

        <?php echo $form->labelEx($model, 'fk_fonction'); ?>
        <?php echo $form->textField($model, 'fk_fonction'); ?>
        <?php echo $form->error($model, 'fk_fonction'); ?>
        <br>
        <?php echo CHtml::submitButton('Create'); ?>

        <?php $this->endWidget(); ?>
    </div>
</div><!-- form -->