<?php
/* @var $this TicketController */
/* @var $model Ticket */
/* @var $form CActiveForm */
?>

<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array('id' => 'ticket-form', 'enableAjaxValidation' => false));
    ?>

    <?php echo $form->errorSummary($model); ?>


   <?php echo $form->labelEx($model,'descriptif'); ?>
    <textarea maxlength="800" rows="5" cols="50" style="resize:none" name="Ticket[descriptif]" id="Ticket_descriptif"></textarea>


    <div class="row buttons">
        <?php
        $this->widget('zii.widgets.jui.CJuiButton', array(
            'buttonType' => 'submit',
            'name' => 'traitement',
            'caption' => Translate::trad('ButtonClose'),
        ));
        ?>

    </div>
    <br />
    <br />


    <?php $this->endWidget(); ?>

</div><!-- form -->
