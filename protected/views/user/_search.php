<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="wide form">

<<<<<<< HEAD
<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_user'); ?>
		<?php echo $form->textField($model,'id_user'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nom'); ?>
		<?php echo $form->textField($model,'nom',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_fonction'); ?>
		<?php echo $form->textField($model,'fk_fonction'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>
=======
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    ));
    ?>

    <div class="row">
        <?php echo $form->label($model, 'id_user'); ?>
        <?php echo $form->textField($model, 'id_user'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'nom'); ?>
        <?php echo $form->textField($model, 'nom', array('size' => 60, 'maxlength' => 64)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'prenom'); ?>
        <?php echo $form->textField($model, 'prenom', array('size' => 60, 'maxlength' => 64)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'email'); ?>
        <?php echo $form->textField($model, 'email', array('size' => 60, 'maxlength' => 64)); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

    <?php $this->endWidget(); ?>
>>>>>>> 11491a7f40938f72ce5a9d8c131056ced1d02d27

</div><!-- search-form -->