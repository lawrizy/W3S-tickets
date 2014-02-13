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
        echo $form->labelEx($model, 'fk_categorie');
        echo $form->dropDownList($model, 'fk_categorie', array('' => '', CHtml::listData(CategorieIncident::model()->findAllByAttributes(array('fk_parent' => NULL)), 'id_categorie_incident', 'label')));
        echo $form->dropDownList($model, 'fk_categorie', array('' => '', CHtml::listData(CategorieIncident::model()->findAllByAttributes(array('fk_parent' => !NULL)), 'id_categorie_incident', 'label')));
        echo $form->error($model, 'fk_categorie');
        ?>
    </div>


    <div class="row">
        <?php
        echo $form->labelEx($model, 'fk_lieu');
        $lieu = Lieu::model()->findByPk($model->fk_lieu);
        echo $form->dropDownList($model, 'fk_lieu', array('' => '', CHtml::listData(Lieu::model()->findAllByAttributes(array('fk_locataire' => Locataire::model()->findByPk($lieu->fk_locataire)->id_locataire)), 'id_lieu', 'adresse')));
        echo $form->error($model, 'fk_lieu');
        ?>
    </div>

    <?php
    // Affichage de la sélection des entreprises
    if (Yii::app()->session['Utilisateur'] == 'User') {
        $theData = Chtml::listData($this->getEntreprise($model->id_ticket), 'id_entreprise', 'nom');
        echo $form->labelEx($model, 'fk_secteur');
        echo $form->dropDownList($model, 'fk_secteur', array('' => '', $theData));
        echo $form->error($model, 'fk_secteur');
    }
    ?>

    <div class="row">
        <!-- Div pour la PRIORITE -->
        <!-- Champs caché -->
        <!-- TODO Priorité -->
    </div>

    <div class="row">
        <?php
        echo $form->labelEx($model, 'commentaire');
        echo $form->textArea($model, 'commentaire', array('maxlength' => 800, 'rows' => 5, 'cols' => 50, 'style' => 'resize:none'));
        echo $form->error($model, 'commentaire');
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

        if (Yii::app()->session['Utilisateur'] == 'User') {
            $nomMethode = ""; // Nom de la méthode du TicketController sans le "action" ex: create et pas actionCreate
            if ($model->getStatusTicket() === "Closed")
                ;
            else if ($model->getStatusTicket() === "Opened") {
                $nomMethode = "Update"; //TODO
                $this->widget('zii.widgets.jui.CJuiButton', array(
                    'buttonType' => 'submit',
                    'name' => 'ticketToInProgress',
                    'caption' => 'Passer le ticket \'En traitement\'',
                ));
                /*
                  echo CHtml::submitButton('Passer le ticket \'En traitement\'',
                  array('button' => 'TicketController/' . $nomMethode,
                  'submit' => $redirectionURL,
                  ));
                 */
            } else {
                $nomMethode = "Update"; //TODO
                $this->widget('zii.widgets.jui.CJuiButton', array(
                    'buttonType' => 'submit',
                    'name' => 'ticketToClosed',
                    'caption' => 'Clôturer le ticket',
                ));
                /*
                  echo CHtml::submitButton('Clôturer le ticket', array(
                  'button' => array('TicketController/' . $nomMethode,
                  'submit' => $redirectionURL
                  )));
                 */
            }
        }

        echo CHtml::submitButton('Annuler les changements', array('submit' => array('')));
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
