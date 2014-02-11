<?php
/* @var $this BatimentController */
/* @var $model Batiment */
/* @var $form CActiveForm */
?>

<div class="form">

<<<<<<< HEAD:protected/views/batiment/_form.php
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'batiment-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'adresse'); ?>
		<?php echo $form->textField($model,'adresse',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'adresse'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'commune'); ?>
		<?php echo $form->textField($model,'commune',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'commune'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cp'); ?>
		<?php echo $form->textField($model,'cp'); ?>
		<?php echo $form->error($model,'cp'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>
=======
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'categorie-incident-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'label'); ?>
        <?php echo $form->textField($model, 'label', array('size' => 60, 'maxlength' => 64)); ?>
        <?php echo $form->error($model, 'label'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'fk_parent'); ?>
        <?php echo $form->textField($model, 'fk_parent', array('size' => 10, 'maxlength' => 10)); ?>
        <?php echo $form->error($model, 'fk_parent'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>
>>>>>>> 11491a7f40938f72ce5a9d8c131056ced1d02d27:protected/views/categorieIncident/_form.php

</div><!-- form -->