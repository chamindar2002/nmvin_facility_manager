<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/shop_layout_main'); ?>

<div id="nav_menu">
       
    <div id="nav_menu_itms">
         <?php echo utilsComponents::renderStaticPageLinks(); ?>
    </div>
</div>
<div id="content">
    <div id="content_2"><?php echo $content; ?></div>
</div>

<div class="clear"></div>
<?php $this->endContent(); ?>