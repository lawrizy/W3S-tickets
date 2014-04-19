
<!-- @var $this DashboardController -->
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/graphs.css"
              media="screen, projection"/>

        <?php $this->pageTitle = Yii::app()->name; ?>
    </head>
    <body>
        <h1 style="text-align: center;"><?php echo Translate::trad('Dashboard'); ?></h1>

        <div class="graphsDropDownList" style="text-align: left; align-content: left;">
            <?php
            echo '<p>';
            $this->widget('bootstrap.widgets.TbLabel', array( // DDL pour sélectionner un bâtiment spécifique
                'type' => 'info', // 'success', 'warning', 'important', 'info' or 'inverse'
                'label' => Translate::trad('SelectionnerBat'),
            ));
            echo '</p>';

            echo '<p>';
            echo CHtml::dropDownList(
                'batiment_selector', // Nom de la DDL
                'ALL', // Valeur selectionnée par défaut
                array(// Data
                    'ALL' => Translate::trad('AllBatiment'),
                    CHtml::listData(Batiment::model()->findAllByAttributes(
                            array('visible' => Constantes::VISIBLE)), 'id_batiment', 'nom'),
                ), array(// htmlOptions
                    'ajax' => array(
                        'type' => 'POST',
                        'url' => CController::createUrl('filterbybatiment'),
                        'data' => array('idBatiment' => 'js: this.value'),
                        'update' => "#graphs",
                ))
            );
            echo '&nbsp;<img class="loadingSous" src="../../assets/7d883f12/img/loading.gif">';
            echo '</p>';
            ?>
        </div> <!-- FIN DIV DROPDOWNLIST GRAPHS -->

        <div id="graphs" class="graphs">
            <?php
            // Voir le fichier _ajaxUpdateGraphs.php pour la construction des graphiques.
            $this->renderPartial('_ajaxUpdateGraphs', array('idBatiment' => 'ALL'));
            ?>
        </div>
        
        <?php
        // Placer les graphiques indépendants ci-dessous
        // Graphique des fréquences des entreprises appelées
        echo '<br/><br/><br/>';
        echo '<h3>' . Translate::trad('AjaxFrenquenceEntreprise') . '</h3>';

        $entrepriseFreqAllData = $this->getFrequenceCalledEntreprise();
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
            $name = (string) $nameTemp[0];
            if ($name === "Entreprise_defaut") // On ne prend pas en compte l'entreprise par défaut
                continue;
            $countTemp = array_values($value);
            $count = (string) $countTemp[0];
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
        ?>
    </body>
</html>