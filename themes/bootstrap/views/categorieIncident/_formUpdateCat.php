<?php
/* @var $this CategorieIncidentController */
/* @var $model CategorieIncident */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'categorie-incident-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <hr>
    <p class="note">Field with  <span class="required">*</span> are required.</p>


    <?php
    echo $form->labelEx($model, 'label');
    echo $form->textField($model, 'label', array('size' => 60, 'maxlength' => 64, 'value' => $model->label));
    echo $form->error($model, 'label', array('style' => 'color: red;'));
    ?>
    <hr>
    <?php
    echo '<label>Entreprise:  <span class=required>*</span></label>';
    echo CHtml::dropDownList('fk_entreprise', Yii::app()->session['id_entreprise'], array(CHtml::listData(Entreprise::model()->findAllByAttributes(array('visible' => Constantes::VISIBLE)), 'id_entreprise', 'nom')));
    Yii::app()->session['id_entreprise'] = NULL;
    ?>
    <hr>
    <?php
    echo $form->labelEx($model, 'fk_priorite');
    echo $form->dropDownList($model, 'fk_priorite', array(CHtml::listData(Priorite::model()->findAll(), 'id_priorite', 'label')));
    ?>

    <div class="buttons">
        <?php echo CHtml::submitButton('Mettre à jour'); ?>
    </div>
    <?php $this->endWidget(); ?>

</div><!-- form -->