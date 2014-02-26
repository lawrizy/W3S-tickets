<?php
/* @var $this TicketController */
/* @var $model Ticket */
/* @var $form CActiveForm */
?>
<script>
    $(function() { // fonction JQuery permettant d'afficher le datePicker
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
    echo '<label>Entreprise <span class="required">*</span></label>';
    echo $form->dropDownList($model, 'fk_entreprise', array('' => '', CHtml::listData(Entreprise::model()->findAll(), 'id_entreprise', 'nom')));
        // Affiche la liste des entreprises que l'on peut assigner à ce ticket
    echo $form->error($model, 'fk_entreprise');
    ?>

    <div class="row">
        <label>Date d'intervention <span class="required">*</span></label>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array( // Widget permettant d'afficher un datePicker
            'name' => 'Ticket[date_intervention]',
            'id' => 'Ticket_date_intervention',
            // Le datePicker utilise du javascript, voir la function plus haut
            'options' => array(
                'dateFormat' => 'yy/mm/dd', // Permet de définir le format d'affichage de la date
                'showAnim' => 'show', // Affiche une animation à l'affichage du datePicker, choix entre tout ce qu'il y a en commentaire en-dessous
                //'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                
                'changeMonth' => true, // Affiche une comboBox permettant de sélectionner un mois directement
                'changeYear' => true, // Affiche une comboBox permettant de sélectionner une année directement
                'minDate' => date('Y/m/d'), // Toutes les dates avant celle-ci ne seront pas sélectionnables
                'htmlOptions' => array(
                    'readonly' => 'readonly',
                    'style' => 'height:20px;',
                    'size' => 43),
            ))
        );
        ?>
    </div>
</div>

<div class="row buttons">
    <?php
    $this->widget('zii.widgets.jui.CJuiButton', array(
        'buttonType' => 'submit', // Type de bouton
        'name' => 'traitement', // L'action à lancer (ne pas oublier les rules dans le controleur)
        'caption' => 'Passer en Traitement', // Le texte à afficher sur le bouton
    ));
    ?>

</div>
<br />
<br />


<?php $this->endWidget(); ?>

</div><!-- form -->
