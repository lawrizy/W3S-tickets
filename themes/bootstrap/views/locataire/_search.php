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
    echo $form->dropDownList($model, 'fk_langue', array('' => '', CHtml::listData(Langue::model()->findAll(), 'id', 'label')));
    ?>

    <div class="buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->