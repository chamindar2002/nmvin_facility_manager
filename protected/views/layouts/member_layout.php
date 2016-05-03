<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/shop_layout_main'); ?>
<div class="member_side_bar">
    <?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			//'title'=>'Operations',
                        'title'=>'',
		));
		$this->widget('zii.widgets.CMenu', array(
			'items'=>$this->menu,
			'htmlOptions'=>array('class'=>'operations'),
		));
		$this->endWidget();
	?>
</div>

<div class="member_content">
    <?php echo $content; ?>
</div>


<div class="clear"></div>

<?php $this->endContent(); ?>