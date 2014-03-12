<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
/*
 * @property $this UserController
 */
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1 class="h1" style="text-decoration: underline;">Changer votre mot de passe</h1>
        <br>
        <br>

        <div class="table-bordered">
            <?php
            echo '</br>';
            echo CHtml::form('changepassword');
            echo CHtml::label('Votre ancien mot de passe: ', 'la');
            echo CHtml::passwordField('AncienMdp');
            echo CHtml::label('Votre nouveau mot de passe: ', 'la');
            echo CHtml::passwordField('NouveauMdp');
            echo CHtml::label('Retapez  nouveau mot de passe: ', 'la');
            echo CHtml::passwordField('NouveauMdp1');
            echo '</br>';
            ?>
            <div class="Buttons">
                <?php
                $this->widget('bootstrap.widgets.TbButton', array(
                    'label' => 'changer',
                    'buttonType' => 'submit',
                    'type' => 'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'size' => 'null', // null, 'large', 'small' or 'mini'
                ));
                ?>
            </div>
            <?php
            echo CHtml::endForm();
            ?>
        </div>
    </body>
</html>
