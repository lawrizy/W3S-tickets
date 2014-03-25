<?php
/**
 * @var $this DashboardController
 */

// Graphique en bâtonnets -> fréquence des catégories d'incidents (Pour tous les bâtiments ou pour un bâtiment spécifique)

if ($idBatiment == 'ALL') { // Cas 1 : sélectionner tous les bâtiments
    echo '<p><h3>' . Translate::trad('AjaxTitre') . '</h3></p>';
    
    echo '<div>';
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
    echo '</div>';
    
    echo '<p><h3>' . Translate::trad('AjaxStatutTicket') . '</h3></p>';

    $this->widget(
        'chartjs.widgets.ChPie', array(
            'width' => 175,
            'height' => 175,
            'htmlOptions' => array(),
            'drawLabels' => true,
            'datasets' => array(
                array(
                    "value" => (int)Ticket::model()->countByAttributes(array('fk_statut' => 1)),
                    "color" => "rgba(220, 0,0,1)",
                    "label" => (int)Ticket::model()->countByAttributes(array('fk_statut' => 1)) . Translate::trad('AjaxStatutNew')
                ),
                array(
                    "value" => (int)Ticket::model()->countByAttributes(array('fk_statut' => 2)),
                    "color" => "rgba(242,106,22,1)",
                    "label" => (int)Ticket::model()->countByAttributes(array('fk_statut' => 2)) . Translate::trad('AjaxStatutInProgress')
                ),
                array(
                    "value" => (int)Ticket::model()->countByAttributes(array('fk_statut' => 3)),
                    "color" => "rgba(66,200,22,1)",
                    "label" => (int)Ticket::model()->countByAttributes(array('fk_statut' => 3)) . Translate::trad('AjaxStatutClosed')
                ),
            ),
            'options' => array
            ()
        )
    );
} else { // Cas 2 : Un bâtiment spécifique a été sélectionné
    echo '<p><h3>' . Translate::trad('AjaxFrequenceStatutTicket') .
        Batiment::model()->findByAttributes(array('id_batiment' => $idBatiment))->nom
        . ') </h3></p>';
    
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
    echo '<p><h3>' . Translate::trad('AjaxFrequenceStatutTicket')
        . Batiment::model()->findByAttributes(array('id_batiment' => $idBatiment))->nom
        . ')</h3></p>';


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

// Placer les graphiques indépendants ci-dessous
// Graphique des fréquences des entreprises appelées
echo '<br/><br/><br/>';
echo '<h3>' . Translate::trad('AjaxFrenquenceEntreprise') . '</h3>';

$entrepriseFreqAllData = $this->actionGetFrequenceCalledEntreprise();
$color_step = 100;
$r = 0;
$g = 0;
$b = 0;
$entryCount = 1;
$entrepriseFreqDataSet = array();

foreach ($entrepriseFreqAllData as $key => $value) {
    // Couleur aléatoire
    switch ($entryCount * rand(1, 1000) % 3) {
        case 0:
            $r += $color_step;
            if ($r > 255)
                $r -= 255;
            break;
        case 1:
            $g += $color_step;
            if ($g > 255)
                $g -= 255;
            break;
        case 2:
            $b += $color_step;
            if ($b > 255)
                $b -= 255;
            break;
    }
    ++$entryCount;

    // Construire le dataset
    $nameTemp = array_keys($value);
    $name = (string)$nameTemp[0];
    if ($name === "Entreprise_defaut") // On ne prend pas en compte l'entreprise par défaut
        continue;
    $countTemp = array_values($value);
    $count = (string)$countTemp[0];
    $set = array(
        "color" => "rgba(" . $r . "," . $g . "," . $b . ", 1)",
        "label" => $name . ": " . $count,
        "value" => (int)$count,
    );

    array_push($entrepriseFreqDataSet, $set);
}

$this->widget(
    'chartjs.widgets.ChPie', array(
        'width' => 175,
        'height' => 175,
        'htmlOptions' => array(),
        'drawLabels' => true,
        'datasets' => $entrepriseFreqDataSet,
        'options' => array()
    )
);

/* BEGIN Graphique de répartitions des tickets entre les différents users */

/* END */

// ******************** END ************************

?>