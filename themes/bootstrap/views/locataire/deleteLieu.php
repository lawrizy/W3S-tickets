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
    array('label'=>'View','url'=>array('view','id'=>$model->id_locataire))
        )
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1 class="h1">Supprimer une adresse pour <?php echo $model->nom; ?></h1>
        <br>
        <?php
        $this->widget('bootstrap.widgets.TbAlert', array(
            'id' => 'alert_session',
            'block' => true, // display a larger alert block?
            'fade' => true, // use transitions?
            'closeText' => '&times;', // close link text - if set to false, no close link is displayed
        ));
        ?>
        <div class="table-bordered">
            <br>
            <?php
            echo CHtml::form();
            echo CHtml::label('Sélectionner le batiment', 'Nom du batiment');
            echo CHtml::dropDownList('Batiment', 'id_batiment', array(CHtml::listData(Batiment::model()->findAllBySql("SELECT b.nom,b.id_batiment FROM db_ticketing.w3sys_lieu l inner join w3sys_batiment b on  l.fk_batiment = b.id_batiment
                    WHERE l.fk_locataire = " . $model->id_locataire . " and l.visible=" . Constantes::VISIBLE), 'id_batiment', 'nom')));
            ?>
            <br>
            <?php
            echo CHtml::submitButton('Supprimer');
            echo CHtml::endForm();
            ?>
        </div>
    </body>
</html>
