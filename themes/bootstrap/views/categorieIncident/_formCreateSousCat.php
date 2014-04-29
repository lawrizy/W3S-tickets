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
        )); ?>
        <div class="SousCateg">
        <p><h2><?php echo Translate::trad("CreerSousCategorie"); ?></h2></p><hr>
        <p class = "note"><?php echo Translate::trad('Required'); ?></p>
        <?php
            echo $form->labelEx($model, 'label');
            echo $form->textField($model, 'label', array('size' => 60, 'maxlength' => 64, 'value' => $model->label));
            echo $form->error($model, 'label', array('style' => 'color: red;'));
        ?>
        <label for="CategorieIncident_fk_parent"><?php echo Translate::trad("CategorieParente"); ?><span class="required">*</span></label>
        <?php
            echo $form->dropDownList($model, 'fk_parent', array('' => '', 
                CHtml::listData(CategorieIncident::model()->findAllByAttributes(
                    array('fk_parent' => NULL, 'visible' => Constantes::VISIBLE)), 'id_categorie_incident', 'label')));
            if (Yii::app()->session['errorParentField']) { // Si cette variable est à true
                echo '<label style="color: red;">' . Translate::trad("ChampsParentNonVide") . '</label>';
                    // Alors on affiche un message d'erreur. Cette variable est initialisée par
                    // le controleur s'il y a un souci avec le champ parent
                Yii::app()->session['errorParentField'] = false;
                    // On remet la variable à false pour éviter de ré-afficher le message
            }

            echo $form->labelEx($model, 'fk_priorite');
            echo $form->dropDownList($model, 'fk_priorite', array('' => '', CHtml::listData(Priorite::model()->findAll(), 'id_priorite', 'label')));
            echo $form->error($model, 'fk_priorite', array('style' => 'color: red;'));
        ?>
        <hr>

        
        <p><h4><?php echo Translate::trad("CreerCategorie"); ?><span class="required">*</span></h4></p>
        <p><?php echo Translate::trad("TraductionsTroisObligatoire"); ?></p>
        <?php if (Yii::app()->session['errorTradField']) {
                echo '<label style="color:red;"><?php echo Translate::trad("TraductionsObligatoire"); ?></label>';
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
        <?php echo CHtml::submitButton(Translate::trad("CreerSousCategorie")); ?>
        </div>

        <?php $this->endWidget(); ?>
        </div>
</div><!-- form -->
