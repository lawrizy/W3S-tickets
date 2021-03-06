<?php
/* @var $this CategorieIncidentController */
/* @var $model CategorieIncident */
/* @var $form CActiveForm */
/* @var $trad Trad */
?>

<div class="form">

<?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'categorie-incident-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    )); ?>

    <p><h2><?php echo Translate::trad("CreationCategorie"); ?></h2></p><hr>
    <p class="note"><?php echo Translate::trad('Required'); ?></p>
    
    <?php echo $form->labelEx($model, 'label');
          echo $form->textField($model, 'label', array('size' => 60, 'maxlength' => 64, 'value' => $model->label));
          echo $form->error($model, 'label', array('style' => 'color: red;'));
    ?>
    
    <?php echo '<label for="CategorieIncident_fk_entreprise">' . Translate::trad("EntrepriseAssociee") . ' <span class="required">*</span></label>';
          echo $form->dropDownList($model, 'fk_entreprise', array('' => '', 
              CHtml::listData(Entreprise::model()->findAllByAttributes(
                  array('visible' => Constantes::VISIBLE)), 'id_entreprise', 'nom')));
          echo $form->error($model, 'fk_entreprise', array('style' => 'color: red;'));
    
    if (Yii::app()->session['errorEntrepriseField']) { // Si cette variable est à true
        echo '<label style="color: red;">' . Translate::trad("ChampsEntrepriseObligatoire") . '</label>';
            // Alors on affiche un message d'erreur. Cette variable est initialisée par
            // le controleur s'il y a un souci avec le champ entreprise
        Yii::app()->session['errorEntrepriseField'] = false;
            // On remet la variable à false pour éviter de ré-afficher le message
    }
    ?>
    <hr>
    
    <p><h4><?php echo Translate::trad("TraductionsLabel"); ?>: <span class="required">*</span></h4></p>
    <p><?php echo Translate::trad("TraductionsObligatoire"); ?></p>
    
    <?php if (Yii::app()->session['errorTradField']) {
            echo '<label style="color:red;"><?php echo Translate::trad("TraductionsTroisObligatoire"); ?></label>';
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
    
</div><!-- form -->
