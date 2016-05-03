<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/mobile_layout_main'); ?>

<?php if(Yii::app()->controller->id == 'default' && Yii::app()->controller->module->id == 'mall'){ ?>
 <div id="nav_menu_itms">
        <?php
            echo filterMenu::renderFilterMenu_Models();
        ?>
 </div>
 <div id="nav_menu_itms">
        <?php
            echo filterMenu::renderFilterMenu_Scale();
        ?>
 </div>
 <div id="nav_menu_itms">
        <?php
            echo filterMenu::renderFilterMenu_Brand();
        ?>
</div>

<?php } ?>
<div id="content">
	<?php echo $content; ?>
</div><!-- content -->
<?php $this->endContent(); ?>