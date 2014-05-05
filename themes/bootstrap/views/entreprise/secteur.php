<?php
    /* @var $this EntrepriseController */
    /* @var $model Entreprise */

    $this->breadcrumbs = array(
        'Entreprises' => array('admin'),
        $model->nom => array('view', 'id' => $model->id_entreprise),
        'Ajouter une catégorie',
    );

    $this->menu = array(
        array('label' => 'Liste Entreprise', 'url' => array('admin') ,
            'visible' => Yii::app()->session['Rights']->getEntreprise() & EntrepriseController::ACTION_ADMIN),
        array('label' => 'Détails Entreprise', 'url' => array('view', 'id' => $model->id_entreprise),
            'visible' => Yii::app()->session['Rights']->getEntreprise() & EntrepriseController::ACTION_VIEW)
    );
    $this->beginWidget('CActiveForm', array('id' => 'ticket-form', 'enableAjaxValidation' => false));
    ?>



    <h1>Add a category for Entreprise: <?php echo $model->nom; ?></h1><br /><br />
    <p style="color: blue;">Voici la liste des catégories liées à aucune entreprise</p>
    <input type="hidden" value="<?php echo $model->id_entreprise; ?>" name="id_entreprise" />

    <?php
    echo '<br /><br />';
    echo CHtml::dropDownList('idCat', 'label', array('' => '', CHtml::listData($this->getCategorieTraduite(), 'id_categorie_incident', 'label')));
    // On affiche la liste des catégories libres

    echo '<br /><br />';
    echo CHtml::submitButton('Enregistrer'); // Et enfin on enregistre
    $this->endWidget();
?>