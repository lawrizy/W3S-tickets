<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
        <![endif]-->

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body>

        <div class="container" id="page">

            <div id="header">
                <div id="logo"><img src=<?php
                    if (Yii::app()->getController()->getAction()->id== 'traitement')
                        echo "../../../images/landing_logo.png";
                    else {
                        echo '../../images/landing_logo.png';
                    }
                    ?>></img></div>
            </div><!-- header -->

            <div id="mainmenu">
                <?php
                $this->widget('zii.widgets.CMenu', array(
                    'items' => array(
                        array('label' => 'Accueil', 'url' => array('/site/index')),
                        array('label' => 'A propos', 'url' => array('/site/page', 'view' => 'about')),
                        array('label' => 'Contact', 'url' => array('/site/contact')),
                        array('label' => 'Connexion', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                        array('label' => 'Déconnexion (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest),
                        array('label' => 'Créer un nouveau ticket', 'url' => array('/locataire/admin'), 'visible' => Yii::app()->session['Utilisateur'] == 'User'),
                        array('label' => 'Liste des tickets', 'url' => array('/ticket/admin'), 'visible' => Yii::app()->session['Utilisateur'] == 'User'),
                        array('label' => 'Créer un ' . Yii::app()->session['NouveauTicket'].' ticket', 'url' => array('/ticket/create'), 'visible' => Yii::app()->session['Utilisateur'] == 'Locataire'),
                        array('label' => 'Dashboard', 'url' => array('/dashboard')),
                        array('label' => 'Créer un ' . Yii::app()->session['NouveauTicket'] . ' ticket', 'url' => array('/ticket/create'), 'visible' => Yii::app()->session['Utilisateur'] == 'Locataire')
                    ),
                ));
                Yii::app()->session['NouveauTicket'] = '';
                ?>
            </div><!-- mainmenu -->
            <?php if (isset($this->breadcrumbs)): ?>
                <?php
                $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                ));
                ?><!-- breadcrumbs -->
            <?php endif ?>

            <?php echo $content; ?>

            <div class="clear"></div>

            <div id="footer">
                Copyright &copy; <?php echo date('Y'); ?> by Web3Sys.<br/>
                All Rights Reserved.<br/>
                <?php echo Yii::powered(); ?>
            </div><!-- footer -->

        </div><!-- page -->

    </body>
</html>
