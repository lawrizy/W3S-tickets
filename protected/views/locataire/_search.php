<?php
/* @var $this LocataireController */
/* @var $model Locataire */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

                    <div class="row">
            <?php echo $form->label($model,'id_locataire'); ?>
            <?php echo $form->textField($model,'id_locataire'); ?>
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
            <?php echo $form->label($model,'fk_langue'); ?>
            <?php echo $form->textField($model,'fk_langue'); ?>
        </div>

                    <div class="row">
            <?php echo $form->label($model,'visible'); ?>
            <?php echo $form->textField($model,'visible'); ?>
        </div>

                    <div class="row">
            <?php echo $form->label($model,'is_logged'); ?>
            <?php echo $form->textField($model,'is_logged'); ?>
        </div>

        <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->