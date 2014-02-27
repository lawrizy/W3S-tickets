<?php
/**
 * @var $this DashboardController
 */
?>

<table class="tableGraphs">
    <tr>
        <?php
        if ($idBatiment == 'ALL')
        { // Cas 1 : sélectionner tous les bâtiments

            ?>
            <div>
            
            <?php
            echo '<td>';
            echo "<p><h5>Fréquence des catégories d'incidents (Tous les bâtiments)</h5></p>";
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
            echo '</td>';
            ?></div><?php

            

            echo '<td>';
            echo '<p><h5>Fréquence des statuts de tickets (Tous les bâtiments)</h5></p>';
            $this->widget(
                'chartjs.widgets.ChPie', array(
                    'width' => 125,
                    'height' => 125,
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
            echo '</td>';
        }
        else
        { // Cas 2 : Un bâtiment spécifique a été sélectionné
            echo '<td>';
            echo '<p><h5>Fréquence des catégories d\'incidents (Bâtiment : ';
            echo Batiment::model()->findByAttributes(array('id_batiment' => $idBatiment))->nom;
            ?><?php echo ') </h5></p>'; ?>
    
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
            echo '</td>';

            echo '<td>';
            echo '<p><h5>Fréquence des statuts de tickets (Bâtiment: '
                . Batiment::model()->findByAttributes(array('id_batiment' => $idBatiment))->nom
                . ')</h5></p>';


            $this->widget(
                'chartjs.widgets.ChPie', array(
                    'width' => 125,
                    'height' => 125,
                    'htmlOptions' => array(),
                    'drawLabels' => true,
//'animation' => false,
                    'datasets' => $this->actionGetTicketByStatusForBatimentID($idBatiment),
                    'options' => array
                    ()
                )
            );
            echo '</td>';
        }

        // Placer les graphiques indépendants ci-dessous

        // Graphique des fréquences des entreprises appelées

        ?>
    </tr>
    <!-- fin ligne 1 des graphiques -->
    
    <tr>
        <td>
    <h5>Fréquence d'appel des entreprises (pour tous les tickets)</h5>
    <?php
    $entrepriseFreqAllData = $this->actionGetFrequenceCalledEntreprise();
    //print_r($entrepriseFreqAllData);
    $color_step = 100;
    $r = 0;
    $g = 0;
    $b = 0;
    $entryCount = 1;
    $entrepriseFreqDataSet = array();

    foreach ($entrepriseFreqAllData as $key => $value)
    {
        // Change couleur
        switch ($entryCount * rand(1, 1000) % 3)
        {
            case 0:
                $r += $color_step;
                if ($r > 255) $r -= 255;
                break;
            case 1:
                $g += $color_step;
                if ($g > 255) $g -= 255;
                break;
            case 2:
                $b += $color_step;
                if ($b > 255) $b -= 255;
                break;
        }
        ++$entryCount;

        // Construire le dataset
        $name = array_keys($value)[0];
        $count = array_values($value)[0];
        $set = array(
            "color" => "rgba(" . $r . "," . $g . "," . $b . ", 1)",
            "label" => $name . ": " . $count,
            "value" => (int)$count,
        );
        
        if($count > 0)
            array_push($entrepriseFreqDataSet, $set);
    }

    $this->widget(
        'chartjs.widgets.ChPie', array(
            'width' => 125,
            'height' => 125,
            'htmlOptions' => array(),
            'drawLabels' => true,
            'datasets' => $entrepriseFreqDataSet,
            'options' => array()
        )
    );
    // ******************** END ************************
    ?>
        </td>
    </tr>
</table>
