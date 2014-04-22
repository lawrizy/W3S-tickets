<?php
/* @var $this SiteController */
$aPropos = Translate::trad('APropos');
$this->pageTitle = Yii::app()->name . ' - ' . $aPropos;
$this->breadcrumbs = array(
    'A propos',
);
SiteController::assignLangue();
echo '<h1>' . $aPropos . '</h1>';
echo '<p><b>' . Translate::trad('developperTeam') . '</b></p>';