<?php
/* @var $this EntrepriseController */
/* @var $model Entreprise */

$this->breadcrumbs = array(
    'Entreprises' => array('admin'),
    $model->nom,
);

$this->menu = array(
    array('label' => 'Update Entreprise', 'url' => array('update', 'id' => $model->id_entreprise)),
    array('label' => 'Delete Entreprise', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id_entreprise), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Entreprise', 'url' => array('admin')),
    array('label' => 'Add a Categorie for this entreprise', 'url' => array('secteur', 'id' => $model->id_entreprise)),
);
?>

<h1>View Entreprise: <?php echo $model->nom; ?></h1>

<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'type' => 'striped condensed bordered',
    'data' => $model,
    'attributes' => array(
        'nom',
        'tva',
        'tel',
        'adresse',
        'commune',
        'cp',
    ),
));
?>
