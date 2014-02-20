<?php
/* @var $this DashboardController */

$this->pageTitle = Yii::app()->name;
?>

<h1>Dashboard</h1>

<p>
    <h2>Graphiques de test</h2>
</p>

<p>
    <?php
    $this->widget(
        'chartjs.widgets.ChBars',
        array(
            'width' => 600,
            'height' => 300,
            'htmlOptions' => array(),
            'labels' => array("January","February","March","April","May","June"),
            'datasets' => array(
                array(
                    "fillColor" => "#DDDDDD",
                    "strokeColor" => "#AAAAAA",
                    "data" => array(100, 20, 300, 70, 50, 140)
                )
            ),
            'options' => array()
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
                    "value" => 50,
                    "color" => "rgba(220,30, 70,1)",
                    "label" => "Hunde"
                ),
                array(
                    "value" => 25,
                    "color" => "rgba(66,66,66,1)",
                    "label" => "Katzen"
                ),
                array(
                    "value" => 40,
                    "color" => "rgba(100,100,220,1)",
                    "label" => "Vögel"
                ),
                array(
                    "value" => 15,
                    "color" => "rgba(20,120,120,1)",
                    "label" => "Mäuse"
                )
            ),
            'options' => array
            (

            )
        )
    );
    ?>
</p>
