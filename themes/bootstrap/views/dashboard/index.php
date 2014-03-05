<html>
    <head>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/graphs.css"
              media="screen, projection"/>
    </head>

    <body>
        <?php
        /* @var $this DashboardController */

        $this->pageTitle = Yii::app()->name;
        ?>

        <h1 style="text-align: center;"><?php echo Translate::trad('Dashboard'); ?></h1>

        <div class="graphsDropDownList" style="text-align: left; align-content: left;">
            <?php
            // DDL pour sélectionner un bâtiment spécifique
            echo '<p>';

            $this->widget('bootstrap.widgets.TbLabel', array(
                'type' => 'info', // 'success', 'warning', 'important', 'info' or 'inverse'
                'label' => Translate::trad('SelectionnerBat'),
            ));

            echo '</p>';

            if (isset($_POST['idBatiment']))
                $defaultSelection = $_POST['idBatiment'];
            else
                $defaultSelection = 'ALL';

            echo '<p>';
            echo CHtml::dropDownList
                    (
                    // Nom de la DDL
                    'batiment_selector',
                    // Selection
                    $defaultSelection,
                    // Data
                    array
                (
                'ALL' => Translate::trad('AllBatiment'),
                CHtml::listData(Batiment::model()->findAllByAttributes(array('visible'=>1)), 'id_batiment', 'nom'),
                    ),
                    // htmlOptions
                    array
                (
                'ajax' => array
                    (
                    'type' => 'POST',
                    'url' => CController::createUrl('filterbybatiment'),
                    'data' => array('idBatiment' => 'js: this.value'),
                    'update' => "#graphs",
                ),
                    )
            );
            ?>
        </div>
        <!-- FIN DIV DROPDOWNLIST GRAPHS -->

        <div id="graphs" class="graphs">
            <?php
            // Voir le fichier _ajaxUpdateGraphs.php pour la construction des graphiques.
            $this->renderPartial('_ajaxUpdateGraphs', array('idBatiment' => 'ALL'));
            ?>

        </div>
        <!-- END DIV Graphs -->

        <!--
        <div id="quickstats">
        <br/><br/>
        <h3 style="text-align: center;">Quick stats</h3>
        <ul>
            <li>Bâtiment avec le plus de tickets ouverts: </li>
        </ul>
        </div>
        -->
    </body>
</html>