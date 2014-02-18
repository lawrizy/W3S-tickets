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
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'Ticket[date_intervention]',
            'id' => 'Ticket_date_intervention',
            // additional javascript options for the date picker plugin
            'options' => array(
                'dateFormat' => 'yy/mm/dd',
                'showAnim' => 'show', //'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                'changeMonth' => true,
                'changeYear' => true,
                'minDate' => date('Y/m/d'), // minimum date
            ),
            'htmlOptions' => array(
                'style' => 'height:20px;',
            ),
        ));
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
    <br />
    <br />


    <?php $this->endWidget(); ?>

</div><!-- form -->
