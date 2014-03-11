<?php
/*
 * Besoin des champs suivants:
 *      - Champs pour le code à donner à la traduction (Attention, ce code doit être unique!)
 *      - Champs traduction FR
 *      - Champs traduction EN
 *      - Champs traduction NL
 * 
 * Conditions:
 *      - Aucun des champs ne peut être vide
 *      - Le code a une longueur maximale de 64
 *      - Toutes les traductions ont une longueur maximale de 128
 */
?>

<?php
/* @var $this TradController */
/* @var $model Trad */
/* @var $form CActiveForm */
?>

<div class="form">
    <?php
    // Création d'un nouveau widget de formulaire
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'trad-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <hr>
    <p class="note">Field with <span class="required">*</span> are required.</p>

    <?php
    // FORMULAIRE START
    // Champs Code
    echo $form->labelEx($model, 'code');
    echo $form->textField($model, 'code', array('size' => 64, 'maxlength' => 64));
    echo $form->error($model, 'code', array('style' => 'color: red;'));

    // Champs FR
    echo $form->labelEx($model, 'fr');
    echo $form->textField($model, 'fr', array('size' => 128, 'maxlength' => 128));
    echo $form->error($model, 'fr');
    
    // Champs EN
    echo $form->labelEx($model, 'en');
    echo $form->textField($model, 'en', array('size' => 128, 'maxlength' => 128));
    echo $form->error($model, 'en');
    
    // Champs NL
    echo $form->labelEx($model, 'nl');
    echo $form->textField($model, 'nl', array('size' => 128, 'maxlength' => 128));
    echo $form->error($model, 'nl');
    ?>

    <div class="buttons">
        <?php
        // Bouton d'envoi
        $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type' => 'primary',
            'label'=>  'Envoyer la nouvelle traduction',
        ));
        // FORMULAIRE END
        ?>
    </div>

    <?php
    // Fermeture du widget trad-form
    $this->endWidget('trad-form');
    ?>
</div>
