<?php
/* @var $this CategorieIncidentController */
/* @var $model CategorieIncident */
/* @var $form CActiveForm */
/* @var $trad Trad */
?>


<div class="form">


    <div class="SousCateg">
        <p class = "note"><?php echo Translate::trad('Required'); ?></p>
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

        <?php
        echo $form->labelEx($model, 'label');
        echo $form->textField($model, 'label', array('size' => 60, 'maxlength' => 64, 'value' => $model->label));
        echo $form->error($model, 'label', array('style' => 'color: red;'));
        ?>
        
        <hr>
        <?php
        echo '<label for="CategorieIncident_fk_parent">' . Translate::trad("CategorieParente") . '<span class="required">*</span></label>';
        echo $form->dropDownList($model, 'fk_parent', array(
            CHtml::listData($this->getCategorieTraduite(), 'id_categorie_incident', 'label')));
        ?>
        
        <hr>
        <?php
        echo '<label>Priorit&eacute;</label>';
        echo $form->dropDownList($model, 'fk_priorite', array(CHtml::listData($this->getPrioriteTraduite(), 'id_priorite', 'label')));
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
    </div>

</div><!-- form -->