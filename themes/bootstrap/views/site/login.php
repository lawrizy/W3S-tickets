
<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = array(
    'Login',
);
?>

<h1><?php echo Translate::trad('ConnexionTitre'); ?></h1>

<p><?php echo Translate::trad('Indication'); ?></p>

<div class="form" id="120">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'login-form',
        'type' => 'horizontal',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    ));
    ?>

    <p class="note"><?php echo Translate::trad('Required'); ?>

        <?php echo $form->textFieldRow($model, 'username'); ?>

        <?php
        echo $form->passwordFieldRow($model, 'password', array(
        ));
        ?>

        <?php echo $form->checkBoxRow($model, 'rememberMe'); ?>

    <div class="form-actions">
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type' => 'primary',
            'label' => Translate::trad('ConnexionButton'),
        ));
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
<script>

    $(document).ready(function() {
        alert("sdsd");
        var conf = {
            frequency: 5000,
            spread: 5,
            duration: 500
        };
        $("#120").vibrate(conf);
    }
           
   )
    alert("sdsd");
</script>
<script type = "text/javascript" src = "jquery-1.3.2.min.js" ></script>
<script type="text/javascript" src="vibrate.js"></script>