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
            'chartjs.widgets.ChBars', array(
        'width' => 800,
        'height' => 300,
        'htmlOptions' => array(),
        'labels' => $this->getCategoriesLabel(),
        'datasets' => array(
            array(
                "fillColor" => "rgba(34,167,212,1)",
                "strokeColor" => "#AAAAAA",
                "data" => $this->getTicketByCategorie()
            )
        ),
        'options' => array()
            )
    );
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
        (
        )
            )
    );
    ?>
</p>