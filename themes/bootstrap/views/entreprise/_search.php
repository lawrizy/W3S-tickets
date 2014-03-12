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

    <?php
    echo $form->label($model, 'nom');
    echo $form->textField($model, 'nom', array('size' => 45, 'maxlength' => 45));

    echo $form->label($model, 'tva');
    echo $form->textField($model, 'tva', array('size' => 45, 'maxlength' => 45));

    echo $form->label($model, 'cp');
    echo $form->textField($model, 'cp');
    ?>

    <div class="buttons">
    <?php echo CHtml::submitButton('Search'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->