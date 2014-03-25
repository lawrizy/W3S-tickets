
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
            echo CHtml::dropDownList(
                    'batiment_selector', // Nom de la DDL
                    $defaultSelection, // Valeur selectionnée par défaut
                    array( // Data
                        'ALL' => Translate::trad('AllBatiment'),
                        CHtml::listData(Batiment::model()->findAllByAttributes(array('visible' => Constantes::VISIBLE)), 'id_batiment', 'nom'),
                    ),
                    array( // htmlOptions
                        'ajax' => array(
                                    'type' => 'POST',
                                    'url' => CController::createUrl('filterbybatiment'),
                                    'data' => array('idBatiment' => 'js: this.value'),
                                    'update' => "#graphs",
                    ))
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
    </body>
</html>
