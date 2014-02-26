<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<div id="language" style="text-align: right;margin-right: 50px; margin-top: 10px;">
    <?php
    switch (Yii::app()->session['_lang'])
    {
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

<?php $this->beginWidget('bootstrap.widgets.TbHeroUnit',array(
    'heading' => Yii::t('site/index', 'TitrePrincipal'),
)); ?>

<!--<p>Congratulations! You have successfully created your Yii application.</p> -->
<?php $this->endWidget(); ?>

<!--
<p>You may change the content of this page by modifying the following two files:</p>

<ul>
    <li>View file: <code><?php echo __FILE__; ?></code></li>
    <li>Layout file: <code><?php echo $this->getLayoutFile('main'); ?></code></li>
</ul>

<p>For more details on how to further develop this application, please read
    the <a href="http://www.yiiframework.com/doc/">documentation</a>.
    Feel free to ask in the <a href="http://www.yiiframework.com/forum/">forum</a>,
    should you have any questions.</p>
-->
