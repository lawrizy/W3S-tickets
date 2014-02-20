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
    $this->widget(
        'chartjs.widgets.ChBars',
        array(
            'width' => 600,
            'height' => 300,
            'htmlOptions' => array(),
            'labels' => array("Chauffage/climatisation", "Electricité", "Sanitaire", "Ascenceur", "Sécurité", "Divers"),
            'datasets' => array(
                array(
                    "fillColor" => "#DDDDDD",
                    "strokeColor" => "#AAAAAA",
                    "data" => array(18, 23, 7, 2, 13, 5)
                )
            ),
            'options' => array
            (
                'scaleOverride' => true,
                'scaleSteps' => 12,
                'scaleStepWidth' => 2,
                'scaleStartValue' => 0,
                'scaleLineWidth' => 1,
            )
        )
    );
    echo "<br/><br/><br/>";
    $this->widget(
        'chartjs.widgets.ChPie',
        array(
            'width' => 600,
            'height' => 300,
            'htmlOptions' => array(),
            'drawLabels' => true,
            //'animation' => false,
            'datasets' => array(
                array(
                    "value" => 7,
                    "color" => "rgba(220, 0,0,1)",
                    "label" => "Nouveau"
                ),
                array(
                    "value" => 42,
                    "color" => "rgba(242,106,22,1)",
                    "label" => "En cours"
                ),
                array(
                    "value" => 19,
                    "color" => "rgba(66,242,22,1)",
                    "label" => "Clôturé"
                ),
            ),
            'options' => array
            (

            )
        )
    );
    ?>
</p>
