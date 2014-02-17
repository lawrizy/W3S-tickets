<?php
/* @var $this TicketController */
/* @var $model Ticket */
/* @var $form CActiveForm */
?>

<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'ticket-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Les champs marqués de <span class="required">*</span> sont requis.</p>

    <?php echo $form->errorSummary($model); ?>



    <div class="row">
        <?php echo $form->labelEx($model, 'fk_categorie'); ?>
        <?php echo $form->dropDownList($model, 'fk_categorie', array('' => '', CHtml::listData(CategorieIncident::model()->findAllByAttributes(array('fk_parent' => NULL)), 'id_categorie_incident', 'label'))); ?>
        <div id="sousCategorie">1234</div>

        <?php echo $form->error($model, 'fk_categorie'); ?>
    </div>


    <div class="row">
        <?php
        echo $form->labelEx($model, 'fk_batiment');
//        if ((Yii::app()->session['Utilisateur'] == 'Locataire')) {
//            echo $form->dropDownList($model, 'fk_batiment', array('' => '', CHtml::listData(Batiment::model()->findAllByAttributes(array('id_batiment' => Yii::app()->session['Logged']->id_locataire)), 'id_batiment', 'adresse')));
//            echo $form->error($model, 'fk_batiment');
//            $var = 0;
//            $var = Yii::app()->session['Logged'];
//        } else {
        echo $form->dropDownList($model, 'fk_batiment', array('' => '', CHtml::listData(Batiment::model()->findAll(), 'id_batiment', 'nom')));
        //}
        ?>
    </div>
    <div class="row">
        <?php
        echo $form->labelEx($model, 'Etage');
        echo'<input name="Ticket[fk_etage]" id="Ticket_fk_etage" type="text" />';
        ?>
    </div>
    <div class="row">
        <?php
        echo $form->labelEx($model, 'bureau');
        echo'<input name="Ticket[fk_bureau]" id="Ticket_fk_bureau" "type="text" />';
        ?>
    </div>
    <div class="row">
        <?php
        echo $form->labelEx($model, 'descriptif');
        echo $form->textArea($model, 'descriptif', array('maxlength' => 800, 'rows' => 5, 'cols' => 50, 'style' => 'resize:none'));
        echo $form->error($model, 'descriptif');
        ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Create'); ?>
    </div>


    <?php $this->endWidget(); ?>

</div><!-- form -->
