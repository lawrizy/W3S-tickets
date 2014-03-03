<?php
/* @var $this EntrepriseController */
/* @var $model Entreprise */
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
<?php echo $form->label($model, 'tva'); ?>
<?php echo $form->textField($model, 'tva', array('size' => 45, 'maxlength' => 45)); ?>
    </div>

    <div class="row">
<?php echo $form->label($model, 'cp'); ?>
<?php echo $form->textField($model, 'cp'); ?>
    </div>

    <div class="row">
<?php echo $form->label($model, 'tel'); ?>
<?php echo $form->textField($model, 'tel', array('size' => 45, 'maxlength' => 45)); ?>
    </div>

    <div class="row buttons">
    <?php echo CHtml::submitButton('Search'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->