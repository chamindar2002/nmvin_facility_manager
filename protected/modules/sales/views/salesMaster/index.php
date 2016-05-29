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

		array(
			'class'=>'CButtonColumn',
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
											CHtml::listData($projects, 'projectcode', 'projectname'),
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

<script type="text/javascript">

var placeholder_html = '<br><span class="loader" style="margin-left:45%;"><img src="<?php echo yii::app()->baseUrl; ?>/themes/images/loading.gif" alt="Loading...") /></span><br><br>';

$('#btn_add_sale').click(function(event){
event.preventDefault();

	$('#modal_sale_form').modal();
	$.fn.yiiGridView.update('sales-details-grid');

});

$('#btn_sale_data_save').click(function(event){
	var customer_id = $('#customer_id').val();
	var project_id = $('#ViewSaleCustomerProjectLocation_projectcode :selected').val();
	var block_id = $('#ViewSaleCustomerProjectLocation_blockrefnumber').val();

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


			}

			$.fn.yiiGridView.update('sales-details-grid');

		}
	});
})



</script>