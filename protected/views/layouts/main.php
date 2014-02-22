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
                <div id="aaaa"><table>
                        <tr>
                            <td width="50%"><a href=<?php echo Yii::app()->request->baseUrl; ?>><img  src="http://web3sys.com/tickets/images/HServices.png"></img></a></td>
                            <?php
//                                if (Yii::app()->getController()->getAction()->id == 'traitement' || Yii::app()->getController()->getAction()->id == 'update' || Yii::app()->getController()->getAction()->id == 'close'|| Yii::app()->getController()->getAction()->id == 'create')
//                                    echo "../../../images/HServices.png";
//                                elseif (Yii::app()->getController()->getAction()->id == 'index') {
//                                    echo "./images/HServices.png";
//                                } elseif (Yii::app()->getController()->getAction() == 'dashboard/index') {
//                                    echo "../images/HServices.png";
//                                } else {
//                                    echo '../../images/HServices.png';
//                                }
                            ?>


                            <td width="50%"><a href="http://web3sys.com"><img align="right" width="70%"   src="http://web3sys.com/tickets/images/logoW3S.jpg"></img></a></td>
                            <?php
//                                if (Yii::app()->getController()->getAction()->id == 'traitement' || Yii::app()->getController()->getAction()->id == 'update' || Yii::app()->getController()->getAction()->id == 'close' || Yii::app()->getController()->getAction()->id == 'create')
//                                    echo "../../../images/logoW3S.jpg";
//                                elseif (Yii::app()->getController()->getAction()->id == 'index') {
//                                    echo "./images/logoW3S.jpg";
//                                } elseif (Yii::app()->getController()->getAction() == 'dashboard/index') {
//                                    echo "../images/logoW3S.png";
//                                } else {
//                                    echo '../../images/logoW3S.jpg';
//                                }
                            ?>


                        </tr></table> </div>


            </div><!-- header -->

            <div id="mainmenu">
                <?php
                $var = Yii::app()->session['Logged'];
                $this->widget('zii.widgets.CMenu', array(
                    'items' => array(
                        array('label' => 'A propos', 'url' => array('/site/page', 'view' => 'about')),
                        array('label' => 'Contact', 'url' => array('/site/contact')),
                        array('label' => 'Créer un nouveau ticket', 'url' => array('/locataire/admin'), 'visible' => Yii::app()->session['Utilisateur'] == 'User'),
                        array('label' => 'Liste des tickets', 'url' => array('/ticket/admin'), 'visible' => Yii::app()->session['Utilisateur'] == 'User'),
                        array('label' => 'Dashboard', 'url' => array('dashboard/vue'), 'visible' => Yii::app()->session['Utilisateur'] == 'User' && $var['fk_fonction'] == 2),
                        array('label' => 'Créer un ' . Yii::app()->session['NouveauTicket'] . ' ticket', 'url' => array('/ticket/create'), 'visible' => Yii::app()->session['Utilisateur'] == 'Locataire'),
                        array('label' => 'Connexion', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                        array('label' => 'Déconnexion (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest),
                    ),
                ));
                Yii::app()->session['NouveauTicket'] = '';
                ?>
            </div> mainmenu 
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
                Copyright &copy; <?php echo date('Y'); ?> by <a href="http://web3sys.com">Web3Sys</a>.<br/>
                All Rights Reserved.<br/>
            </div><!-- footer -->

        </div><!-- page -->

    </body>
</html>
