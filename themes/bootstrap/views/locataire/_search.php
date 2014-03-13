<?php
/* @var $this LocataireController */
/* @var $model Locataire */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    ));
    ?>

    <?php
    echo $form->label($model, 'nom');
    echo $form->textField($model, 'nom', array('size' => 60, 'maxlength' => 64));

    echo $form->label($model, 'email');
    echo $form->textField($model, 'email', array('size' => 60, 'maxlength' => 64));

    echo $form->label($model, 'fk_langue');
    echo $form->textField($model, 'fk_langue');
    ?>

    <div class="buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->