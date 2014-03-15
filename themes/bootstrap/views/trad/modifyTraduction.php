<?php

/* @var $this TradController */
/* @var $model Trad */
/* @var $form CActiveForm */

$this->breadcrumbs = array(
    'admin' => '../admin',
    Translate::trad('ModifierTradExistante'),
);

$this->menu = array(
    array('label' => 'Ajouter une nouvelle traduction', 'url' => array('addTraduction')),
);

?>
<div id="retour">
    <a href="../admin">Retour à la page d'administration</a><br/>
</div>

<div class="form">
    <?php
    // FORMULAIRE START
    $this->widget('bootstrap.widgets.TbGridView', array(
        'type' => 'striped bordered condensed',
        'id' => 'trad-grid',
        'dataProvider' => $model->search(),
        'filter' => $model,
        'columns' => array(
            array(
                'name' => 'code',
                'value' => '$data->code',
            ),
            array(
                'name' => 'fr',
                'value' => '$data->fr',
            ),
            array(
                'name' => 'en',
                'value' => '$data->en',
            ),
            array(
                'name' => 'nl',
                'value' => '$data->nl',
            ),

            array
            (
                'class' => 'bootstrap.widgets.TbButtonColumn',
                'template' => '{update}'
            ),
        ),
    ));
    ?>
</div>
