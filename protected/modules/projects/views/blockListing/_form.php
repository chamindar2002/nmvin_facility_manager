<?php
/* @var $this BlockListingController */
/* @var $model ProjectDetails */
/* @var $form CActiveForm */
?>
<style>
	.status-icon{
		width:10px;
		height:10px;
		color: blue;
		border: 1px solid black;
		border-radius: 10px;

	}

	.block_staus_0{
		background-color: greenyellow;
	}
	.block_staus_1{
		background-color: yellow;
	}
	.block_staus_2{
		background-color: red;
	}
	.block_staus_3{
		background-color: rebeccapurple;
	}


</style>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'project-details-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

<?php
echo $form->dropDownList($model, 'projectcode', CHtml::listData($projects, 'projectcode', 'projectname'), array('prompt' => '','class'=>'form-control input-sm'));
?>

<?php if(!empty($blockListdata)){ ?>

<?php $i = 0; ?>

<table class="table table-hover">
<?php foreach($blockListdata As $bld){ ?>

	<tr>
		<td><?php echo $bld->refno ?></td>
		<td><div class="status-icon block_staus_<?php echo $bld->reservestatus; ?>"></div></td>
		<td><input type="text" name="block_no_<?php echo $i; ?>" id="block_no_<?php echo $i; ?>" value="<?php echo $bld->blocknumber; ?>"></td>
		<td><input type="text" name="block_size_<?php echo $i; ?>" id="block_size_<?php echo $i; ?>" value="<?php echo $bld->blocksize; ?>"></td>
		<td><input type="text" name="block_price_<?php echo $i; ?>" id="block_price_<?php echo $i; ?>" value="<?php echo $bld->blockprice; ?>"></td>
		<td><a href="#" id="<?php echo $bld->refno ?>" customer="<?php echo $bld->customercode; ?>" class="block-itm-more-info">more</a></td>
	</tr>

	<?php $i++ ;?>
<?php } ?>

<?php } ?>
</table>





<?php $this->endWidget(); ?>


<div class="modal fade" id="modal_block_info" tabindex="-1" role="dialog" aria-labelledby="mymodal_block_info_abel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Block/House Availability</h4>
			</div>
			<div class="modal-body">
				<div class="customer_data_placeholder"></div>
				<br />
				<div class="block_data_placeholder">

					<div class="form-group">
						<?php echo $form->labelEx($model,'reservestatus'); ?>
						<?php echo $form->textField($model,'reservestatus',array('size'=>60,'maxlength'=>100,'class'=>'form-control input-sm','readonly'=>'readonly')); ?>
						<?php echo CHtml::hiddenField('hdn_blockrefno'); ?>
						<?php echo $form->error($model,'reservestatus'); ?>
					</div>

					<div class="form-group">
						<?php echo $form->labelEx($model,'blocknumber'); ?>
						<?php echo $form->textField($model,'blocknumber',array('size'=>60,'maxlength'=>100,'class'=>'form-control input-sm','readonly'=>'readonly')); ?>
						<?php echo $form->error($model,'blocknumber'); ?>
					</div>

					<div class="form-group">
						<?php echo $form->labelEx($model,'blocksize'); ?>
						<?php echo $form->textField($model,'blocksize', array('size'=>60,'maxlength'=>100,'class'=>'form-control input-sm','readonly'=>'readonly')); ?>
						<?php echo $form->error($model,'blocksize'); ?>
					</div>
					<div class="form-group">
						<?php echo $form->labelEx($model,'blockprice'); ?>
						<?php echo $form->textField($model,'blockprice', array('size'=>60,'maxlength'=>100,'class'=>'form-control input-sm','readonly'=>'readonly')); ?>
						<?php echo $form->error($model,'blockprice'); ?>
					</div>


				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary", id="btn_block_data_save">Save changes</button>
			</div>
		</div>
	</div>
</div>

<script>

	var arr_status = ['Available', 'Reserved', 'Sold Out', 'Not for Sale'];

	var placeholder_html = '<br><span class="loader" style="margin-left:45%;"><img src="<?php echo yii::app()->baseUrl; ?>/themes/images/loading.gif" alt="Loading...") /></span><br><br>';

	$('#ProjectDetails_projectcode').change(function(event) {

		var val = $('#ProjectDetails_projectcode').val();
		var url = window.location.href;
		if(val !== ''){
			//alert(val + 'sssm');
			addParam(url,'project_code',val);
		}else{
			//alert('0');
			addParam(url,'project_code','0');

		}


	});

	$('.block-itm-more-info').hover(function(event){

		var blockrefno = $(this).attr('id');
		var customer = $(this).attr('customer');

		fetchCustomerDetails(customer, blockrefno);

		$('#modal_block_info').modal();
	});

	function fetchCustomerDetails(customer, blockrefno){

		$.ajax({
			type :'GET',
			dataType:'JSON',

			cache: false,
			url : '<?php echo Yii::app()->baseUrl."/index.php/projects/blockListing/GetCustomer"; ?>',
			data : { customer_id : customer, block_id: blockrefno},

			beforeSend: function() {
				//$('#total_chrgs_box').html(placeholder_html);
				$('.customer_data_placeholder').html(placeholder_html);
			},
			success : function(result){
				//console.log(result);
				//$('.modal-body').html(result);
				appendCustomerData(result);
				appendBlockData(result);

			}
		});

	}

	function appendCustomerData(result){

		var str = "";


		if(result.customer.length != 0) {
			str += "<p><h4>" + result.customer.title + " " + result.customer.firstname + " " + result.customer.familyname + "</h4></p>";
			str += result.customer.addressline1 + " " + result.customer.addressline2 + ".";
		}


		$('.customer_data_placeholder').html(str)
	}

	function appendBlockData(result){
		$('#ProjectDetails_blocknumber').val(result.block.blocknumber);
		$('#ProjectDetails_blocksize').val(result.block.blocksize);
		$('#ProjectDetails_blockprice').val(result.block.blockprice);
		$('#ProjectDetails_reservestatus').val(getReserveStatus(result.block.reservestatus));
		$('#hdn_blockrefno').val(result.block.refno);

		if(getReserveStatus(result.block.reservestatus) == 'Available'){
			$("#ProjectDetails_blocknumber").removeAttr("readonly");
			$('#ProjectDetails_blocksize').removeAttr("readonly");
			$('#ProjectDetails_blockprice').removeAttr("readonly");
			$('#ProjectDetails_reservestatus').removeAttr("readonly")
			$('#btn_block_data_save').prop('disabled', false);

			var prepare_dropdown = '<select id="ProjectDetails_reservestatus" name="ProjectDetails_reservestatus" class="form-control input-sm">'

			$.each( arr_status, function( key, value) {

				if(key == result.block.reservestatus){
					prepare_dropdown += '<option value='+key+' selected>'+ value +'</option>';
				}else{
					prepare_dropdown += '<option value='+key+'>'+ value +'</option>';
				}

			});

			prepare_dropdown += '</select>';

			$("#ProjectDetails_reservestatus").replaceWith(prepare_dropdown);

		}else{
			$("#ProjectDetails_blocknumber").attr("readonly", "readonly");
			$('#ProjectDetails_blocksize').attr("readonly", "readonly");
			$('#ProjectDetails_blockprice').attr("readonly", "readonly");
			$('#ProjectDetails_reservestatus').attr("readonly", "readonly");
			$('#btn_block_data_save').prop('disabled', true);
			$("#ProjectDetails_reservestatus").replaceWith('<input type="text" name="ProjectDetails_reservestatus" id="ProjectDetails_reservestatus" class="form-control input-sm" readonly="readonly" value="'+getReserveStatus(result.block.reservestatus)+'">')





		}
	}




	function getReserveStatus(stats){


		return arr_status[stats];
	}

	$('#btn_block_data_save').click(function(event){
		var res = confirm("Save Modifications ?");
		if (res == true) {

			var blocknumber = $('#ProjectDetails_blocknumber').val();
			var blocksize = $('#ProjectDetails_blocksize').val();
			var blockprice = $('#ProjectDetails_blockprice').val();
			var reservestatus = $('#ProjectDetails_reservestatus').val();
			var blockrefno = $('#hdn_blockrefno').val();

			$.ajax({
				type :'POST',
				dataType:'JSON',

				cache: false,
				url : '<?php echo Yii::app()->baseUrl."/index.php/projects/blockListing/saveUpdates"; ?>',
				data : {
					blocknumber : blocknumber,
					blocksize: blocksize,
					blockprice: blockprice,
					reservestatus: reservestatus,
					blockrefno: blockrefno
				},

				beforeSend: function() {
					//$('#total_chrgs_box').html(placeholder_html);
					$('.customer_data_placeholder').html(placeholder_html);
				},
				success : function(result){
					//console.log(result);
					//$('.modal-body').html(result);
					appendCustomerData(result);
					appendBlockData(result);

				}
			});

		} else {
			return;
		}

	});
</script>
























<!---->
<!---->
<!---->
<!--<div class="form">-->
<!---->
<?php //$form=$this->beginWidget('CActiveForm', array(
//	'id'=>'project-details-form',
//	// Please note: When you enable ajax validation, make sure the corresponding
//	// controller action is handling ajax validation correctly.
//	// There is a call to performAjaxValidation() commented in generated controller code.
//	// See class documentation of CActiveForm for details on this.
//	'enableAjaxValidation'=>false,
//)); ?>
<!---->
<!--	<p class="note">Fields with <span class="required">*</span> are required.</p>-->
<!---->
<!--	--><?php //echo $form->errorSummary($model); ?>
<!---->
<!--	<div class="row">-->
<!--		--><?php //echo $form->labelEx($model,'locationcode'); ?>
<!--		--><?php //echo $form->textField($model,'locationcode'); ?>
<!--		--><?php //echo $form->error($model,'locationcode'); ?>
<!--	</div>-->
<!---->
<!--	<div class="row">-->
<!--		--><?php //echo $form->labelEx($model,'projectcode'); ?>
<!--		--><?php //echo $form->textField($model,'projectcode'); ?>
<!--		--><?php //echo $form->error($model,'projectcode'); ?>
<!--	</div>-->
<!---->
<!--	<div class="row">-->
<!--		--><?php //echo $form->labelEx($model,'customercode'); ?>
<!--		--><?php //echo $form->textField($model,'customercode'); ?>
<!--		--><?php //echo $form->error($model,'customercode'); ?>
<!--	</div>-->
<!---->
<!--	<div class="row">-->
<!--		--><?php //echo $form->labelEx($model,'housecatcode'); ?>
<!--		--><?php //echo $form->textField($model,'housecatcode'); ?>
<!--		--><?php //echo $form->error($model,'housecatcode'); ?>
<!--	</div>-->
<!---->
<!--	<div class="row">-->
<!--		--><?php //echo $form->labelEx($model,'blocknumber'); ?>
<!--		--><?php //echo $form->textField($model,'blocknumber',array('size'=>60,'maxlength'=>100)); ?>
<!--		--><?php //echo $form->error($model,'blocknumber'); ?>
<!--	</div>-->
<!---->
<!--	<div class="row">-->
<!--		--><?php //echo $form->labelEx($model,'blocksize'); ?>
<!--		--><?php //echo $form->textField($model,'blocksize'); ?>
<!--		--><?php //echo $form->error($model,'blocksize'); ?>
<!--	</div>-->
<!---->
<!--	<div class="row">-->
<!--		--><?php //echo $form->labelEx($model,'blockprice'); ?>
<!--		--><?php //echo $form->textField($model,'blockprice'); ?>
<!--		--><?php //echo $form->error($model,'blockprice'); ?>
<!--	</div>-->
<!---->
<!---->
<!--	<div class="row">-->
<!--		--><?php //echo $form->labelEx($model,'reservestatus'); ?>
<!--		--><?php //echo $form->textField($model,'reservestatus'); ?>
<!--		--><?php //echo $form->error($model,'reservestatus'); ?>
<!--	</div>-->
<!---->
<!---->
<!---->
<!--	<div class="row buttons">-->
<!---->
<!--                --><?php //echo CHtml::submitButton($model->isNewRecord ? 'Add' : 'Save'); ?>
<!--	</div>-->
<!---->
<?php //$this->endWidget(); ?>
<!---->
<!--</div><!-- form -->