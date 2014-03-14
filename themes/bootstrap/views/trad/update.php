<?php
/* @var $this TradController */
/* @var $model Trad */
/* @var $form CActiveForm */


$this->breadcrumbs = array('Trad' => array('../admin'));
?>

<h1>Mettre à jour une traduction "<?php echo $model->code; ?>"</h1>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'trad-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
));
?>

<p class="note">Les champs marqués de <span class="required">*</span> sont requis.</p>
<br/>


<?php echo $form->labelEx($model, 'code'); ?>
<?php echo $form->textField($model, 'code', array('size' => 60, 'maxlength' => 64, 'readonly' => 'true')); ?>
<?php echo $form->error($model, 'code', array('style' => 'color: red;')); ?>

<?php echo $form->labelEx($model, 'fr'); ?>
<?php echo $form->textField($model, 'fr', array('size' => 128, 'maxlength' => 128)); ?>
<?php echo $form->error($model, 'fr', array('style' => 'color: red;')); ?>

<?php echo $form->labelEx($model, 'en'); ?>
<?php echo $form->textField($model, 'en', array('size' => 128, 'maxlength' => 128)); ?>
<?php echo $form->error($model, 'en', array('style' => 'color: red;')); ?>

<?php echo $form->labelEx($model, 'nl'); ?>
<?php echo $form->textField($model, 'nl', array('size' => 128, 'maxlength' => 128)); ?>
<?php echo $form->error($model, 'nl', array('style' => 'color: red;')); ?>


<div class="controls">
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
<?php $this->endWidget(); ?>
