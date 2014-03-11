<?php

/* @var $this TradController */
/* @var $model Trad */

$this->breadcrumbs = array(
    'admin' => '../admin',
    'Ajouter une nouvelle traduction',
);

$this->menu = array(
    
);

?>
<div id="retour">
    <a href="../admin">Retour à la page d'administration</a>
</div>
<?php

//$this->renderPartial('_formCreateCat', array('model' => $model));
$this->renderPartial('_formCreateTraduction', array('model' => $model));
?>
