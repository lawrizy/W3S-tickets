<?php
/* @var $this TicketController */
/* @var $model Ticket */
/* @var $form CActiveForm */
?>

<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'ticket-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Les champs marqués de <span class="required">*</span> sont requis.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php
        echo '<label for="#" class="required">Categorie</label>';
        echo $form->dropDownList($model, 'fk_categorie', array('' => '', CHtml::listData(CategorieIncident::model()->findAllByAttributes(array('fk_parent' => NULL)), 'id_categorie_incident', 'label')));
        echo $form->labelEx($model, 'fk_categorie');
        echo $form->dropDownList($model, 'fk_categorie', array('' => '', CHtml::listData(CategorieIncident::model()->findAllByAttributes(array('fk_parent' => !NULL)), 'id_categorie_incident', 'label')));
        echo $form->error($model, 'fk_categorie');
        ?>
    </div>


    <div class="row">
        <?php
        echo $form->dropDownList($model, 'fk_batiment', array('' => '', CHtml::listData(Batiment::model()->findAll(), 'id_batiment', 'nom')));
        echo $form->error($model, 'fk_batiment');
        ?>
    </div>

    <div class="row">
        <!-- Div pour la PRIORITE -->
        <!-- Champs caché -->
        <!-- TODO Priorité -->
    </div>

    <div class="row">
        <?php
        echo $form->labelEx($model, 'descriptif');
        echo $form->textArea($model, 'descriptif', array('maxlength' => 800, 'rows' => 5, 'cols' => 50, 'style' => 'resize:none'));
        echo $form->error($model, 'descriptif');
        ?>
    </div>

    <div class="row buttons">
        <?php
        $redirectionURL = '../' . $model->id_ticket;
//echo CHtml::submitButton('Save');
        $this->widget('zii.widgets.jui.CJuiButton', array(
            'buttonType' => 'submit',
            'name' => 'update',
            'caption' => 'Save',
        ));



        $this->widget('zii.widgets.jui.CJuiButton', array(
            'buttonType' => 'link',
            'name' => 'ticketToClosed',
            'caption' => 'Cancel',
            'url' => '../view?id=' . $_GET['id']
        ));
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
