<?php
/* @var $this CategorieIncidentController */
/* @var $model CategorieIncident */
/* @var $form CActiveForm */
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
        echo '<label for="CategorieIncident_fk_parent">Cat&eacute;gorie-Parent&nbsp;<span class="required">*</span></label>';
        echo $form->dropDownList($model, 'fk_parent', array(CHtml::listData(CategorieIncident::model()->findAllByAttributes(array('fk_parent' => NULL, 'visible' => Constantes::VISIBLE)), 'id_categorie_incident', 'label')));
        ?>
        
        <hr>
        <?php
        echo '<label>Priorit&eacute;</label>';
        echo $form->dropDownList($model, 'fk_priorite', array(CHtml::listData(Priorite::model()->findAll(), 'id_priorite', 'label')));
        ?>
        <hr>
        <div class="buttons">
            <?php echo CHtml::submitButton('Mettre à jour'); ?>
        </div>

        <?php $this->endWidget(); ?>
    </div>

</div><!-- form -->