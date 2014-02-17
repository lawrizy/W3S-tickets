<?php
/* @var $this TicketController */
/* @var $model Ticket */
/* @var $form CActiveForm */
?>

<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'ticket-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Les champs marqués de <span class="required">*</span> sont requis.</p>

    <?php echo $form->errorSummary($model); ?>



    <?php
// Affichage de la sélection des entreprises
    echo $form->labelEx($model, 'fk_entreprise');
    echo $form->dropDownList($model, 'fk_entreprise', array('' => '', CHtml::listData(Entreprise::model()->findAll(), 'id_entreprise', 'nom')));
// Yii::trace(CVarDumper::dumpAsString($theData), 'cron');
    echo $form->error($model, 'fk_entreprise');
    ?>

    <div class="row">
        <?php
        echo $form->labelEx($model, 'date_intervention');
        echo $form->textField($model, 'date_intervention', array('maxlength' => 800, 'rows' => 5, 'cols' => 50, 'style' => 'resize:none'));
        echo $form->error($model, 'descriptif');
        ?>
    </div>

    <div class="row">
        <!-- Div pour la PRIORITE -->
        <!-- Champs caché -->
        <!-- TODO Priorité -->
    </div>


    <div class="row buttons">
        <?php
        $this->widget('zii.widgets.jui.CJuiButton', array(
            'buttonType' => 'submit',
            'name' => 'traitement',
            'caption' => 'Passer en InProgress',
        ));
//---------------------------------

        
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
