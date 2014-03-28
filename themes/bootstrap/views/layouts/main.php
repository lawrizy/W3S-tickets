<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="language" content="en"/>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
        </script>
        <!--<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">-->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css"/>

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>

        <?php Yii::app()->bootstrap->register(); ?>
    </head>

    <body>

        <!-- HEADER -->
        <div id="header">

            <?php
            $varCheminAcces = "";
            $personneAuthentifie = Yii::app()->session['Logged'];
            $varCheminAcces = "user/changepassword?id=" . $personneAuthentifie['id_user'];
            $this->widget('bootstrap.widgets.TbNavbar', array(
                'collapse' => TRUE,
                'type' => 'inverse',
                'items' => array(
                    array(
                        'class' => 'bootstrap.widgets.TbMenu',
                        'items' => array(
                            array('label' => Translate::trad('APropos'), 'icon' => 'info-sign white', 'url' => array('/site/page', 'view' => 'about')),
                            array('label' => Translate::trad('Contact'), 'icon' => 'comment white', 'url' => array('/site/contact')),
                            '---',
                            array('label' => Translate::trad('CreerTicket'), 'icon' => 'pencil white', 'url' => array('/locataire/admin'), 'visible' => $personneAuthentifie['fk_fonction'] == Constantes::FONCTION_USER || $personneAuthentifie['fk_fonction'] == Constantes::FONCTION_ADMIN || $personneAuthentifie['fk_fonction'] == Constantes::FONCTION_ROOT),
                            array('label' => Translate::trad('ListeTicket'), 'icon' => 'list white', 'url' => array('/ticket/admin'), 'visible' => $personneAuthentifie['fk_fonction'] == Constantes::FONCTION_USER || $personneAuthentifie['fk_fonction'] == Constantes::FONCTION_ADMIN || $personneAuthentifie['fk_fonction'] == Constantes::FONCTION_ROOT),
                            array('label' => Translate::trad('Creer') . Yii::app()->session['NouveauTicket'] . ' ticket', 'icon' => 'pencil white', 'url' => array('/ticket/create'), 'visible' => $personneAuthentifie['fk_fonction'] == Constantes::FONCTION_LOCATAIRE),
                            '---',
                            array('label' => Translate::trad("GestionCompte"), 'icon' => 'cog white', 'url' => array('#'),
                                'items' => array(
                                    array('label' => Translate::trad("ChangePassword"), 'icon' => 'lock ', 'url' => array($varCheminAcces)),
                                    array('label' => Translate::trad('Graphique'), 'url' => array('dashboard/vue'), 'icon' => 'dashboard white', 'visible' => ($personneAuthentifie['fk_fonction'] == Constantes::FONCTION_ADMIN || $personneAuthentifie['fk_fonction'] == Constantes::FONCTION_ROOT))),
                                'visible' => !Yii::app()->user->isGuest),
                            '---',
                            array('label' => 'Admin', 'icon' => 'briefcase white', 'url' => array('/admin'), 'visible' => $personneAuthentifie['fk_fonction'] == Constantes::FONCTION_ROOT),
                        )),
                    array(
                        'class' => 'bootstrap.widgets.TbMenu',
                        'htmlOptions' => array('class' => 'pull-right'),
                        'items' => array(
                            '---',
                            array('label' => Translate::trad('Connexion'), 'url' => array('/site/login'), 'icon' => 'user white', 'itemOptions' => array('class' => 'flashText', 'color' => 'red'), 'visible' => Yii::app()->user->isGuest,),
                            array('label' => Translate::trad('DeConnexion') . ' (' . Yii::app()->user->name . ')', 'icon' => 'off white', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest),
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
            <!--            <div class="row">
        
                        </div>-->
            <?php
            $this->widget('bootstrap.widgets.TbAlert', array(
                'id' => 'alert_session',
                'block' => true, // display a larger alert block?
                'fade' => true, // use transitions?
                'closeText' => '&times;', // close link text - if set to false, no close link is displayed
            ));
            ?>
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
                                <span class="glyphicon glyphicon-dashboard"></span>
                                Copyright <?php echo Yii::app()->name . ' &copy; v0.2.0'; ?> <?php echo date('Y') . ' ' . Translate::trad('Par'); ?>  <a href="http://web3sys.com">Web3Sys</a>.<br/>
                                <?php echo Translate::trad('DroitsReserve'); ?><br/>
                            </div>
                    </div>
            </div>
            <!-- footer -->
        </div>
        <!-- page -->


    </body>
</html>

<script>
    var currentVal = <?php var_export(Constantes::TIMEOUT_SESSION - 60); ?>;
    var endVal = 0;
    var interval = 1000;
    var thread = setInterval(function() {
        currentVal -= interval / 1000;
        if (currentVal == endVal && <?php var_export(!Yii::app()->user->isGuest); ?>)
        {
            window.location.replace('<?php echo Yii::app()->baseUrl . '/index.php/site/logout?isAjax=' . Constantes::ISAJAX_TRUE; ?>');
            clearInterval(thread);
        }
    }, interval);
</script>  
<?php
Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerScript(null, '$("#alert_session").delay(5000).fadeOut();')
?>
