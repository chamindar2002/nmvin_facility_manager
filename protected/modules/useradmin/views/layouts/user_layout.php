<?php /* @var $this Controller */ ?>
<?php //$this->beginContent('/layouts/main'); ?>
<?php $this->beginContent('//layouts/admin_layout_main'); ?>
<div class="span-19">
        <?php
        $flashMessages = Yii::app()->user->getFlashes();
        if ($flashMessages) {
            echo '<ul class="flashes">';
            foreach($flashMessages as $key => $message) {
                echo '<li><div class="flash-' . $key . '">' . $message . "</div></li>\n";
            }
            echo '</ul>';
        }
        ?>
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<div class="span-5 last">
	<div id="sidebar">
         <?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Operations',
		));
		$this->widget('zii.widgets.CMenu', array(
			'items'=>$this->menu,
			'htmlOptions'=>array('class'=>'operations'),
		));
		$this->endWidget();
	?>
	</div><!-- sidebar -->
</div>
<?php $this->endContent(); ?>