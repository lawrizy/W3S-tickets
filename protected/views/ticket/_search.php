<?php
/* @var $this TicketController */
/* @var $model Ticket */
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
        <?php echo $form->label($model, 'id_ticket'); ?>
        <?php echo $form->textField($model, 'id_ticket', array('size' => 10, 'maxlength' => 10)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'fk_statut'); ?>
        <?php echo $form->dropDownList($model, 'fk_statut', array('' => '', CHtml::listData(StatutTicket::model()->findAll(array('condition'=>'id_statut_ticket','order' => 'label DESC')),'id_statut_ticket', 'label'))); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'fk_categorie'); ?>
        <?php echo $form->textField($model, 'fk_categorie', array('size' => 10, 'maxlength' => 10)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'fk_batiment'); ?>
        <?php echo $form->textField($model, 'fk_batiment', array('size' => 10, 'maxlength' => 10)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'fk_user'); ?>
        <?php echo $form->textField($model, 'fk_user', array('size' => 10, 'maxlength' => 10)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'descriptif'); ?>
        <?php echo $form->textArea($model, 'descriptif', array('rows' => 6, 'cols' => 50)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'fk_canal'); ?>
        <?php echo $form->textField($model, 'fk_canal'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

    <?php $this->endWidget(); ?>


</div><!-- search-form -->