<?php
/* @var $this EntrepriseController */
/* @var $model Entreprise */

$this->breadcrumbs = array(
    'Entreprises' => array('admin'),
    'Détails '.$model->nom => array('view', 'id' => $model->id_entreprise),
    $model->nom,
);

$this->menu = array(
    array('label' => 'Liste Entreprise', 'url' => array('admin')),
    array('label' => 'Détails Entreprise', 'url' => array('vue', 'id' => $model->id_entreprise))
);
$this->beginWidget('TbActiveForm', array('id' => 'ticket-form', 'enableAjaxValidation' => false));
?>



<h1>Add a category for Entreprise: <?php echo $model->nom; ?></h1><br /><br />
<p style="color: blue;">Voici la liste des catégories liées à aucune entreprise</p>
<input type="hidden" value="<?php echo $model->id_entreprise; ?>" name="id_entreprise" />

<?php
$listCats = array(); // Tout d'abord on initialise une variable comme array
$cats = CategorieIncident::model()->findAllByAttributes(
        array('fk_parent' => NULL, 'visible' => Constantes::VISIBLE));
        // On recherche la liste des catégories parents

foreach ($cats as $cat) { // Ici on les parcourt tous pour vérifier si elles sont liées à une entreprise
    $secteur = Secteur::model()->findByAttributes(
            array('fk_categorie' => $cat['id_categorie_incident'], 'visible' => Constantes::VISIBLE));
            // On vérifie qu'il n'y a pas de secteur (table de jointure entre catégorie et entreprise)
            // lié à cette catégorie
    
    if ($secteur == null) // Si pas de secteur, c'est que la catégorie n'est lié à aucune entreprise
        array_push($listCats, $cat); // Alors on la rajoute dans les catégories à afficher
}
echo '<br /><br />';
echo CHtml::dropDownList('idCat', 'label', array('' => '', CHtml::listData($listCats, 'id_categorie_incident', 'label', 'Test')));
    // On affiche la liste des catégories libres

echo '<br /><br />';
echo CHtml::submitButton('Enregistrer'); // Et enfin on enregistre
$this->endWidget();
?>