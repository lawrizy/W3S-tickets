<?php
/* @var $this TicketController */
/* @var $model Ticket */
/* @var $form CActiveForm */
?>

<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'ticket-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note"><?php echo Translate::tradGrand('Required'); ?></p>

    <?php echo $form->errorSummary($model, Translate::tradMoyen('ReglerProbleme')); ?>

    <div class="row">
        <?php
        // Form pour la sélection de la catégorie
        echo '<label>' . Translate::tradPetit('SelectionnerCategorie') . '<span class="required"> *</span> </label>';
        echo CHtml::dropDownList
                (
                'Categorie', // Le nom de cette dropDownList
                'fk_categorie', // La colonne à sélectionner
                array // Cette array remplit la dropDownList avec les catégories mères disponibles dans la DB.
            (
            '' => '',
            $this->getCategoriesLabel(),
                ), array // Cette array définit le chargement dynamique des valeurs dans la dropDownList des sous-catégories. (Voir dropDownList suivante appelée DD_sousCat)
            (
            'ajax' => array
                (
                'type' => 'POST',
                'url' => CController::createUrl('getsouscategoriesdynamiques'),
                'data' => array('paramID' => 'js:this.value'),
                'update' => '#DD_sousCat',
            )
                )
        );

        echo $form->labelEx($model, 'fk_categorie');
        // Cette dropDownList est initialisée vide car elle sera remplie après la sélection d'une catégorie ci-dessus.
        echo CHtml::dropDownList('DD_sousCat', '', array());
        ?>
    </div>


    <div class="row">
        <?php
        echo '<label>' . Translate::tradPetit('SelectionnerBatiment') . '<span class="required"> *</span> </label>';
        echo $form->dropDownList($model, 'fk_batiment', array('' => '', CHtml::listData(Batiment::model()->findAll(), 'id_batiment', 'nom')));
        ;
        ?>
    </div>
    <div class="row">
        <?php
        echo $form->labelEx($model, 'etage');
        echo $form->textField($model, 'etage', array('size' => 1, 'maxlength' => 10, 'style' => 'resize:none', 'value' => $model->etage));
        ?>
    </div>
    <div class="row">
        <?php
        echo $form->labelEx($model, 'bureau');
        echo $form->textField($model, 'bureau', array('size' => 15, 'maxlength' => 10, 'value' => $model->bureau));
        ?>
    </div>
    <div class="row">
        <?php
        echo $form->labelEx($model, 'descriptif');
        echo $form->textArea($model, 'descriptif', array('maxlength' => 800, 'rows' => 5, 'cols' => 50, 'style' => 'resize:none'));
        echo $form->error($model, 'descriptif');
        ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton(Translate::tradPetit('ButtonCreer')); ?>
    </div>


    <?php $this->endWidget(); ?>

</div><!-- form -->
