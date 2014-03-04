<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="row">
    <div class="span9">
        <div id="content">
            <?php echo $content; ?>
        </div><!-- content -->
    </div>
    <div class="span3">
        <div id="sidebar">
            <?php
            $this->beginWidget('zii.widgets.CPortlet', array(
                'title' => Translate::tradPetit('actions'),
            ));
            $this->widget('bootstrap.widgets.TbMenu', array(
                'type' => 'pills',
                'stacked' => true,
                'items' => $this->menu,
                'htmlOptions' => array('class' => 'actions'),
            ));
            $this->endWidget();
            ?>
        </div><!-- sidebar -->
    </div>
</div>
<?php $this->endContent(); ?>
