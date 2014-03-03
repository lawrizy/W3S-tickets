<?php
/* @var $this Controller */
Yii::app()->language = Yii::app()->session['_lang'];
?>
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
                <div id="language" style="text-align: right;margin-right: 50px; margin-top: 10px;" >
                    <?php
                    switch (Yii::app()->session['_lang']) {
                        case 'fr':
                            echo '<a href="' . Yii::app()->request->baseUrl . '/index.php/site/chooselanguageen?ctr=' . Yii::app()->request->url . '" style="margin-right: 10px;" >';
                            echo '<img src="' . Yii::app()->request->baseUrl . '/images/en.png" /></a>';
                            echo '<a href="' . Yii::app()->request->baseUrl . '/index.php/site/chooselanguagenl?ctr=' . Yii::app()->request->url . '">';
                            echo '<img src="' . Yii::app()->request->baseUrl . '/images/nl.png" /></a>';
                            break;
                        case'en':
                            echo '<a href="' . Yii::app()->request->baseUrl . '/index.php/site/chooselanguagefr?ctr=' . Yii::app()->request->url . '" style="margin-right: 10px;">';
                            echo '<img src="' . Yii::app()->request->baseUrl . '/images/fr.png" /></a>';
                            echo '<a href="' . Yii::app()->request->baseUrl . '/index.php/site/chooselanguagenl?ctr=' . Yii::app()->request->url . '">';
                            echo '<img src="' . Yii::app()->request->baseUrl . '/images/nl.png" /></a>';
                            break;
                        default :
                            echo '<a href="' . Yii::app()->request->baseUrl . '/index.php/site/chooselanguagefr?ctr=' . Yii::app()->request->url . '" style="margin-right: 10px;">';
                            echo '<img src="' . Yii::app()->request->baseUrl . '/images/fr.png" /></a>';
                            echo '<a href="' . Yii::app()->request->baseUrl . '/index.php/site/chooselanguageen?ctr=' . Yii::app()->request->url . '">';
                            echo '<img src="' . Yii::app()->request->baseUrl . '/images/en.png" /></a>';
                            break;
                    }
                    ?>
                </div>
                <div id="aaaa"><table>
                        <tr>
                            <td width="50%"><a href=<?php echo Yii::app()->request->baseUrl.'/index.php'; ?>><img  src="http://web3sys.com/tickets/images/HServices.png"></img></a></td>
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
                        array('label' => Yii::t('main/MenuBar', 'APropos'), 'url' => array('/site/page', 'view' => 'about'), 'template' => '| {menu}'),
                        array('label' => Yii::t('main/MenuBar', 'Contact'), 'url' => array('/site/contact'), 'template' => '| {menu}'),
                        array('label' => Yii::t('/main/MenuBar', 'CreerTicket'), 'url' => array('/locataire/admin'), 'visible' => Yii::app()->session['Utilisateur'] == 'User', 'template' => '| {menu}'),
                        array('label' => Yii::t('/main/MenuBar', 'ListeTicket'), 'url' => array('/ticket/admin'), 'visible' => Yii::app()->session['Utilisateur'] == 'User','template' => '| {menu}'),
                        array('label' => Yii::t('/main/MenuBar', 'DashBoard'), 'url' => array('dashboard/vue'), 'visible' => Yii::app()->session['Utilisateur'] == 'User' && $var['fk_fonction'] == 2,'template' => '| {menu}'),
                        array('label' => Yii::t('/main/MenuBar', 'Creer') . Yii::app()->session['NouveauTicket'] . ' ticket', 'url' => array('/ticket/create'), 'visible' => Yii::app()->session['Utilisateur'] == 'Locataire','template' => '| {menu}'),
                        array('label' => 'Admin', 'url' => array('/site/admin'), 'visible' => Yii::app()->session['Utilisateur'] == 'User' && $var['fk_fonction'] == 2,'template' => '| {menu}'),
                        array('label' => Yii::t('main/MenuBar', 'Connexion'), 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest,'template' => '| {menu}'),
                        array('label' => Yii::t('main/MenuBar', 'DeConnexion') . ' (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest,'template' => '| {menu}'),
                        array('label'=>'','template' => '| {menu}')
                    ),
                ));
                Yii::app()->session['NouveauTicket'] = '';
                ?>
            </div> 
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
                Copyright &copy; <?php echo date('Y') . ' ' . Yii::t('index', 'Par'); ?>  <a href="http://web3sys.com">Web3Sys</a>.<br/>
                <?php echo Yii::t('index', 'DroitsReserve'); ?><br/>
            </div><!-- footer -->

        </div><!-- page -->

    </body>
</html>
