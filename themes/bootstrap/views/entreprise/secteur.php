<?php
/* @var $this EntrepriseController */
/* @var $model Entreprise */

$this->breadcrumbs = array(
    'Entreprises' => array('admin'),
    $model->nom => array('view', 'id' => $model->id_entreprise),
    $model->nom,
);

$this->menu = array(
    array('label' => 'Liste Entreprise', 'url' => array('admin')),
    array('label' => 'Détails Entreprise', 'url' => array('view', 'id' => $model->id_entreprise))
);
$this->beginWidget('CActiveForm', array('id' => 'ticket-form', 'enableAjaxValidation' => false));
?>



<h1>Add a category for Entreprise: <?php echo $model->nom; ?></h1><br /><br />
<p style="color: blue;">Voici la liste des catégories liées à aucune entreprise</p>
<input type="hidden" value="<?php echo $model->id_entreprise; ?>" name="id_entreprise" />

<?php
$listCategorie = Yii::app()->db->createCommand()
        ->select('*')
        ->from('w3sys_categorie_incident c')
        ->where('c.fk_parent is null and c.id_categorie_incident not in (SELECT fk_categorie FROM w3sys_secteur  where  visible =1)')
        ->queryAll();

echo '<br /><br />';
echo CHtml::dropDownList('idCat', 'label', array('' => '', CHtml::listData($listCategorie, 'id_categorie_incident', 'label')));
// On affiche la liste des catégories libres

echo '<br /><br />';
echo CHtml::submitButton('Enregistrer'); // Et enfin on enregistre
$this->endWidget();
?>