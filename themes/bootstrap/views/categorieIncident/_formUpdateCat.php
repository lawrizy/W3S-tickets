<?php
/* @var $this CategorieIncidentController */
/* @var $model CategorieIncident */
/* @var $form CActiveForm */
/* @var $trad Trad */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'categorie-incident-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <hr>
    <p class="note"><?php echo Translate::trad('Required'); ?></p>


    <?php
    echo $form->labelEx($model, 'label');
    echo $form->textField($model, 'label', array('size' => 60, 'maxlength' => 64, 'value' => $model->label));
    echo $form->error($model, 'label', array('style' => 'color: red;'));
    ?>
    <hr>
    <?php
    echo '<label>Entreprise:  <span class=required>*</span></label>';
    echo CHtml::dropDownList('fk_entreprise', Yii::app()->session['id_entreprise'], array(CHtml::listData(Entreprise::model()->findAllByAttributes(array('visible' => Constantes::VISIBLE)), 'id_entreprise', 'nom')));
    Yii::app()->session['id_entreprise'] = NULL;
    ?>
    <hr>
    
    
    <p><h4>Traductions: <span class="required">*</span></h4></p>
    <p>Les trois traductions sont obligatoires car ce sont ces traductions qui seront affichées, pas le nom donné au dessus</p>
    
    <?php if (Yii::app()->session['errorTradField']) {
            echo '<label style="color:red;">Ces 3 champs sont obligatoires</label>';
            Yii::app()->session['errorTradField'] = false;
          }
    ?>
    <label for="tradFR">FR:</label>
    <?php echo CHtml::textField('tradFR', $trad->fr); ?>
            
    <label for="tradNL">NL:</label>
    <?php echo CHtml::textField('tradNL', $trad->nl); ?>

    <label for="tradEN">EN:</label>
    <?php echo CHtml::textField('tradEN', $trad->en); ?>
    
    <hr>

    <div class="buttons">
        <?php echo CHtml::submitButton('Mettre à jour'); ?>
    </div>
    <?php $this->endWidget(); ?>

</div><!-- form -->