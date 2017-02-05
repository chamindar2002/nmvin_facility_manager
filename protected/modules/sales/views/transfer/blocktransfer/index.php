<?php
/* @var $this TransferController */

$this->breadcrumbs=array(
	//'Project Details'=>array('index'),
	//'Transfer',
	'Block Swap'
);

?>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'project-details-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

<div class='row'>
    <div class='col-sm-6'>
        <div class="form-group">
            <?php echo $form->labelEx($model,'projectcode'); ?>
            <?php
            echo $form->dropDownList($model, 'projectcode', $projects, array('prompt' => '','class'=>'form-control input-sm'));
            ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'swap_from_block'); ?>
            <?php
            echo $form->dropDownList($model, 'swap_from_block', CHtml::listData($blockListdata, 'refno', 'blocknumber'), array('prompt' => '','class'=>'form-control input-sm'));
            ?>
        </div>
    </div>

    <div class='col-sm-6'>
        <div class="form-group">
            <?php echo $form->labelEx($model,'swap_to_project'); ?>
            <?php
            echo $form->dropDownList($model, 'swap_to_project', $projects, array('prompt' => '','class'=>'form-control input-sm'));
            ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'swap_to_block'); ?>
            <?php
            echo $form->dropDownList($model, 'swap_to_block', CHtml::listData($blockToListdata, 'refno', 'blocknumber'), array('prompt' => '','class'=>'form-control input-sm'));
            ?>
        </div>
    </div>
</div>



<div class="panel panel-success">
	<div class="panel-heading">Swap From</div>
	<div class="panel-body" id="customer_from_placeholder"></div>
</div>

<div class="panel panel-success">
	<div class="panel-heading">Swap To</div>
	<div class="panel-body" id="customer_to_placeholder"></div>
</div>



<button type="button" id="btn_validate_tranfer" class="btn btn-primary">Save</button>


<table style="display: none">
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



<div class="modal fade" id="modal_block_tranfer_confirm" tabindex="-1" role="dialog" aria-labelledby="mymodal_block_info_abel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Block/House Swap</h4>
			</div>
			<div class="modal-body">
				<div class="customer_data_placeholder"></div>
				<br />
				<div class="block_data_placeholder">




				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="btn_save_block_swap_data">Confirm</button>
			</div>
		</div>
	</div>
</div>


<!--<li class="errorMessage">sssss</li>-->

<script type="text/javascript">

	var placeholder_html = '<br><span class="loader" style="margin-left:45%;"><img src="<?php echo yii::app()->baseUrl; ?>/themes/images/loading.gif" alt="Loading...") /></span><br><br>';

	$('#btn_save_block_swap_data').click(function(){

		var tranfer_to_block_id = $('#tranfer-to-block-id').val();
		var tranfer_to_block_status = $('#tranfer-to-block-status').val();
		var tranfer_to_block_customer_id = $('#tranfer-to-block-customer-id').val();
		var tranfer_to_block_sales_ref = $('#tranfer-to-block-sales-ref').val();
		var tranfer_to_block_price = $('#tranfer-to-block-price').val();

		var tranfer_from_block_id = $('#tranfer-from-block-id').val();
		var tranfer_from_block_status = $('#tranfer-from-block-status').val();
		var tranfer_from_block_customer_id = $('#tranfer-from-block-customer-id').val();
		var tranfer_from_block_sales_ref = $('#tranfer-from-block-sales-ref').val();
		var tranfer_from_block_price = $('#tranfer-from-block-price').val();

		var msg = ''

		var transfer_data = {
			tranfer_from_block_id:tranfer_from_block_id,
			tranfer_from_block_status:tranfer_from_block_status,
			tranfer_from_block_customer_id:tranfer_from_block_customer_id,
			tranfer_from_block_sales_ref:tranfer_from_block_sales_ref,
			tranfer_from_block_price:tranfer_from_block_price,

			tranfer_to_block_id:tranfer_to_block_id,
			tranfer_to_block_status:tranfer_to_block_status,
			tranfer_to_block_customer_id:tranfer_to_block_customer_id,
			tranfer_to_block_sales_ref:tranfer_to_block_sales_ref,
			tranfer_to_block_price:tranfer_to_block_price


		}

		//alert(tranfer_from_block_status);

		//apply rules

		if(tranfer_to_block_id == 0 || tranfer_from_block_id == 0){

			$('.customer_data_placeholder').html('<span class="errorMessage">Please select blocks/houses to swap</span>');
			console.log('rule one:'+tranfer_to_block_id + ' - ' + tranfer_from_block_id);
			return false;
		}

		if(tranfer_from_block_status != 2){

			$('.customer_data_placeholder').html('<span class="errorMessage">Cannot swap an unsold block/house</span>');
			console.log('rule two:'+tranfer_from_block_status);
			return false;
		}

		if(tranfer_to_block_id == tranfer_from_block_id){

			$('.customer_data_placeholder').html('<span class="errorMessage">Cannot swap same block/house</span>');
			console.log('rule three:'+tranfer_to_block_id+' - '+tranfer_from_block_id);
			return false;
		}

		if(tranfer_from_block_customer_id == 0 || tranfer_from_block_sales_ref == 0){

			$('.customer_data_placeholder').html('<span class="errorMessage">Block/House to swap from should be a sold</span>');
			console.log('rule four:'+tranfer_from_block_customer_id+' - '+tranfer_from_block_sales_ref);
			return false;
		}

		if(tranfer_from_block_customer_id == tranfer_to_block_customer_id){

			$('.customer_data_placeholder').html('<span class="errorMessage">Cannot swap between same owners</span>');
			console.log('rule five:'+tranfer_from_block_customer_id+' - '+tranfer_to_block_customer_id);
			return false;
		}

		if(tranfer_from_block_price != tranfer_to_block_price){

			$('.customer_data_placeholder').html('<span class="errorMessage">Cannot swap block/house with different price/value</span>');
			console.log('rule six:'+tranfer_from_block_price+' - '+tranfer_to_block_price);
			return false;
		}


		$('.customer_data_placeholder').html('<strong>Confirmation Required</strong>');

		//console.log('clear');
		//console.log(transfer_data);
		var res = confirm("Are you sure you want to swap ?")
			;
		if (res == true) {

			$.ajax({
				type :'POST',
				dataType:'JSON',

				cache: false,
				url : '<?php echo Yii::app()->baseUrl."/index.php/sales/transfer/createNewSwap"; ?>',
				data : {transfer_data: JSON.stringify(transfer_data)},

				beforeSend: function() {
					//$('#total_chrgs_box').html(placeholder_html);
					$('.customer_data_placeholder').html(placeholder_html);
				},
				success : function(result){

					console.log(result);

					if(result.status == 'success'){

						$('.customer_data_placeholder').html(appendSuccess(result.message));

						resetFields();
						$('#BlockSwap_swap_from_block').val('');
						$('#BlockSwap_swap_to_block').val('');


					}else{
						$('.customer_data_placeholder').html(appendErrors(result.data));
					}

				}
			});

		}





	});

	$('#btn_validate_tranfer').click(function(){
		$('#modal_block_tranfer_confirm').modal();
		$('.customer_data_placeholder').html('');


		var htm_from = $('#customer_from_placeholder').html();

		var htm = '<table width="100%"><tr><td>';
		htm += $('#customer_from_placeholder').html();
		htm += '</td>';
		htm += '<td><i class="fa fa-chevron-right fa-3x" aria-hidden="true"></i></td>';
		htm += '<td>'+$('#customer_to_placeholder').html()+'</td>';
		htm += '</table>';
//		htm.prepend('<table><tr><td>');
//		htm.append()
//		htm.append('</td></tr>');
//		htm.append('</table>');
//		htm.append('<p><i class="fa fa-chevron-down fa-3x" aria-hidden="true"></i></p>');


		$('.customer_data_placeholder').html(htm);
	});

	$('#BlockSwap_swap_to_block').change(function(event){

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


	$('#BlockSwap_swap_from_block').change(function(event){

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

	$('#BlockSwap_projectcode').change(function(event) {

		var val = $('#BlockSwap_projectcode').val();
		var url = window.location.href;
		if(val !== ''){
			//alert(val + 'sssm');
			addParam(url,'project_code',val);
		}else{
			//alert('0');
			addParam(url,'project_code','0');

		}


	});

    $('#BlockSwap_swap_to_project').change(function(event) {

        var val = $('#BlockSwap_swap_to_project').val();
        var url = window.location.href;
        if(val !== ''){
            //alert(val + 'sssm');
            addParam(url,'project_to_code',val);
        }else{
            //alert('0');
            addParam(url,'project_to_code','0');

        }


    });


</script>


