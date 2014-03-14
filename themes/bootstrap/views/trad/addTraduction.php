<?php

/* @var $this TradController */
/* @var $model Trad */
/* @var $form CActiveForm */

$this->breadcrumbs = array(
    'admin' => '../admin',
    'Ajouter une nouvelle traduction',
);

$this->menu = array(
    array('label' => 'Modifier traduction existante', 'url' => array('modifyTraduction')),
);

?>
<div id="retour">
    <a href="../admin"><?php echo Translate::trad("RetourPageAdmin");?></a>
</div>

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
echo $form->error($model, 'code');

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
        'label' => 'Envoyer la nouvelle traduction',
    ));
    // FORMULAIRE END
    ?>
</div>

<?php
// Fermeture du widget trad-form
$this->endWidget('trad-form');
?>
</div>
