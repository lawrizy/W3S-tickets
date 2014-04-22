<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name . ' - About';
$this->breadcrumbs = array(
    'A propos',
);
SiteController::assignLangue();
?>
<?php echo '<h1>' . Translate::trad('APropos') . '</h1>';

echo '<p>This application <br>';
echo '<u>was developped by:</u><br>';
echo '<b>';
    echo '<br>';
    echo 'Ridounet , Capelle and Desaedeleer</b></p>';
?>