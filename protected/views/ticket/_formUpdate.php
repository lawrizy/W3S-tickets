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

<?php
// Affichage de la sélection des entreprises
echo $form->labelEx($model, 'fk_entreprise');
echo $form->dropDownList($model, 'fk_entreprise', array('' => '', CHtml::listData(Entreprise::model()->findAll(), 'id_entreprise', 'nom')));
// Yii::trace(CVarDumper::dumpAsString($theData), 'cron');
echo $form->error($model, 'fk_entreprise');
?>

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
$this->widget('zii.widgets.jui.CJuiButton', array(
    'buttonType' => 'link',
    'name' => 'ticketToClosed',
    'caption' => 'Clôturer le ticket',
    'url' => '.'
));
?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
