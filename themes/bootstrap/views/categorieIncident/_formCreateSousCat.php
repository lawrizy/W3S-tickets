<?php
/* @var $this CategorieIncidentController */
/* @var $model CategorieIncident */
/* @var $form CActiveForm */
?>


<div class="form">


    <div class="SousCateg">
        <p class = "note">Field with <span class = "required">*</span> are required.</p>
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
        echo '<label for="CategorieIncident_fk_parent">Cat&eacute;gorie Parent&nbsp;<span class="required">*</span></label>';
        echo $form->dropDownList($model, 'fk_parent', array('' => '', CHtml::listData(CategorieIncident::model()->findAllByAttributes(array('fk_parent' => NULL, 'visible' => Constantes::VISIBLE)), 'id_categorie_incident', 'label')));
        
        if (Yii::app()->session['errorParentField']) { // Si cette variable est à true
            echo '<label style="color: red;">' . 'Le champs Parent ne peut &ecirc;tre vide.' . '</label>';
                // Alors on affiche un message d'erreur. Cette variable est initialisée par
                // le controleur s'il y a un souci avec le champ parent
            Yii::app()->session['errorParentField'] = false;
                // On remet la variable à false pour éviter de ré-afficher le message
        }
        ?>
        <hr>
        <?php
        echo $form->labelEx($model, 'fk_priorite');
        echo $form->dropDownList($model, 'fk_priorite', array('' => '', CHtml::listData(Priorite::model()->findAll(), 'id_priorite', 'label')));
        echo $form->error($model, 'fk_priorite', array('style' => 'color: red;'));
        ?>

        <div class="buttons">
<?php echo CHtml::submitButton('CreateSousCat'); ?>
        </div>

<?php $this->endWidget(); ?>
    </div>

</div><!-- form -->