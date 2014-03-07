<?php
/* @var $this CategorieIncidentController */
/* @var $model CategorieIncident */
/* @var $form CActiveForm */
?>


<div class="form">




    <button  class="btn-primary ButtonCate">Create a category</button>
    <div class="Categ" >

        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'categorie-incident-form1',
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'enableAjaxValidation' => false,
        ));
        ?>

        <hr>
        <p class="note">Field with  <span class="required">*</span> are required.</p>

        <?php echo $form->errorSummary($model); ?>

        <?php
        echo $form->labelEx($model, 'label');
        echo $form->textField($model, 'label', array('size' => 60, 'maxlength' => 64));
        echo $form->error($model, 'label');
        ?>

        <?php
        echo '<label>Entreprise:  <span class=required>*</span></label>';
        echo CHtml::dropDownList('Entreprise', 'nom', array('' => '', CHtml::listData(Entreprise::model()->findAllByAttributes(array('visible' => Constantes::VISIBLE)), 'id_entreprise', 'nom')));
        echo $form->error($model, 'fk_parent');
        ?>

        <?php
        echo $form->labelEx($model, 'fk_priorite');
        echo $form->dropDownList($model, 'fk_priorite', array('' => '', CHtml::listdata(Priorite::model()->findAll(), 'id_priorite', 'label')));
        echo $form->error($model, 'fk_priorite');
        ?>

        <div class="buttons">
            <?php echo CHtml::submitButton('Create'); ?>
        </div>
        <?php $this->endWidget(); ?>
    </div>
    <hr>

    <button class="btn-inverse ButtonSubCateg">Create a subcategory</button>
    <div class="SousCateg">
        <p class = "note">Field with <span class = "required">*</span> are required.</p>
        <?php
        $form1 = $this->beginWidget('CActiveForm', array(
            'id' => 'categorie-incident-form',
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'enableAjaxValidation' => false,
        ));
        ?>
        <?php echo $form1->errorSummary($model);
        ?>

        <?php
        echo $form1->labelEx($model, 'label');
        echo $form1->textField($model, 'label', array('size' => 60, 'maxlength' => 64));
        echo $form1->error($model, 'label');
        ?>

        <?php
        echo $form1->labelEx($model, 'fk_parent');
        echo $form1->dropDownList($model, 'fk_parent', array('' => '', CHtml::listData(CategorieIncident::model()->findAllByAttributes(array('fk_parent' => NULL)), 'id_categorie_incident', 'label')));
        echo $form1->error($model, 'fk_parent');
        ?>

        <?php
        echo $form1->labelEx($model, 'fk_priorite');
        echo $form1->dropDownList($model, 'fk_priorite', array('' => '', CHtml::listdata(Priorite::model()->findAll(), 'id_priorite', 'label')));
        echo $form1->error($model, 'fk_priorite');
        ?>

        <div class="buttons">
            <?php echo CHtml::submitButton('Create'); ?>
        </div>


    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->

<script>
    $(document).ready(function() {
        $(".SousCateg").hide();
        $(".Categ").hide();

    });
    $(".ButtonSubCateg").click(function() {
        $(".SousCateg").toggle();
    });
    $(".ButtonCate").click(function() {
        $(".Categ").toggle();
    });

</script>