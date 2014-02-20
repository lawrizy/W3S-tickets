<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Connexion';
$this->breadcrumbs = array(
    'Connexion',
);
?>

<h1>Connexion</h1>

<p>Remplisser les champs avec vos données de connexion:</p>

<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'login-form',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    ));
    ?>

    <p class="note">Les champs marqués de <span class="required">*</span> sont requis.</p>

    <div class="row">
        <?php echo '<label > Email :  <span class="required">*<br></span>';?>
        <?php echo $form->textField($model, 'username'); ?>
        <?php echo $form->error($model, 'username'); ?>
    </div>

    <div class="row">
     <?php echo '<label > Mot de passe :  <span class="required">*<br></span>';?>
        <?php echo $form->passwordField($model, 'password'); ?>
        <?php echo $form->error($model, 'password'); ?>
    </div>

    <div class="row rememberMe">
        <?php echo $form->checkBox($model, 'rememberMe'); ?>
        <?php echo $form->label($model, 'rememberMe'); ?>
        <?php echo $form->error($model, 'rememberMe'); ?>
    </div>

    <div class="row buttons">
        <?php echo $form->error($model, 'DBConnectionFail'); ?>
        <?php echo CHtml::submitButton('Connexion'); ?>
    </div>
    <p> <?php
        echo Yii::app()->session['erreurDB'];
        ?></p>
    <div class="link-column">
        <?php echo '<a href="#">Mot de passe oublié ?</a>'; ?>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->
