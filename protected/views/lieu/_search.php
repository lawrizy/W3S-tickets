<?php
/* @var $this LieuController */
/* @var $model Lieu */
/* @var $form CActiveForm */
?>

<div class="wide form">

<<<<<<< HEAD
<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_lieu'); ?>
		<?php echo $form->textField($model,'id_lieu',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'etage'); ?>
		<?php echo $form->textField($model,'etage'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'appartement'); ?>
		<?php echo $form->textField($model,'appartement',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_locataire'); ?>
		<?php echo $form->textField($model,'fk_locataire',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_batiment'); ?>
		<?php echo $form->textField($model,'fk_batiment'); ?>
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
        <?php echo $form->label($model, 'id_lieu'); ?>
        <?php echo $form->textField($model, 'id_lieu', array('size' => 10, 'maxlength' => 10)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'adresse'); ?>
        <?php echo $form->textField($model, 'adresse', array('size' => 60, 'maxlength' => 64)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'ville'); ?>
        <?php echo $form->textField($model, 'ville', array('size' => 60, 'maxlength' => 64)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'fk_locataire'); ?>
        <?php echo $form->textField($model, 'fk_locataire', array('size' => 10, 'maxlength' => 10)); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

    <?php $this->endWidget(); ?>
>>>>>>> 11491a7f40938f72ce5a9d8c131056ced1d02d27

</div><!-- search-form -->