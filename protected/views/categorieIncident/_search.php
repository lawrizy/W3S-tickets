<?php
/* @var $this CategorieIncidentController */
/* @var $model CategorieIncident */
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
<?php echo $form->label($model, 'label'); ?>
<?php echo $form->textField($model, 'label', array('size' => 60, 'maxlength' => 64)); ?>
    </div>

    <div class="row">
<?php echo $form->label($model, 'fk_parent'); ?>
<?php echo $form->textField($model, 'fk_parent'); ?>
    </div>

    <div class="row">
<?php echo $form->label($model, 'fk_priorite'); ?>
<?php echo $form->textField($model, 'fk_priorite'); ?>
    </div>

    <div class="row buttons">
    <?php echo CHtml::submitButton('Search'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->