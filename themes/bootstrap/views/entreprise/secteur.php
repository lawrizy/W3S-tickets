<?php
/* @var $this EntrepriseController */
/* @var $model Entreprise */

$this->breadcrumbs = array(
    'Entreprises' => array('admin'),
    $model->nom,
);

$this->menu = array(
    array('label' => 'Manage Entreprise', 'url' => array('admin')),
);
?>

<h1>Add a category for Entreprise: <?php echo $model->nom; ?></h1>

