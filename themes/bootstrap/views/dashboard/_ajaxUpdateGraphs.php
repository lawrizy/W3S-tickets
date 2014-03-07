<?php
/**
 * @var $this DashboardController
 */

// Graphique en bâtonnets -> fréquence des catégories d'incidents (Pour tous les bâtiments ou pour un bâtiment spécifique)

if ($idBatiment == 'ALL') { // Cas 1 : sélectionner tous les bâtiments
    ?>
    <p><h3><?php echo Translate::trad('AjaxTitre'); ?></h3></p>
    <?php ?>
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
    echo '<p><h3>' . Translate::trad('AjaxStatutTicket') . '</h3></p>';

    $this->widget(
            'chartjs.widgets.ChPie', array(
        'width' => 175,
        'height' => 175,
        'htmlOptions' => array(),
        'drawLabels' => true,
        'datasets' => array(
            array(
                "value" => (int) Ticket::model()->countByAttributes(array('fk_statut' => 1)),
                "color" => "rgba(220, 0,0,1)",
                "label" => (int) Ticket::model()->countByAttributes(array('fk_statut' => 1)) . Translate::trad('AjaxStatutNew')
            ),
            array(
                "value" => (int) Ticket::model()->countByAttributes(array('fk_statut' => 2)),
                "color" => "rgba(242,106,22,1)",
                "label" => (int) Ticket::model()->countByAttributes(array('fk_statut' => 2)) . Translate::trad('AjaxStatutInProgress')
            ),
            array(
                "value" => (int) Ticket::model()->countByAttributes(array('fk_statut' => 3)),
                "color" => "rgba(66,200,22,1)",
                "label" => (int) Ticket::model()->countByAttributes(array('fk_statut' => 3)) . Translate::trad('AjaxStatutClosed')
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
    ?>
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
?>
<br/><br/><br/>

<h3><?php echo Translate::trad('AjaxFrenquenceEntreprise'); ?></h3>
<?php
$entrepriseFreqAllData = $this->actionGetFrequenceCalledEntreprise();
$color_step = 100;
$r = 0;
$g = 0;
$b = 0;
$entryCount = 1;
$entrepriseFreqDataSet = array();

foreach ($entrepriseFreqAllData as $key => $value) {
    // Change couleur
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
    $entryCount;
    ++$entryCount;

    // Construire le dataset
    /*
     * Problème réglé, solution du problème ici : http://stackoverflow.com/questions/16358973/parse-error-syntax-error-unexpected-with-php-5-3
     * Le problème résidait bien dans le fait qu'en PHP 5.3 il est impossible de prendre une valeur directement depuis la valeur de retour d'une fonction.
     * exemple (PHP 5.3):
     * $name = $array_keys($value)[0]; // IMPOSSIBLE en 5.3! On ne peut pas prendre une valeur d'un tableau retourné par une fonction directement.
     * Solution -> Il faut passer par une variable temporaire avant de pouvoir utiliser les "brackets".
     */
    $nameTemp = array_keys($value);
    $name = (string)$nameTemp[0];
    $countTemp = array_values($value);
    $count = (string)$countTemp[0];
    $set = array(
        "color" => "rgba(" . $r . "," . $g . "," . $b . ", 1)",
        "label" => $name . ": " . $count,
        "value" => (int) $count,
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
// ******************** END ************************

?>
