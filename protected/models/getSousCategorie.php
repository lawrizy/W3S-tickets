<?php

$idCat = intval($_POST['idCat']);
if ($idCat == null) {
    die();
}
$listSousCat = CategorieIncident::model()->findAllByAttributes(array('id_categorie_incident', 'label'), "fk_parent='" + $idCat + "';");
?>