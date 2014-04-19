<?php
/**
 * @var $this DashboardController
 */

if ($idBatiment == 'ALL') { // Cas 1 : sélectionner tous les bâtiments
    echo '<p><h3>' . Translate::trad('AjaxTitre') . '</h3></p>';
    echo '<div>';
    $this->widget(
        'chartjs.widgets.ChBars', array(
            'width' => 500,
            'height' => 200,
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
    echo '</div>';

    echo '<p><h3>' . Translate::trad('AjaxStatutTicket') . '</h3></p>';
    
    $opened = Ticket::model()->countByAttributes(array('fk_statut' => Constantes::STATUT_OPENED, 'visible' => Constantes::VISIBLE));
    $treatment = Ticket::model()->countByAttributes(array('fk_statut' => Constantes::STATUT_TREATMENT, 'visible' => Constantes::VISIBLE));
    $closed = Ticket::model()->countByAttributes(array('fk_statut' => Constantes::STATUT_CLOSED, 'visible' => Constantes::VISIBLE));
    
    $this->widget(
        'chartjs.widgets.ChPie', array(
            'width' => 175,
            'height' => 175,
            'htmlOptions' => array(),
            'drawLabels' => true,
            'datasets' => array(
                array(
                    "value" => (int) $opened,
                    "color" => "rgba(220, 0,0,1)",
                    "label" => (int) $opened . Translate::trad('AjaxStatutNew')
                ),
                array(
                    "value" => (int) $treatment,
                    "color" => "rgba(242,106,22,1)",
                    "label" => (int) $treatment . Translate::trad('AjaxStatutInProgress')
                ),
                array(
                    "value" => (int) $closed,
                    "color" => "rgba(66,200,22,1)",
                    "label" => (int) $closed . Translate::trad('AjaxStatutClosed')
                ),
            ),
            'options' => array()
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
            'labels' => $this->getCategoriesLabel(),
            'datasets' => array(
                array(
                    "fillColor" => "rgba(34,167,212,1)",
                    "strokeColor" => "#AAAAAA",
                    "data" => $this->getTicketByCategorieForBatimentID($idBatiment),
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
            'datasets' => $this->getTicketByStatusForBatimentID($idBatiment),
            'options' => array()
        )
    );
}

?>
<script>
    $(document).ready(function() {
        $(".loadingSous").hide();
    });

    $("#batiment_selector").ajaxStart(function() {
        $(".loadingSous").show();

    });
    $("#batiment_selector").ajaxStop(function() {
        $(".loadingSous").hide();

    });
</script>
