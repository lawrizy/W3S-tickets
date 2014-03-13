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

    <?php
    echo $form->label($model, 'label');
    echo $form->textField($model, 'label', array('size' => 60, 'maxlength' => 64));

    echo $form->label($model, 'fk_parent');
    echo $form->dropDownList($model, 'fk_parent', array('' => '', CHtml::listData(CategorieIncident::model()->findAllByAttributes(array('fk_parent' => NULL, 'visible' => Constantes::VISIBLE)), 'id_categorie_incident', 'label')));

    echo $form->label($model, 'fk_priorite');
    echo $form->dropDownList($model, 'fk_priorite', array('' => '', CHtml::listData(Priorite::model()->findAll(), 'id_priorite', 'label')));
    ?>

    <div class="buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->