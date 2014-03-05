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
        <?php echo $form->label($model, 'code_ticket'); ?>
        <?php echo $form->textField($model, 'code_ticket', array('size' => 10, 'maxlength' => 10)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'fk_statut'); ?>
        <?php echo $form->dropDownList($model, 'fk_statut', array('' => '', CHtml::listData(StatutTicket::model()->findAll(array('condition' => 'id_statut_ticket', 'order' => 'label DESC')), 'id_statut_ticket', 'label'))); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'fk_categorie'); ?>
        <?php echo $form->dropDownList($model, 'fk_categorie', array('' => '', CHtml::listData(CategorieIncident::model()->findAllByAttributes(array('fk_parent' => NULL)), 'id_categorie_incident', 'label'))); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'fk_batiment'); ?>
        <?php echo $form->dropDownList($model, 'fk_batiment', array(Translate::trad("AllBatiment"), CHtml::listData(Batiment::model()->findAll(), 'id_batiment', 'nom'))); ?>
    </div>
    <?php if (Yii::app()->session['Logged']->fk_fonction == 2) { ?>
        <div class="row">
            <?php echo $form->label($model, 'fk_user'); ?>
            <?php echo $form->textField($model, 'fk_user', array('size' => 10, 'maxlength' => 10)); ?>
        </div>
    <?php } ?>
    <div class="row">
        <?php echo $form->label($model, 'fk_canal'); ?>
        <?php echo $form->dropDownList($model, 'fk_canal', array(Translate::trad("AllCanal"), CHtml::listData(Canal::model()->findAll(), 'id_canal', 'label'))); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

    <?php $this->endWidget(); ?>


</div><!-- search-form -->
