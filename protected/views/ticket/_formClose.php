<?php
/* @var $this TicketController */
/* @var $model Ticket */
/* @var $form CActiveForm */
?>
<script>
    $(function() {
        $("#anim").change(function() {
            $("#Ticket[date_intervention]").datepicker("option", "showAnim", "show");
        });
    });
</script>
<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array('id' => 'ticket-form', 'enableAjaxValidation' => false));
    ?>

    <?php echo $form->errorSummary($model); ?>


    <?php
    echo $form->labelEx($model, 'descriptif');
    echo $form->textArea($model, 'descriptif', array('maxlength' => 800, 'rows' => 5, 'cols' => 50, 'style' => 'resize:none'));
    echo $form->error($model, 'descriptif');
    ?>


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
    <br />
    <br />


    <?php $this->endWidget(); ?>

</div><!-- form -->
