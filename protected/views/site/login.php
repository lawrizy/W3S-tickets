<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */
Yii::app()->language = Yii::app()->session['_lang'];
$this->pageTitle = Yii::app()->name . ' - Connexion';
$this->breadcrumbs = array(
    'Connexion',
);
?>

<h1><?php echo Translate::tradGrand('ConnexionTitre'); ?></h1>

<p><?php echo Translate::tradGrand('Indication'); ?></p>

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

    <p class="note"><?php echo Translate::tradGrand('Required'); ?></p>

    <div class="row">
        <?php echo '<label >' . Translate::tradGrand('EmailForm') . ' <span class="required">*<br></span>'; ?>
        <?php echo $form->textField($model, 'username'); ?>
        <?php echo $form->error($model, 'username'); ?>
    </div>

    <div class="row">
        <?php echo '<label >' . Translate::tradGrand('MdpForm') . ' <span class="required">*<br></span>'; ?>
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
        <?php echo CHtml::submitButton(Translate::tradGrand('ConnexionButton')); ?>
    </div>
    <p> <?php
        echo Yii::app()->session['erreurDB'];
        ?></p>
    <div class="link-column">
        <?php echo '<a href="#">' ?> <?php echo Translate::tradGrand('MdpOublie') . '</a>'; ?>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->
