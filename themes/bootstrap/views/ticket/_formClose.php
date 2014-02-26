<?php
/* @var $this TicketController */
/* @var $model Ticket */
/* @var $form CActiveForm */
?>

<div class="form">
    <?php
    $form = $this->beginWidget(
        'bootstrap.widgets.TbActiveForm',
        array(
            'id' => 'ticket-form',
            'htmlOptions' => array(),
        )
    );
    ?>

    <?php echo $form->errorSummary($model); ?>

    <?php
    $form->widget(
        'bootstrap.widgets.TbLabel',
        array(
            'type' => 'info',
            'label' => 'Descriptif',
        )
    );

    ?>
    <br/><br/>
    <textarea maxlength="800" rows="5" cols="50" style="resize:none" name="Ticket[descriptif]"
              id="Ticket_descriptif"></textarea>

    <br/>
    <?php
    $this->widget('zii.widgets.jui.CJuiButton', array(
        'buttonType' => 'submit',
        'name' => 'traitement',
        'caption' => 'Cloturer le ticket',
    ));
    ?>
    <br/>
    <br/>


    <?php $this->endWidget(); ?>

</div><!-- form -->
