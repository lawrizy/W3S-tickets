<?php
/* @var $this DashboardController */

$this->pageTitle = Yii::app()->name;
?>

    <center><h1>Tableau de bord</h1></center>

    <p>
<?php
// DDL pour sélectionner un bâtiment spécifique
echo '<p>';
echo '<label>Sélectionnez un bâtiment pour filtrer les résultats :</label>';
echo '</p>';
echo '<p>';

if (isset($_POST['idBatiment']))
    $defaultSelection = $_POST['idBatiment'];
else
    $defaultSelection = 'ALL';

echo CHtml::dropDownList
    (
    // Nom de la DDL
        'batiment_selector',
        // Selection
        $defaultSelection,
        // Data
        array
        (
            'ALL' => 'Tous les bâtiments',
            CHtml::listData(Batiment::model()->findAll(), 'id_batiment', 'nom'),
        ),
        // htmlOptions
        array
        (
            'ajax' => array
            (
                'type' => 'POST',
                'url' => CController::createUrl('filterbybatiment'),
                'data' => array('idBatiment' => 'js: this.value'),
                'update' => "#graphs",
            ),
        )
    );

echo '</p>'; // Fin paragraphe dropDownList + bouton rafraichir

echo '<div id="graphs">';
// Voir le fichier _ajaxUpdateGraphs.php pour la construction des graphiques.
$this->renderPartial('_ajaxUpdateGraphs', array('idBatiment' => 'ALL'));
echo '</div>';
?>

<!--
<div id="quickstats">
<br/><br/>
<h3 style="text-align: center;">Quick stats</h3>
<ul>
    <li>Bâtiment avec le plus de tickets ouverts: </li>
</ul>
</div>
-->

</p>