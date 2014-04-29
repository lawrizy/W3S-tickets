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
        <h1 class="h1" style="text-decoration: underline;"><?php echo Translate::trad("ChangePassword"); ?></h1>
        <br>
        <br>
        <?php
        $this->widget('bootstrap.widgets.TbAlert', array(
            'id' => 'alert_session',
            'block' => true, // display a larger alert block?
            'fade' => true, // use transitions?
            'closeText' => '&times;', // close link text - if set to false, no close link is displayed
        ));
        ?>
        <div class="table table-bordered"style="padding-left: 12px;" >
            <?php
            echo '<h4 class="h4" style="text-decoration:underline;">'. Translate::trad("Required") . '</h4>';
            echo '</br>';
            echo CHtml::form();
            echo CHtml::label('Votre ancien mot de passe :<span class=required>&nbsp;*</span> ', 'amdp');
            echo CHtml::passwordField('AncienMdp');
            echo CHtml::label('Votre nouveau mot de passe :<span class=required>&nbsp;*</span> ', 'nmdp');
            echo CHtml::passwordField('NouveauMdp');
            echo CHtml::label('Retapez  nouveau mot de passe :<span class=required>&nbsp;*</span> ', 'nmdp1');
            echo CHtml::passwordField('NouveauMdp1');
            echo '</br>';
            ?>
            <div class="Buttons">
                <?php
                echo CHtml::submitButton('changer');
//                $this->widget('bootstrap.widgets.TbButton', array(
//                    'label' => 'changer',
//                    'buttonType' => 'submit',
//                    'type' => 'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
//                    'size' => 'null', // null, 'large', 'small' or 'mini'
//                ));
                ?>
            </div>
            <?php
            echo CHtml::endForm();
            ?>
        </div>
    </body>
</html>
