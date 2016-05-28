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
		background-color: #00b300;
	}
	.block_staus_1{
		background-color: #ffff00;
	}
	.block_staus_2{
		background-color: #ff3300;
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

<div class="form-group">
<?php
echo CHtml::label('Project', 'Project');
echo $form->dropDownList($model, 'projectcode', CHtml::listData($projects, 'projectcode', 'projectname'), array('prompt' => '','class'=>'form-control input-sm'));
?>
</div>

<?php if(!empty($blockListdata)){ ?>

<?php $i = 0; ?>

<table class="table table-hover">
<?php foreach($blockListdata As $bld){ ?>

	<tr id="tr_row_id_<?php echo $i; ?>">
		<td><?php echo $bld->refno ?></td>
		<td><div id="status_icon_<?php echo $i; ?>" class="status-icon block_staus_<?php echo $bld->reservestatus; ?>"></div></td>
		<td><input type="text" name="block_no_<?php echo $i; ?>" id="block_no_<?php echo $i; ?>" value="<?php echo $bld->blocknumber; ?>"></td>
		<td><input type="text" name="block_size_<?php echo $i; ?>" id="block_size_<?php echo $i; ?>" value="<?php echo $bld->blocksize; ?>"></td>
		<td><input type="text" name="block_price_<?php echo $i; ?>" id="block_price_<?php echo $i; ?>" value="<?php echo $bld->blockprice; ?>"></td>
		<td>
			<a href="#" id="<?php echo $bld->refno ?>" customer="<?php echo $bld->customercode; ?>" row_id="<?php echo $i; ?>" class="block-itm-more-info"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
			<input type="hidden" name="block_refno_<?php echo $i; ?>" id="block_refno_<?php echo $i; ?>" value="<?php echo $bld->refno; ?>">
		</td>
	</tr>

	<?php $i++ ;?>
<?php } ?>

<?php } ?>
</table>
<div class="form-group">
	<input type="hidden" name="num_rows" value="<?php echo isset($i) ? $i : 0; ?>" >
</div>

<?php if(!empty($blockListdata)){ ?>
	<button type="submit" class="btn btn-primary">Save All</button>
	<a href="#"  data-toggle="modal" data-target="additonal_blocks_input" id="btn_add_more_blocks" style="float:right"><i title="Add more blocks" class="fa fa-plus-square" aria-hidden="true"></i></a>
<?php }else if(isset($projectMaster->nofblocks)){ ?>

	<button type="button" class="btn btn-warning" location_id="<?php echo $projectMaster->locationcode; ?>"  project_id="<?php echo $projectMaster->projectcode; ?>" blocks="<?php echo $projectMaster->nofblocks; ?>" id="btn_block_generator">Generate <?php echo isset($projectMaster->nofblocks) ? $projectMaster->nofblocks : 0; ?> Block Records</button>

<?php } ?>


<?php $this->endWidget(); ?>







<div class="modal fade" id="additonal_blocks_input" tabindex="-1" role="dialog" aria-labelledby="mymodal_block_info_abel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add More Blocks/Units</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<?php echo CHtml::label('Additional Blocks/Units','')?>
					<?php echo CHtml::numberField('no_of_blocks','no_of_blocks',array('size'=>60,'maxlength'=>100,'class'=>'form-control input-sm')); ?>

				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" location_id="<?php echo $projectMaster->locationcode; ?>"  project_id="<?php echo $projectMaster->projectcode; ?>" blocks="<?php //echo $projectMaster->nofblocks; ?>" id="btn_additional_blocks_save">Add</button>
			</div>
		</div>
	</div>
</div>









<div class="modal fade" id="modal_block_info" tabindex="-1" role="dialog" aria-labelledby="mymodal_block_info_abel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Block/House/Unit Availability</h4>
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

					<a href="#" id="btn_delete" style="display: none"><i class="fa fa-trash-o" aria-hidden="true"></i></a>


				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="btn_block_data_save">Save changes</button>
			</div>
		</div>
	</div>
</div>

<script>

	var arr_status = ['Available', 'Reserved', 'Sold Out', 'Not for Sale'];

	//var itemtoRemove = "Sold Out";
	//arr_status.splice($.inArray(itemtoRemove, arr_status),1); //remove 'sold out' option since sold out should only be done via sale

	var row_id = null;

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

	$('.block-itm-more-info').click(function(event){

		event.preventDefault();

		var blockrefno = $(this).attr('id');
		var customer = $(this).attr('customer');
		row_id = $(this).attr('row_id');


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


		setTextFieldAttributes(result.block);

	}

	function setTextFieldAttributes(data){



		if(getReserveStatus(data.reservestatus) == 'Available'){

			$("#ProjectDetails_blocknumber").removeAttr("readonly");
			$('#ProjectDetails_blocksize').removeAttr("readonly");
			$('#ProjectDetails_blockprice').removeAttr("readonly");
			$('#ProjectDetails_reservestatus').removeAttr("readonly")
			$('#btn_block_data_save').prop('disabled', false);

			var prepare_dropdown = '<select id="ProjectDetails_reservestatus" name="ProjectDetails_reservestatus" class="form-control input-sm">'


			$.each( arr_status, function( key, value) {

				if(key == data.reservestatus){
					prepare_dropdown += '<option value='+key+' selected>'+ value +'</option>';
				}else{
					prepare_dropdown += '<option value='+key+'>'+ value +'</option>';
				}

			});

			prepare_dropdown += '</select>';



			$("#ProjectDetails_reservestatus").replaceWith(prepare_dropdown);
			$("#btn_delete").css('display','block');


		}else{


			$("#ProjectDetails_blocknumber").attr("readonly", "readonly");
			$('#ProjectDetails_blocksize').attr("readonly", "readonly");
			$('#ProjectDetails_blockprice').attr("readonly", "readonly");
			$('#ProjectDetails_reservestatus').attr("readonly", "readonly");
			$('#btn_block_data_save').prop('disabled', true);
			$("#ProjectDetails_reservestatus").replaceWith('<input type="text" name="ProjectDetails_reservestatus" id="ProjectDetails_reservestatus" class="form-control input-sm" readonly="readonly" value="'+getReserveStatus(data.reservestatus)+'">')
			$("#btn_delete").css('display','none');

			if(getReserveStatus(data.reservestatus) != 'Sold Out') {
				$('#btn_block_data_save').prop('disabled', false);

				var prepare_dropdown = '<select id="ProjectDetails_reservestatus" name="ProjectDetails_reservestatus" class="form-control input-sm">'


				$.each( arr_status, function( key, value) {

					if(key == data.reservestatus){
						prepare_dropdown += '<option value='+key+' selected>'+ value +'</option>';
					}else{
						prepare_dropdown += '<option value='+key+'>'+ value +'</option>';
					}

				});

				prepare_dropdown += '</select>';



				$("#ProjectDetails_reservestatus").replaceWith(prepare_dropdown);


				modifyRowData(data);

			}

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
					if(result.status == 'error'){

						$('.customer_data_placeholder').html(appendErrors(result.data));
					}else{

						$('.customer_data_placeholder').html(appendSuccess(result.message));
						modifyRowData(result.data);
						setTextFieldAttributes(result.data);

					}

				}
			});

		} else {
			return;
		}

	});


	function appendErrors(_err){

		var msg = '<ul>';
		$.each( _err, function( key, value) {

			//console.log('error fldfs :' + value);
			msg += '<li class="errorMessage">' + value + '</li>';

		});

		msg += '</ul>';

		return msg;

	}

	function appendSuccess(msg){

		var msg = '<div class="flash-success">'+ msg + '</div>';

		return msg;
	}

	function modifyRowData(data){

		$("#status_icon_"+row_id).removeAttr('class');

		$("#block_no_"+row_id).val(data.blocknumber);
		$("#block_size_"+row_id).val(data.blocksize);
		$("#block_price_"+row_id).val(data.blockprice);
		$("#status_icon_"+row_id).addClass( "status-icon block_staus_"+data.reservestatus );

		//alert(data);

	}

	$("#btn_delete").click(function(event){

		event.preventDefault();

		var blockrefno = $('#hdn_blockrefno').val();

		var res = confirm("Are you sure you want to delete ?");

		if (res == true) {

			$.ajax({
				type :'POST',
				dataType:'JSON',

				cache: false,
				url : '<?php echo Yii::app()->baseUrl."/index.php/projects/blockListing/DeleteBlock"; ?>',
				data : {

					blockrefno: blockrefno
				},

				beforeSend: function() {
					//$('#total_chrgs_box').html(placeholder_html);
					$('.customer_data_placeholder').html(placeholder_html);
				},
				success : function(result){

					if(result.status == 'error'){

						$('.customer_data_placeholder').html(appendErrors(result.data));
					}else{

						$('.customer_data_placeholder').html(appendSuccess(result.message));
						$("#btn_delete").css('display','none');
						$('#btn_block_data_save').prop('disabled', true);

					}

					$('#tr_row_id_2').remove();
					//$('#modal_block_info').toggle();

				}
			});


		}

		return;
	});

	$('#btn_block_generator').click(function(event){

		var res = confirm("Are you sure you want to generate block records ?");
		var nofblocks = $(this).attr('blocks');
		var project_id = $(this).attr('project_id');
		var location_id = $(this).attr('location_id');

		if (res == true) {

			$.ajax({
				type :'POST',
				dataType:'JSON',

				cache: false,
				url : '<?php echo Yii::app()->baseUrl."/index.php/projects/blockListing/GenerateBlocks"; ?>',
				data : {

					nofblocks: nofblocks, project_id: project_id, location_id: location_id
				},

				beforeSend: function() {
					//$('#total_chrgs_box').html(placeholder_html);
					//$('.customer_data_placeholder').html(placeholder_html);
				},
				success : function(result){
					$('#btn_block_generator').prop('disabled', true);

					if(result.status == 'success'){
						alert(result.message);
						location.reload();
					}

				}
			});


		}

	});

	$('#btn_add_more_blocks').click(function(event){

		event.preventDefault();
		$('#additonal_blocks_input').modal();


	})

	$('#btn_additional_blocks_save').click(function(event){
		var nofblocks = $('#no_of_blocks').val();
		if(nofblocks > 0){

			var res = confirm("Are you sure you want to generate "+ nofblocks +" more records ?");

			var project_id = $(this).attr('project_id');
			var location_id = $(this).attr('location_id');

			if (res == true) {

				$.ajax({
					type :'POST',
					dataType:'JSON',

					cache: false,
					url : '<?php echo Yii::app()->baseUrl."/index.php/projects/blockListing/GenerateBlocks"; ?>',
					data : {

						nofblocks: nofblocks, project_id: project_id, location_id: location_id
					},

					beforeSend: function() {
						//$('#total_chrgs_box').html(placeholder_html);
						//$('.customer_data_placeholder').html(placeholder_html);
					},
					success : function(result){
						$('#btn_block_generator').prop('disabled', true);

						if(result.status == 'success'){

							location.reload();
						}

					}
				});


			}

		}

	})
</script>

