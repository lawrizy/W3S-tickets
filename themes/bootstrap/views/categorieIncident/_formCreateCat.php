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

    <p><h2>Création d'une catégorie</h2></p><hr>
    <p class="note"><?php echo Translate::trad('Required'); ?></p>
    
    <?php echo $form->labelEx($model, 'label');
          echo $form->textField($model, 'label', array('size' => 60, 'maxlength' => 64, 'value' => $model->label));
          echo $form->error($model, 'label', array('style' => 'color: red;'));
    ?>
    
    <label for="fk_entreprise">Entreprise: <span class=required>*</span></label>
    <?php echo CHtml::dropDownList('fk_entreprise', Yii::app()->session['id_entreprise'], 
        array('' => '', CHtml::listData(Entreprise::model()->findAllByAttributes(
            array('visible' => Constantes::VISIBLE)), 'id_entreprise', 'nom')));
    // Yii::app()->session['id_entreprise'] est une variable permettant de mettre une entreprise par défaut
    // Lorsqu'on revient sur cette page après une erreur d'enregistrement (validate qui ne passe pas par exemple)
    Yii::app()->session['id_entreprise'] = NULL;

    if (Yii::app()->session['errorEntrepriseField']) { // Si cette variable est à true
        echo '<label style="color: red;">' . 'Le champ Entreprise ne peut &ecirc;tre vide.' . '</label>';
            // Alors on affiche un message d'erreur. Cette variable est initialisée par
            // le controleur s'il y a un souci avec le champ entreprise
        Yii::app()->session['errorEntrepriseField'] = false;
            // On remet la variable à false pour éviter de ré-afficher le message
    }
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
    <?php echo CHtml::submitButton('CreateSousCat'); ?>
    </div>

    <?php $this->endWidget(); ?>
    
</div><!-- form -->