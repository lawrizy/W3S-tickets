<?php
/* @var $this TicketController */
/* @var $model Ticket */
/* @var $form CActiveForm */
?>

<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array('id' => 'ticket-form', 'enableAjaxValidation' => false));
    ?>

   <?php echo $form->labelEx($model,'descriptif'); ?>
    <textarea maxlength="800" rows="5" cols="50" style="resize:none" name="Ticket[descriptif]" id="Ticket_descriptif"></textarea>


    <div class="buttons">
        <?php
        echo CHtml::submitButton(Translate::trad('ButtonClose'), array('onClick' => 'antiSpam(this);'));
        ?>

    </div>
    <br />
    <br />


    <?php $this->endWidget(); ?>
    
</div><!-- form -->

<script>
    function antiSpam(button)
    {
        button.disabled = true;
        button.form.submit();
    }
</script>
