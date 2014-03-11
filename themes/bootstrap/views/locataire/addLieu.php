<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
//$controllerLocataire = new LocataireController();
$this->menu = array(
    array('label' => 'Admin', 'url' => array('admin')),
    array('label' => 'View', 'url' => array('view', 'id' => $model->id_locataire))
        )
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1 class="h1">Ajouter une adresse pour <?php echo $model->nom; ?></h1>
        <br>
        <?php
        $this->widget('bootstrap.widgets.TbAlert', array(
            'id' => 'alert_session',
            'block' => true, // display a larger alert block?
            'fade' => true, // use transitions?
            'closeText' => '&times;', // close link text - if set to false, no close link is displayed
        ));
        ?>
        <?php
        $lieux = Lieu::model()->findAllByAttributes(array('visible' => Constantes::VISIBLE, 'fk_locataire' => $model['id_locataire']));
        $batiments = Batiment::model()->findAllByAttributes(array('visible' => Constantes::VISIBLE));

        foreach ($lieux as $lieu) {
            foreach ($batiments as $key => $batiment) {
                if ($lieu['fk_batiment'] == $batiment['id_batiment'])
                    unset($batiments[$key]);
            }
        }
        ?>
        <div class = "table-bordered">
            <br>
            <?php
            echo CHtml::form();
            echo CHtml::label('Sélectionner le batiment', 'Nom du batiment');
            echo CHtml::dropDownList('Batiment', 'id_batiment', array(CHtml::listData($batiments, 'id_batiment', 'nom')));
            ?>
            <br>
            <?php
            echo CHtml::submitButton('Ajouter');
            echo CHtml::endForm();
            ?>
        </div>
    </body>
</html>
