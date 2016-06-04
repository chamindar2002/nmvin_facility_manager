<?php
/* @var $this TransferController */

//$this->breadcrumbs=array(
//	'Transfer',
//);

?>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'project-details-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

<div class="form-group">
	<?php echo $form->labelEx($model,'projectcode'); ?>
	<?php
		echo $form->dropDownList($model, 'projectcode', CHtml::listData($projects, 'projectcode', 'projectname'), array('prompt' => '','class'=>'form-control input-sm'));
	?>
</div>

<div class="form-group">
	<?php echo $form->labelEx($model,'swap_from_block'); ?>
	<?php
		echo $form->dropDownList($model, 'swap_from_block', CHtml::listData($blockListdata, 'refno', 'blocknumber'), array('prompt' => '','class'=>'form-control input-sm'));
	?>
</div>


<div class="form-group">
	<?php echo $form->labelEx($model,'swap_to_block'); ?>
	<?php
		echo $form->dropDownList($model, 'swap_to_block', CHtml::listData($blockListdata, 'refno', 'blocknumber'), array('prompt' => '','class'=>'form-control input-sm'));
	?>
</div>




<?php $this->endWidget(); ?>








<script type="text/javascript">
	$('#BlockTransfer_projectcode').change(function(event) {

		var val = $('#BlockTransfer_projectcode').val();
		var url = window.location.href;
		if(val !== ''){
			//alert(val + 'sssm');
			addParam(url,'project_code',val);
		}else{
			//alert('0');
			addParam(url,'project_code','0');

		}


	});
</script>


