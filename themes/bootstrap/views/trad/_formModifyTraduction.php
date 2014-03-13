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
        //TODO dropDownList des codes
        //TODO lorsque le code est rempli, charger les traductions correspondantes
    
    echo $form->labelEx($model, 'code');
    echo $form->dropDownList(
        $model,
        'code',
        CHtml::listData(Trad::model()->findAll(), 'id', 'code'),
        array // Cette array définit le chargement dynamique des valeurs dans la dropDownList des sous-catégories. (Voir dropDownList suivante appelée DD_sousCat)
        (
            'ajax' => array
            (
                'type' => 'POST',
                'url' => CController::createUrl('modifytraduction'),
                'data' => array('idTrad' => 'js:this.value'),
                'update' => '#ajaxUpdate',
            )
        )
    );
    echo $form->error($model, 'code');
    ?>
    
    <div class="ajaxUpdated">
        
    </div>
    
    <div class="buttons">
        <?php
        // Bouton d'envoi
        $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type' => 'primary',
            'label' => 'Modifier la traduction',
        ));
        // FORMULAIRE END
        ?>
    </div>

    <?php
    // Fermeture du widget trad-form
    $this->endWidget('trad-form');
    ?>
</div>
