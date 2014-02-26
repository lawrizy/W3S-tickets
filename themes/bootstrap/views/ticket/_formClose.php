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


    <label for="Ticket_descriptif">Descriptif</label>
    <textarea maxlength="800" rows="5" cols="50" style="resize:none" name="Ticket[descriptif]" id="Ticket_descriptif"></textarea>


    <div class="row buttons">
        <?php
        $this->widget('zii.widgets.jui.CJuiButton', array(
            'buttonType' => 'submit',
            'name' => 'traitement',
            'caption' => 'Cloturer le ticket',
        ));
        ?>

    </div>
    <br />
    <br />


    <?php $this->endWidget(); ?>

</div><!-- form -->
