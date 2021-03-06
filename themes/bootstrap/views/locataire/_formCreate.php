<?php
/* @var $this LocataireController */
/* @var $model Locataire */
/* @var $form CActiveForm */
?>


<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'locataire-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note"><?php echo Translate::trad("Required"); ?></p>


    <?php echo $form->labelEx($model, 'nom'); ?>
    <?php echo $form->textField($model, 'nom', array('size' => 60, 'maxlength' => 64)); ?>
    <?php echo $form->error($model, 'nom', array('style' => 'color: red;')); ?>

    <?php echo $form->labelEx($model, 'email'); ?>
    <?php echo $form->textField($model, 'email', array('size' => 60, 'maxlength' => 64)); ?>
    <?php echo $form->error($model, 'email', array('style' => 'color: red;')); ?>

    <?php echo $form->labelEx($model, 'password'); ?>
    <?php echo $form->passwordField($model, 'password', array('size' => 32, 'maxlength' => 32)); ?>
    <?php echo $form->error($model, 'password', array('style' => 'color: red;')); ?>

    <?php echo $form->labelEx($model, 'fk_langue'); ?>
    <?php echo $form->dropDownList($model, 'fk_langue', array('' => '', 
        CHtml::listData(Langue::model()->findAll(), 'id', 'label')), array('class' => 'toolbar')); ?>
    <?php echo $form->error($model, 'fk_langue', array('style' => 'color: red;')); ?>

    <div class="controls">
        <?php echo CHtml::submitButton('Create'); ?>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- form -->
