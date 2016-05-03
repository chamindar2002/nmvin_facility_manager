<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/shop_layout_main'); ?>

<div id="nav_menu">
    <div id="nav_menu_itms">
<!--        <ul>
            <li>Item 1</li>
            <li>Item 2</li>
            <li>Item Item Item Item My Item</li>
        </ul>-->
        <?php
            echo filterMenu::renderFilterMenu_Models();
            echo filterMenu::renderFilterMenu_Scale();
            echo filterMenu::renderFilterMenu_Brand();
        ?>
    </div>
    
    <div id="nav_menu_itms">
       <?php echo utilsComponents::renderStaticPageLinks(); ?>
    </div>
</div>
<div id="content">
    <div id="content_2"><?php echo $content; ?></div>
</div>

<div class="clear"></div>
<?php $this->endContent(); ?>