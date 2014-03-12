<?php

/* @var $this TradController */
/* @var $model Trad */

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
<?php

$this->renderPartial('_formModifyTraduction', array('model' => $model));
?>
