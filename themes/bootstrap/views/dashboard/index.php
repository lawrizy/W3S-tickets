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

<h1 style="text-align: center;">Tableau de bord</h1>

<div class="graphsDropDownList" style="text-align: left; align-content: left;">
    <?php
    // DDL pour sélectionner un bâtiment spécifique
    echo '<p>';

    $this->widget('bootstrap.widgets.TbLabel', array(
        'type' => 'info', // 'success', 'warning', 'important', 'info' or 'inverse'
        'label' => 'Sélectionnez un bâtiment pour filtrer les résultats:',
    ));

    echo '</p>';

    if (isset($_POST['idBatiment']))
        $defaultSelection = $_POST['idBatiment'];
    else
        $defaultSelection = 'ALL';

    echo '<p>';
    // TODO utiliser le widget du bootstrap pour faire la DDL
/*
    $this->widget('bootstrap.widgets.TbButtonGroup',
        array
        (
            'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'buttons' => array
            (
                array
                (
                    'label' => 'Choisissez un bâtiment',
                    'items' => array
                    (
                        array('label' => 'test', 'value' => 5, 'url' => '#', 'buttonType' => 'ajaxButton', 'ajaxOptions' => array
                        (
                            'type' => 'POST',
                            'url' => CController::createUrl('filterbybatiment'),
                            'data' => array('idBatiment' => 'js: this.value'),
                            'update' => "#graphs",
                        ),),
                    )
                ),
            ),
        ));
*/
    echo CHtml::dropDownList
        (
        // Nom de la DDL
            'batiment_selector',
            // Selection
            $defaultSelection,
            // Data
            array
            (
                'ALL' => 'Tous les bâtiments',
                CHtml::listData(Batiment::model()->findAll(), 'id_batiment', 'nom'),
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
