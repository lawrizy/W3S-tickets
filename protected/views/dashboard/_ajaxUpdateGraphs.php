<?php

// Graphique en bâtonnets -> fréquence des catégories d'incidents (Pour tous les bâtiments ou pour un bâtiment spécifique)

if ($idBatiment == 'ALL') {
    ?>
    <p><h2>Fréquence des catégories d'incidents (Tous les bâtiments)</h2></p>
    <?php

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


    echo '<p><h2>Fréquence des statuts de tickets</h2></p>';

    $this->widget(
            'chartjs.widgets.ChPie', array(
        'width' => 225,
        'height' => 225,
        'htmlOptions' => array(),
        'drawLabels' => true,
        //'animation' => false,
        'datasets' => array(
            array(
                "value" => (int) Ticket::model()->countByAttributes(array('fk_statut' => 1)),
                "color" => "rgba(220, 0,0,1)",
                "label" => (int) Ticket::model()->countByAttributes(array('fk_statut' => 1)) . " nouveau(x)"
            ),
            array(
                "value" => (int) Ticket::model()->countByAttributes(array('fk_statut' => 2)),
                "color" => "rgba(242,106,22,1)",
                "label" => (int) Ticket::model()->countByAttributes(array('fk_statut' => 2)) . " en cours"
            ),
            array(
                "value" => (int) Ticket::model()->countByAttributes(array('fk_statut' => 3)),
                "color" => "rgba(66,200,22,1)",
                "label" => (int) Ticket::model()->countByAttributes(array('fk_statut' => 3)) . " clôturé(s)"
            ),
        ),
        'options' => array
        ()
            )
    );
} else {
    //Yii::trace("Batiment ID " . $idBatiment, "cron");


    echo '<p><h2>Fréquence des catégories d\'incidents (Bâtiment : <?php echo "TODO"; ?>)</h2></p>';
    
    
    
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
print_r($this->actionGetTicketByStatusForBatimentID($idBatiment)); 
    echo '<p><h2>Fréquence des statuts de tickets</h2></p>';

    
    $this->widget(
            'chartjs.widgets.ChPie', array(
        'width' => 225,
        'height' => 225,
        'htmlOptions' => array(),
        'drawLabels' => true,
        //'animation' => false,
        'datasets' => $this->actionGetTicketByStatusForBatimentID($idBatiment),
        'options' => array
        ()
            )
    );
}

echo "<br/><br/><br/>";

// Graphique en camembert -> fréquence des statuts de tickets
?>
