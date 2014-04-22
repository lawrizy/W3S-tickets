<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name . ' - About';
$this->breadcrumbs = array(
    'A propos',
);
SiteController::assignLangue();
?>
<?php echo '<h1>' . Translate::trad('APropos') . '</h1>';
echo '<p><b>' . Translate::trad('developperTeam') . '</b></p>';
?>