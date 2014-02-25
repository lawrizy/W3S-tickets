<?php

// Graphique en bâtonnets -> fréquence des catégories d'incidents (Pour tous les bâtiments ou pour un bâtiment spécifique)

if ($idBatiment == 'ALL') {
    ?>
    <p><h3 style="text-align: center;">Fréquence des catégories d'incidents (Tous les bâtiments)</h3></p>
    <?php

    ?>
    <div><?php

    $this->widget(
        'chartjs.widgets.ChBars', array(
            'width' => 500,
            'height' => 200,
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
    ?></div><?php

    echo '<p><h3 style="text-align: center;">Fréquence des statuts de tickets</h3></p>';

    $this->widget(
        'chartjs.widgets.ChPie', array(
            'width' => 175,
            'height' => 175,
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

    // TODO ajouter graphique -> nombre d'incidents (en fonction du statut) par bâtiment

} else {
    echo '<p><h3 style="text-align: center;">Fréquence des catégories d\'incidents (Bâtiment : ';
    echo Batiment::model()->findByAttributes(array('id_batiment' => $idBatiment))->nom;
    ?><?php echo ') </h3></p>'; ?>

    <?php

    $this->widget(
        'chartjs.widgets.ChBars', array(
            'width' => 500,
            'height' => 200,
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
    echo '<p><h3>Fréquence des statuts de tickets</h3></p>';


    $this->widget(
        'chartjs.widgets.ChPie', array(
            'width' => 175,
            'height' => 175,
            'htmlOptions' => array(),
            'drawLabels' => true,
//'animation' => false,
            'datasets' => $this->actionGetTicketByStatusForBatimentID($idBatiment),
            'options' => array
            ()
        )
    );
}

?>
