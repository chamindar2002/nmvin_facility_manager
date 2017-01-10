<?php
/* @var $this SalesMasterController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Sales Details',
);

$this->menu=array(
	//array('label'=>'Add', 'url'=>array('#'), 'itemOptions'=>array('id' => 'btn_add_salew'),),
	//array('label'=>'Manage SalesDetails', 'url'=>array('admin')),
);

?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'sales-details-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'sales_ref_no',
		'addeddate',
		'location_name',
		'project_name',
		'blocknumber',
		'firstname',
		'familyname',
		'passportno',
//		array(
//			'name'  => 'sales_ref_no',
//			'header'=>'xyz',
//			'value' => 'CHtml::link("View",Yii::app()->createUrl("facilityutils/paymentModel/index",array("id"=>$data->sales_ref_no)))',
//			'type'  => 'raw',
//			'filter'=>false
//		),

		array(
			'class'=>'CButtonColumn',
			'template'=>'{edit}',
			'buttons'=>array
			(
				'edit' => array
				(
					'label'=>'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>',
					//'imageUrl'=>'<i class="fa fa-pencil" aria-hidden="true"></i>',
					'click'=>"function(){
                                    fetchSale($(this).attr('href'));
                                    return false;
                              }
                     ",
					'url'=>'$data->sales_ref_no',
				),
			)
		),
	),
)); ?>
<input type="button" value="New Sale" class="btn btn-primary" id="btn_add_sale">

<div class="modal fade" id="modal_sale_form" tabindex="-1" role="dialog" aria-labelledby="mymodal_block_info_abel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">New Sale</h4>
			</div>
			<div class="modal-body">
				<div class="customer_data_placeholder"></div>
				<br />
					<div class="form">

					<?php $form=$this->beginWidget('CActiveForm', array(
						'id'=>'sales-details-form',
						// Please note: When you enable ajax validation, make sure the corresponding
						// controller action is handling ajax validation correctly.
						// There is a call to performAjaxValidation() commented in generated controller code.
						// See class documentation of CActiveForm for details on this.
						'enableAjaxValidation'=>false,
					)); ?>

					<p class="note">Fields with <span class="required">*</span> are required.</p>



					<?php echo $form->errorSummary($model); ?>

						<div class="form-group">
							<?php $this->renderPartial('application.modules.reports.views.common._msearch'); ?>
						</div>


						<div class="form-group">
							<?php echo $form->labelEx($model,'projectcode'); ?>
							<?php
								echo $form->dropDownList($model, 'projectcode',
											$projects,
											array('prompt' => '','class'=>'form-control input-sm',
												'ajax' => array(
													'type'=>'POST',
													'url'=>Yii::app()->createUrl('sales/salesMaster/ProjectDetails'), //or $this->createUrl('loadcities') if '$this' extends CController
													'update'=>'#ViewSaleCustomerProjectLocation_blockrefnumber', //or 'success' => 'function(data){...handle the data in the way you want...}',
													'data'=>array('project_id'=>'js:this.value'),
												)
							));
							?>
							<?php echo $form->error($model,'projectcode'); ?>
						</div>


						<div class="form-group">
							<?php echo $form->labelEx($model,'blockrefnumber'); ?>
							<?php echo $form->dropDownList($model,'blockrefnumber', array(), array('prompt'=>'', 'class'=>'form-control input-sm')); ?>
							<?php echo $form->error($model,'blockrefnumber'); ?>
						</div>





					<?php $this->endWidget(); ?>

				  </div>
		    </div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="btn_sale_data_save">Save</button>
			</div>
		</div>
	</div>
</div>




<div class="modal fade" id="modal_sale_update_form" tabindex="-1" role="dialog" aria-labelledby="mymodal_block_info_abel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Update Sale</h4>
			</div>
			<div class="modal-body">
				<div class="customer_data_placeholder"></div>
				<br />
				<div class="form">

					<?php $form=$this->beginWidget('CActiveForm', array(
						'id'=>'sales-details-form',
						// Please note: When you enable ajax validation, make sure the corresponding
						// controller action is handling ajax validation correctly.
						// There is a call to performAjaxValidation() commented in generated controller code.
						// See class documentation of CActiveForm for details on this.
						'enableAjaxValidation'=>false,
					)); ?>

					<p class="note">Fields with <span class="required">*</span> are required.</p>



					<?php echo $form->errorSummary($model); ?>


					<div class="form-group">
						<?php echo $form->labelEx($model,'projectcode'); ?>
						<?php
						echo CHtml::dropDownList('projectcode', 'projectcode',$projects,
							array('prompt' => '','class'=>'form-control input-sm',
								'ajax' => array(
									'type'=>'POST',
									'url'=>Yii::app()->createUrl('sales/salesMaster/ProjectDetails'), //or $this->createUrl('loadcities') if '$this' extends CController
									'update'=>'#blockrefnumber', //or 'success' => 'function(data){...handle the data in the way you want...}',
									'data'=>array('project_id'=>'js:this.value'),
								)
							));
						?>
						<?php echo $form->error($model,'projectcode'); ?>
					</div>


					<div class="form-group">
						<?php echo $form->labelEx($model,'blockrefnumber'); ?>
						<?php echo CHtml::dropDownList('blockrefnumber','blockrefnumber', array(), array('prompt'=>'', 'class'=>'form-control input-sm')); ?>
						<?php echo $form->error($model,'blockrefnumber'); ?>
					</div>

					<input type="hidden" name="sale_ref_no" id="sale_ref_no" >


					<?php $this->endWidget(); ?>

					<a href="#" id="btn_delete" style="display: block"><i class="fa fa-trash-o" aria-hidden="true"></i></a>

				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="btn_sale_data_update">Update</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

var placeholder_html = '<br><span class="loader" style="margin-left:45%;"><img src="<?php echo yii::app()->baseUrl; ?>/themes/images/loading.gif" alt="Loading...") /></span><br><br>';


$("#btn_delete").click(function(event){

	event.preventDefault();

	var sale_ref_no = $('#sale_ref_no').val();

	var res = confirm("Are you sure you want to delete ?");

	if (res == true) {

		$.ajax({
			type :'POST',
			dataType:'JSON',

			cache: false,
			url : '<?php echo Yii::app()->baseUrl."/index.php/sales/salesMaster/DeleteSale"; ?>',
			data : {

				sale_ref_no: sale_ref_no
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
					$('#btn_sale_data_update').prop('disabled', true);

					$.fn.yiiGridView.update('sales-details-grid');

				}


			}
		});


	}

	return;
});


$('#btn_add_sale').click(function(event){
event.preventDefault();

	$('#modal_sale_form').modal();

	$('.customer_data_placeholder').html('');
	$('#customer_id').val('');

	$.fn.yiiGridView.update('sales-details-grid');

});

$('#btn_sale_data_update').click(function(event){

	var customer_id = $('#customer_id').val();
	var project_id = $('#projectcode :selected').val();
	var block_id = $('#blockrefnumber').val();
	var sale_ref_no = $('#sale_ref_no').val()


	var res = confirm("Update sale ?");

	if (res == true) {

		$.ajax({
			type :'POST',
			dataType:'JSON',

			cache: false,
			url: '<?php echo Yii::app()->createUrl('sales/salesMaster/UpdateSale') ?>',
			data : {
				customercode : customer_id,
				projectcode: project_id,
				blockrefnumber: block_id,
				sale_ref_no:sale_ref_no

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

					clearInputFields();
				}

				$.fn.yiiGridView.update('sales-details-grid');

			}
		});



	}

	return;

});

$('#btn_sale_data_save').click(function(event){
	var customer_id = $('#customer_id').val();
	var project_id = $('#ViewSaleCustomerProjectLocation_projectcode :selected').val();
	var block_id = $('#ViewSaleCustomerProjectLocation_blockrefnumber').val();

	var res = confirm("Save this new sale ?");

	if (res == true) {

		$.ajax({
			type :'POST',
			dataType:'JSON',

			cache: false,
			//url : '<?php //echo Yii::app()->baseUrl."/index.php/sales/SalesMaster/AddNewSale"; ?>',
			url: '<?php echo Yii::app()->createUrl('sales/salesMaster/Addnewsale') ?>',
			data : {
				customercode : customer_id,
				projectcode: project_id,
				blockrefnumber: block_id

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

					clearInputFields();
				}

				$.fn.yiiGridView.update('sales-details-grid');

			}
		});

	}else{

		return;
	}


})

function clearInputFields(){

	$('#customer_id').val('');
	$('#msearch_receipt_master').val('');
	$('#member_name').html('');
	$('#ViewSaleCustomerProjectLocation_projectcode').val('');
	$('#ViewSaleCustomerProjectLocation_blockrefnumber').val('');

}

function fetchSale(sales_ref_no) {

	event.preventDefault();

	$('#modal_sale_update_form').modal();
	//var sales_ref_no = $(this).attr('href');
	$("#btn_delete").css('display','block');
	$('#btn_sale_data_update').prop('disabled', false);


	$.ajax({
		type: 'POST',
		dataType: 'JSON',

		cache: false,
		url: '<?php echo Yii::app()->createUrl('sales/salesMaster/getSale') ?>',
		data: {
			sales_ref_no: sales_ref_no

		},

		beforeSend: function () {
			//$('#total_chrgs_box').html(placeholder_html);
			$('.customer_data_placeholder').html(placeholder_html);
		},
		success: function (result) {
			//console.log(result);
			//$('.modal-body').html(result);
			if (result.status == 'error') {

				$('.customer_data_placeholder').html(appendErrors(result.data));
			} else {

				$('.customer_data_placeholder').html(appendSuccess(result.message));
				append_CustomerData(result);


			}

			$.fn.yiiGridView.update('sales-details-grid');

		}
	});
}
	//alert(sales_ref_no);
function append_CustomerData(result){

	var str = "";


	if(result.data.length != 0) {
		str += "<p><h4>" + result.data.firstname + " " + result.data.familyname + "</h4></p>";
		str += result.data.location_name + " " + result.data.project_name + " " + result.data.blocknumber;
		//alert(str);
	}

	$("#projectcode").val(result.data.projectcode);
	//$("#projectcode").trigger('change');
	//$("#blockrefnumber").val(result.data.blockrefnumber);


	$('#blockrefnumber').empty();

	$("#blockrefnumber").append('<option value="'+result.data.blockrefnumber+'">'+result.data.blocknumber+'</option>');
	//$("#blockrefnumber").val(result.data.blockrefnumber);
	$("#blockrefnumber option[value='']").remove();

	$('.customer_data_placeholder').html(str);

	$('#customer_id').val(result.data.customercode);
	$('#sale_ref_no').val(result.data.sales_ref_no);

}

</script>

