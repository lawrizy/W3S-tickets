<?php
/* @var $this DashboardController */

$this->pageTitle = Yii::app()->name;
?>

<h1>Dashboard</h1>

<p>
<h2>Fréquence des incidents</h2>
</p>

<p>
    <?php
    // DDL pour sélectionner un bâtiment spécifique
    echo '<p>';
    echo '<label>Sélectionnez un bâtiment pour filtrer les résultats</label>';
    echo '</p>';
    echo '<p>';

    $defaultSelection = 'ALL';
    if (isset($_POST['idBatiment'])) {
        $defaultSelection = $_POST['idBatiment'];
        Yii::trace('' . $defaultSelection, "cron");
    }

    echo CHtml::beginForm('', 'POST');
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
                    'data' => array('idBatiment' => 'js:this.value'),
                    'update' => "#graphs",
                ),
            )
        );
    echo '</p>';
    echo CHtml::endForm();

    echo '<div id="graphs">';
    // Si le defaultSelection est égal à 'ALL' montrer pour tous les bâtiments
    if($defaultSelection == 'ALL')
    {
        Yii::trace("Tous les batiments", "cron");
        $this->widget(
            'chartjs.widgets.ChBars', array(
                'width' => 800,
                'height' => 300,
                'htmlOptions' => array(),
                'labels' => $this->actionGetCategoriesLabel(),
                'datasets' => array(
                    array(
                        "fillColor" => "rgba(34,167,212,1)",
                        "strokeColor" => "#AAAAAA",
                        "data" => $this->actionGetTicketByCategorie()
                    )
                ),
                'options' => array()
            )
        );
    }
    else
    {
        $idBatiment = (int)$defaultSelection;
        Yii::trace("Batiment ID " . $idBatiment, "cron");
        $this->widget(
            'chartjs.widgets.ChBars', array(
                'width' => 800,
                'height' => 300,
                'htmlOptions' => array(),
                'labels' => $this->actionGetCategoriesLabel(),
                'datasets' => array(
                    array(
                        "fillColor" => "rgba(34,167,212,1)",
                        "strokeColor" => "#AAAAAA",
                        "data" => $this->actionGetTicketByCategorieForBatimentID($idBatiment),
                    )
                ),
                'options' => array()
            )
        );
    }

    echo '</div>';

    echo "<br/><br/><br/>";

    $this->widget(
        'chartjs.widgets.ChPie', array(
            'width' => 600,
            'height' => 300,
            'htmlOptions' => array(),
            'drawLabels' => true,
            //'animation' => false,
            'datasets' => array(
                array(
                    "value" => (int)Ticket::model()->countByAttributes(array('fk_statut' => 1)),
                    "color" => "rgba(220, 0,0,1)",
                    "label" => (int)Ticket::model()->countByAttributes(array('fk_statut' => 1)) . " nouveau(x)"
                ),
                array(
                    "value" => (int)Ticket::model()->countByAttributes(array('fk_statut' => 2)),
                    "color" => "rgba(242,106,22,1)",
                    "label" => (int)Ticket::model()->countByAttributes(array('fk_statut' => 2)) . " en cours"
                ),
                array(
                    "value" => (int)Ticket::model()->countByAttributes(array('fk_statut' => 3)),
                    "color" => "rgba(66,200,22,1)",
                    "label" => (int)Ticket::model()->countByAttributes(array('fk_statut' => 3)) . " clôturé(s)"
                ),
            ),
            'options' => array
            ()
        )
    );
    ?>
</p>