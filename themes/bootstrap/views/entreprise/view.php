<?php
/* @var $this EntrepriseController */
/* @var $model Entreprise */

$this->breadcrumbs = array(
    'Entreprises' => array('admin'),
    $model->nom,
);

$this->menu = array(
    array('label' => 'Mise à jour Entreprise', 'url' => array('update', 'id' => $model->id_entreprise),
        'visible' => Yii::app()->session['Rights']->getEntreprise() & EntrepriseController::ACTION_UPDATE),
    array('label' => 'Suppression Entreprise', 'url' => '#',
        'linkOptions' => array('submit' => array('delete', 'id' => $model->id_entreprise), 'confirm' => 'Are you sure you want to delete this item?'),
        'visible' => Yii::app()->session['Rights']->getEntreprise() & EntrepriseController::ACTION_DELETE),
    array('label' => 'Liste Entreprise', 'url' => array('admin'),
        'visible' => Yii::app()->session['Rights']->getEntreprise() & EntrepriseController::ACTION_ADMIN
    ),
    array('label' => 'Ajouter une Catégorie pour cette entreprise', 'url' => array('secteur', 'id' => $model->id_entreprise),
        'visible' => Yii::app()->session['Rights']->getEntreprise() & EntrepriseController::ACTION_UPDATE),
);
?>

<h1>Détails Entreprise: <?php echo $model->nom; ?></h1>

<?php
//------------------------------------------------------------------------------
//-------------------Détermination de la categorie à l'entreprise---------------
//------------------------------------------------------------------------------
//$CategorieList = Yii::app()->db->createCommand()
//        ->select('label')
//        ->from('w3sys_categorie_incident')
//        ->where('id_categorie_incident in (select fk_categorie FROM w3sys_secteur WHERE fk_entreprise= ' . $model->id_entreprise . ')')
//        ->queryAll();
$string = " ";
$categories = CategorieIncident::model()->findAllByAttributes(array('fk_entreprise' => $model->id_entreprise)); // recupération d'un tableau de  Secteur
foreach ($categories as $categorie) { // Boucle pour récuperer la categorie 
    $string .= $categorie->label . ' ';
}// $String  est la liste des catégories   
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------

$this->widget('bootstrap.widgets.TbDetailView', array(
    'type' => 'striped bordered',
    'data' => $model,
    'attributes' => array(
        'nom',
        'tva',
        'tel',
        'adresse',
        'commune',
        'cp',
        array('name' => 'Cat&eacute;gorie(s): ',
            'value' => $string,
        )
    ),
));
?>
