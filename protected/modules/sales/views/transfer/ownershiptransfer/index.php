<?php
/* @var $this TransferController */

$this->breadcrumbs=array(
	'Transfer',
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
<p><div class="customer_data_placeholder"></div></p>


<div class="form-group">
	<?php echo $form->labelEx($model,'projectcode'); ?>
	<?php
	echo $form->dropDownList($model, 'projectcode', CHtml::listData($projects, 'projectcode', 'projectname'), array('prompt' => '','class'=>'form-control input-sm'));
	?>
</div>

<div class="form-group">
	<?php echo $form->labelEx($model,'block_to_be_tranfered'); ?>
	<?php
	echo $form->dropDownList($model, 'block_to_be_tranfered', CHtml::listData($blockListdata, 'refno', 'blocknumber'), array('prompt' => '','class'=>'form-control input-sm'));
	?>
</div>
<div class="form-group" id="customer_data_to_be"></div>
<div class="form-group" id="transfer_history"></div>

<div class="form-group">
	<?php $this->renderPartial('application.views.common._msearch'); ?>
</div>


<button type="button" id="btn_validate_tranfer" class="btn btn-primary">Save</button>

<?php $this->endWidget(); ?>

<script type="text/javascript">

	var placeholder_html = '<br><span class="loader" style="margin-left:45%;"><img src="<?php echo yii::app()->baseUrl; ?>/themes/images/loading.gif" alt="Loading...") /></span><br><br>';
	var blockref_blockswapfrom = 0;
	var blockstat_blockswapfrom = 0;
	var ccode_blockswapfrom = 0;
	var saleref_blockswapfrom = 0;
	var blockprice_blockswapfrom = 0;

	$('#btn_validate_tranfer').click(function(){

		var customer_id = $('#customer_id').val();

		if(customer_id == ''){
			$('.customer_data_placeholder').html('<span class="errorMessage">Please select a new owner.</span>');
			return false;
		}

		if(blockstat_blockswapfrom != 2){
			$('.customer_data_placeholder').html('<span class="errorMessage">Cannot tranfer an unsold block/house.</span>');
			return false;
		}

		if(customer_id == ccode_blockswapfrom){
			$('.customer_data_placeholder').html('<span class="errorMessage">Cannot transfer house to same owner.</span>');
			return false;
		}

		var s = confirm("Arge you sure you want to transfer the ownership of this block?");
		if (s == true) {

			$.ajax({
				type :'POST',
				dataType:'JSON',

				cache: false,
				url : '<?php echo Yii::app()->baseUrl."/index.php/sales/transfer/NewOwnershipTransfer"; ?>',

				data : {
					saleref: saleref_blockswapfrom,
					blockref: blockref_blockswapfrom,
					old_customer:ccode_blockswapfrom,
					new_customer:customer_id,
				},

				beforeSend: function() {
					$('.customer_data_placeholder').html(placeholder_html);

				},
				success : function(result){

					console.log(result);

					if(result.status == 'success'){

						$('.customer_data_placeholder').html(result.message);

					}else{


					}

				}
			});


		}

	});

	$('#HouseOwnershipTranfers_block_to_be_tranfered').change(function(event){


		var blockref_id = $(this).val();

		$.ajax({
			type :'GET',
			dataType:'JSON',

			cache: false,
			url : '<?php echo Yii::app()->baseUrl."/index.php/sales/transfer/GetBlockData"; ?>',

			data : {blockref_id: blockref_id},

			beforeSend: function() {
				$('#customer_data_to_be').html(placeholder_html);

			},
			success : function(result){

				console.log(result);

				if(result.status == 'success'){

					appendCustomerData('customer_data_to_be',result);
					blockref_blockswapfrom = result.data.block_data.refno;
					blockstat_blockswapfrom = result.data.block_data.reservestatus;
					ccode_blockswapfrom = result.data.sales_data.customercode;
					saleref_blockswapfrom = result.data.sales_data.refno;
					blockprice_blockswapfrom = result.data.block_data.blockprice;

					appendTranferHistory(result);

				}else{

					blockref_blockswapfrom = 0;
					blockstat_blockswapfrom = 0;
					ccode_blockswapfrom = 0;
					saleref_blockswapfrom = 0;
					blockprice_blockswapfrom = 0;

				}

			}
		});


	});

	function appendTranferHistory(result){

		var msg = '<strong>Owner History</strong>';

		if(result.data.transfer_history != null){
			var i =1;
			msg += '<p><table class="table">';
			$.each(result.data.transfer_history, function( key, value) {

				//console.log('error fldfs :' + value);
				msg += '<tr> <td>Owner['+ i +'] </td><td>' + value.customer.title + value.customer.firstname + value.customer.firstname + '</td></tr>';

				i++;
			});

			msg += '</table></p>';

		}else{
			msg = '<li class="errorMessage">No owner history to be displayed.</li>';
		}




		console.log(result.data.transfer_history);
		$('#transfer_history').html(msg);
	}



	$('#HouseOwnershipTranfers_projectcode').change(function(event){

		var val = $('#HouseOwnershipTranfers_projectcode').val();
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