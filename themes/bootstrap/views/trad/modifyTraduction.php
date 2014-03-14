<?php

/* @var $this TradController */
/* @var $model Trad */
/* @var $form CActiveForm */

$this->breadcrumbs = array(
    'admin' => '../admin',
    'Modifier une traduction existante',
);

$this->menu = array(

);

?>
<div id="retour">
    <a href="../admin">Retour à la page d'administration</a>
</div>

<div class="form">
    <?php
    // Création d'un nouveau widget de formulaire
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'trad-form',
        'enableAjaxValidation' => false,
    ));
    
    // FORMULAIRE START
    $this->widget('bootstrap.widgets.TbGridView', array(
        'type' => 'striped bordered condensed',
        'id' => 'trad-grid',
        'dataProvider' => $model->search(),
        //'filter' => $model,
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
                'template' => '{view}'
            ),
        ),
    ));
    
    $this->endWidget('modify-trad-form');
    ?>
</div>
