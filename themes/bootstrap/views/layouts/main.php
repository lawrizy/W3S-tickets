<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="language" content="en"/>

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css"/>

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>

        <?php Yii::app()->bootstrap->register(); ?>
    </head>

    <body>

        <!-- HEADER -->

        <div id="header">
            <?php
            $var = Yii::app()->session['Logged'];
            $this->widget('bootstrap.widgets.TbNavbar', array(
                'items' => array(
                    array(
                        'class' => 'bootstrap.widgets.TbMenu',
                        'items' => array(
                            array('label' => Translate::tradPetit('APropos'), 'url' => array('/site/page', 'view' => 'about')),
                            array('label' => Translate::tradPetit('Contact'), 'url' => array('/site/contact')),
                            '---',
                            array('label' => Translate::tradPetit('CreerTicket'), 'url' => array('/locataire/admin'), 'visible' => Yii::app()->session['Utilisateur'] == 'User'),
                            array('label' => Translate::tradPetit('ListeTicket'), 'url' => array('/ticket/admin'), 'visible' => Yii::app()->session['Utilisateur'] == 'User'),
                            array('label' => Translate::tradPetit('Creer') . Yii::app()->session['NouveauTicket'] . ' ticket', 'url' => array('/ticket/create'), 'visible' => Yii::app()->session['Utilisateur'] == 'Locataire'),
                            '---',
                            array('label' => Translate::tradPetit('DashBoard'), 'url' => array(''),
                                'items' => array(array('label' => Translate::tradPetit('Graphique'), 'url' => array('dashboard/vue'))),
                                'visible' => Yii::app()->session['Utilisateur'] == 'User' && ($var['fk_fonction'] == Constantes::ID_ADMIN|| $var['fk_fonction'] == Constantes::ID_ROOT)),
                            array('label' => 'Admin', 'url' => array('/admin'), 'visible' => Yii::app()->session['Utilisateur'] == 'User' && $var['fk_fonction'] == Constantes::ID_ROOT),
                        )),
                    array(
                        'class' => 'bootstrap.widgets.TbMenu',
                        'htmlOptions' => array('class' => 'pull-right'),
                        'items' => array(
                            '---',
                            array('label' => Translate::tradPetit('Connexion'), 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                            array('label' => Translate::tradPetit('DeConnexion') . ' (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest),
                        ),
                    ),
                ),
            ));
            Yii::app()->session['NouveauTicket'] = '';
            ?>
        </div>

        <!-- END HEADER -->


        <!-- CONTAINER -->
        <div class="container" id="page">

            <?php if (isset($this->breadcrumbs)): ?>
                <?php
                $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                ));
                ?><!-- breadcrumbs -->
            <?php endif ?>

            <?php echo $content; ?>

            <div class="clear"></div>

            <br/><br/><br/>
            <div id="footer">
                <hr>

                    <div id="aaaa">
                        <table>
                            <tr>
                                <td width="50%"><a href=<?php echo Yii::app()->request->baseUrl; ?>><img width="40%"
                                                                                                         src="http://web3sys.com/tickets/images/HServices.png"/></a></td>
                                <td width="50%"><a href="http://web3sys.com"><img align="right" width="40%"
                                                                                  src="http://web3sys.com/tickets/images/logoW3S.jpg"/></a>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div id="language" style="text-align: center; margin-top: 5px;">
                        <hr>
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
                            <div id="copyright">
                                Copyright &copy; <?php echo date('Y') . ' ' . Translate::tradPetit('Par'); ?>  <a href="http://web3sys.com">Web3Sys</a>.<br/>
                                <?php echo Translate::tradPetit('DroitsReserve'); ?><br/>
                                <?php echo Yii::powered(); ?>
                            </div>
                    </div>
            </div>
            <!-- footer -->

        </div>
        <!-- page -->

    </body>
</html>
