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
        <div class="table-bordered">
            <?php
            echo '<h4 class="h4" style="text-decoration:underline;">' . Translate::trad("Required") . '</h4>';
            echo '<h5 class="h5" style="text-decoration:underline;">'. Translate::trad("PasswordRestrictionsMessage") .'</h5>';
            echo CHtml::form();
            echo CHtml::label(Translate::trad("AncienMotDePasse") . ' :<span class=required>&nbsp;*</span> ', 'amdp');
            echo CHtml::passwordField('AncienMdp');
            echo CHtml::label(Translate::trad("NouveauMotDePasse") . ' :<span class=required>&nbsp;*</span> ', 'nmdp');
            echo CHtml::passwordField('NouveauMdp', '', array('id' => 'NouveauMdp', 'onkeyup' => 'notAllowed();'));
            echo CHtml::label(Translate::trad("RetaperMDP") . ' :<span class=required>&nbsp;*</span> ', 'nmdp1');
            echo CHtml::passwordField('NouveauMdp1');
            echo '</br>';
            ?>
            <div class="Buttons">
                <?php
                echo CHtml::submitButton(Translate::trad("ChangePasswordButtonCaption"));
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
<script>
    function notAllowed() {
        var mdp = $('#NouveauMdp')[0];
        if (event.keyCode === 32) // espace
        {
            alert("Caractère non autorisé !\nLe caractère à été effacé");
            var afterChange = mdp.value.substr(0, mdp.value.length - 1);
            mdp.value = afterChange;
        }
    }
    $(".Buttons").click(function() {
        var nvmdp1 = document.getElementById("NouveauMdp").value;
        if (nvmdp1.length < 4)
        {
            alert("Le mot de passe doit être de 4 caractères minimum");
            return false;
        }
    });
</script>
