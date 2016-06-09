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

<div class="panel panel-success">
	<div class="panel-heading">Tranfer From</div>
	<div class="panel-body" id="customer_from_placeholder"></div>
</div>

<div class="panel panel-success">
	<div class="panel-heading">Tranfer To</div>
	<div class="panel-body" id="customer_to_placeholder"></div>
</div>


<table>
	<tr>
		<th>block id</th>
		<th>status</th>
		<th>customer id</th>
		<th>sales ref</th>
		<th>block price</th>
	</tr>
	<tr>
		<td><?php echo CHtml::textField('tranfer-from-block-id','0',array('id'=>'tranfer-from-block-id')) ?></td>
		<td><?php echo CHtml::textField('tranfer-from-block-status','0',array('id'=>'tranfer-from-block-status')) ?></td>
		<td><?php echo CHtml::textField('tranfer-from-block-customer-id','0',array('id'=>'tranfer-from-block-customer-id')) ?></td>
		<td><?php echo CHtml::textField('tranfer-from-block-sales-ref','0',array('id'=>'tranfer-from-block-sales-ref')) ?></td>
		<td><?php echo CHtml::textField('tranfer-from-block-price','0',array('id'=>'tranfer-from-block-price')) ?></td>
	</tr>

	<tr>
		<td><?php echo CHtml::textField('tranfer-to-block-id','0',array('id'=>'tranfer-to-block-id')) ?></td>
		<td><?php echo CHtml::textField('tranfer-to-block-status','0',array('id'=>'tranfer-to-block-status')) ?></td>
		<td><?php echo CHtml::textField('tranfer-to-block-customer-id','0',array('id'=>'tranfer-to-block-customer-id')) ?></td>
		<td><?php echo CHtml::textField('tranfer-to-block-sales-ref','0',array('id'=>'tranfer-to-block-sales-ref')) ?></td>
		<td><?php echo CHtml::textField('tranfer-to-block-price','0',array('id'=>'tranfer-to-block-price')) ?></td>
	</tr>
</table>





<?php $this->endWidget(); ?>








<script type="text/javascript">

	$('#BlockTransfer_swap_to_block').change(function(event){

		var id = $(this).val();

		$.ajax({
			type :'GET',
			dataType:'JSON',

			cache: false,
			url : '<?php echo Yii::app()->baseUrl."/index.php/sales/transfer/getBlockData"; ?>',
			data : {

				blockref_id :id,
			},

			beforeSend: function() {
				//$('#total_chrgs_box').html(placeholder_html);
				//$('.customer_data_placeholder').html(placeholder_html);
			},
			success : function(result){

				if(result.status == 'success'){

					$('#tranfer-to-block-id').val(result.data.block_data.refno);
					$('#tranfer-to-block-status').val(result.data.block_data.reservestatus);
					$('#tranfer-to-block-customer-id').val(result.data.block_data.customercode);
					$('#tranfer-to-block-price').val(result.data.block_data.blockprice);


					if(result.data.sales_data != null) {
						$('#tranfer-to-block-sales-ref').val(result.data.sales_data.refno);

					}else{
						$('#tranfer-to-block-sales-ref').val(0);
						//$('#customer_to_placeholder').html('');
					}

					appendCustomerData('customer_to_placeholder',result);

				}else{
					resetFields();
				}

			}
		});
	})

	function appendCustomerData(placeholder,data_obj){
		var htm = '';
		if(data_obj.data.customer_data != null){
			htm += '<strong>';
			htm += data_obj.data.customer_data.title + '&nbsp;' + data_obj.data.customer_data.firstname +'&nbsp;'+data_obj.data.customer_data.familyname + '</strong><br />';
			htm += data_obj.data.customer_data.addressline1 + '&nbsp;' + data_obj.data.customer_data.addressline2 + '<br />';
			htm += data_obj.data.customer_data.country + '<br /><br />';
		}

		htm += 'Block Status <div id="status_icon_'+data_obj.data.block_data.reservestatus+'"' + 'class="status-icon block_staus_'+data_obj.data.block_data.reservestatus+'"' +'></div>';
		htm += 'Block Price ['+data_obj.data.block_data.blockprice+']';

		$('#'+placeholder).html(htm);
	}

	function resetFields(){
		$('#tranfer-to-block-id').val(0);
		$('#tranfer-to-block-status').val(0);
		$('#tranfer-to-block-customer-id').val(0);
		$('#tranfer-to-block-sales-ref').val(0);
		$('#tranfer-to-block-price').val(0);

		$('#tranfer-from-block-id').val(0);
		$('#tranfer-from-block-status').val(0);
		$('#tranfer-from-block-customer-id').val(0);
		$('#tranfer-from-block-sales-ref').val(0);
		$('#tranfer-from-block-price').val(0);
	}


	$('#BlockTransfer_swap_from_block').change(function(event){

		var id = $(this).val();

		$.ajax({
			type :'GET',
			dataType:'JSON',

			cache: false,
			url : '<?php echo Yii::app()->baseUrl."/index.php/sales/transfer/getBlockData"; ?>',
			data : {

				blockref_id :id,
			},

			beforeSend: function() {
				//$('#total_chrgs_box').html(placeholder_html);
				//$('.customer_data_placeholder').html(placeholder_html);
			},
			success : function(result){

				if(result.status == 'success'){

					$('#tranfer-from-block-id').val(result.data.block_data.refno);
					$('#tranfer-from-block-status').val(result.data.block_data.reservestatus);
					$('#tranfer-from-block-customer-id').val(result.data.block_data.customercode);
					$('#tranfer-from-block-price').val(result.data.block_data.blockprice);

					if(result.data.sales_data != null) {
						$('#tranfer-from-block-sales-ref').val(result.data.sales_data.refno);

					}else{
						$('#tranfer-from-block-sales-ref').val(0);
						//$('#customer_from_placeholder').html('');
					}

					appendCustomerData('customer_from_placeholder',result);


				}else{
					resetFields();

				}

			}
		});
	})

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


