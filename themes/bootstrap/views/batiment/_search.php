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

<?php echo $form->label($model, 'nom'); ?>
<?php echo $form->textField($model, 'nom', array('size' => 45, 'maxlength' => 45)); ?>

<?php echo $form->label($model, 'code'); ?>
<?php echo $form->textField($model, 'code', array('size' => 4, 'maxlength' => 4)); ?>

<?php echo $form->label($model, 'cp'); ?>
<?php echo $form->textField($model, 'cp'); ?>

    

    <div class="buttons">
    <?php echo CHtml::submitButton('Search'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->