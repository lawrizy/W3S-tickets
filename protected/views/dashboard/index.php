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

    $defaultSelection = 'ALL';
    if (isset($_POST['idBatiment'])) {
        $defaultSelection = $_POST['idBatiment'];
        Yii::trace('' . $defaultSelection, "cron");
    }

    echo CHtml::dropDownList
        (
        // Nom de la DDL
            'batiment_selector',
            // Selection
            'ALL',
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
    echo '</p>';

    echo '<div id="graphs">';
        // Voir le fichier _ajaxUpdateGraphs.php pour la construction des graphiques.
        $this->renderPartial('_ajaxUpdateGraphs', array('idBatiment' => 'ALL'));
    echo '</div>';
    ?>
</p>