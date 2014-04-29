<?php
/* @var $this TicketController */
/* @var $model Ticket */
/* @var $form CActiveForm */
?>


<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array('id' => 'ticket-form', 'enableAjaxValidation' => false));
    ?>
    <p class="note"><?php echo Translate::trad('Required'); ?></p>


    <?php
    // Affichage de l'entreprise qui s'occupera de ce ticket (selon la catégorie)
    if ($model->fkCategorie->fkParent->fk_entreprise == NULL) {
        echo '<input type="hidden" value="' . Constantes::ENTREPRISE_DEFAUT . '" name="Ticket[fk_entreprise]" />';
        echo '<br /><p style="color: red;">/!\ Aucun sous-traitant n\'est lié à cette catégorie, contactez votre administrateur au plus vite pour régler ça!</p><br />';
    } else {
        $entreprise = $model->fkCategorie->fkParent->fkEntreprise;
        echo '<input type="hidden" value="' . $entreprise->id_entreprise . '" name="Ticket[fk_entreprise]" />';
        echo '<br /><p style="color: blue;">Le sous-traitant qui s\'occupera de ce ticket est: ' . $entreprise->nom . '</p><br /><br />';
    }
    ?>

    <label><?php echo Translate::trad('DateIntervention'); ?> <span class="required">*</span></label>
    <?php
    $this->widget('zii.widgets.jui.CJuiDatePicker', array(// Widget permettant d'afficher un datePicker
        'name' => 'Ticket[date_intervention]',
        'id' => 'Ticket_date_intervention',
        'language' => Yii::app()->session['_lang'],
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

    <?php
    echo $form->labelEx($model, 'fk_priorite');
    echo $form->dropDownList($model, 'fk_priorite', array('' => '', CHtml::listData(Priorite::model()->findAll(), 'id_priorite', 'label')));
    echo $form->error($model, 'fk_priorite');
    ?>



    <div class="buttons">
        <?php
        echo CHtml::submitButton(Translate::trad('ButtonTraitement'), array('onClick' => 'antiSpam(this);'));
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->

<script>
    function antiSpam(button)
    {
        button.disabled = true;
        button.form.submit();
    }
</script>
