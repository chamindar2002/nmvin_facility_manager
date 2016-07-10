<?php
/* @var $this CustomerdetailsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Customerdetails',
);

$this->menu=array(
	array('label'=>'Add', 'url'=>array('create')),
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'customerdetails-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'customercode',
                'passportno',
		//'title',
		'familyname',
		'firstname',
		'addressline1',
		'addressline2',
		/*
		'postcode',
		'country',
		'email',
		'Skype',
		'landline',
		'mobile',
		'workphone',
		'fax',
		'proffession',
		'gender',
		'passportno',
		'sladdressline1',
		'sladdressline2',
		'sladdressline3',
		'sllandline',
		'slmobile',
		'slcontactperson',
		'onlineuserid',
		'deleted',
		'addedby',
		'addeddate',
		'addedtime',
		'lastmodifiedby',
		'lastmodifieddate',
		'lastmodifiedtime',
		'deletedby',
		'deleteddate',
		'deletedtime',
		*/
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
					'url'=>'$data->customercode',
				),
			)
		),

		array(
			'class'=>'CButtonColumn',
		),

	),
)); ?>

<div class="modal fade" id="modal_sale_update_form" tabindex="-1" role="dialog" aria-labelledby="mymodal_block_info_abel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Facility Summary</h4>
			</div>
			<div class="modal-body">
				<div class="customer_data_placeholder"></div>
				<br />


			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

			</div>
		</div>
	</div>
</div>
</div>

<script type="text/javascript">

	var placeholder_html = '<br><span class="loader" style="margin-left:45%;"><img src="<?php echo yii::app()->baseUrl; ?>/themes/images/loading.gif" alt="Loading...") /></span><br><br>';

	function fetchSale(customer_id) {

		event.preventDefault();

		$('#modal_sale_update_form').modal();
		//var sales_ref_no = $(this).attr('href');
		//$("#btn_delete").css('display','block');
		//$('#btn_sale_data_update').prop('disabled', false);


		$.ajax({
			type: 'POST',
			dataType: 'JSON',

			cache: false,
			url: '<?php echo Yii::app()->createUrl('customers/Customerdetails/ListPayments') ?>',
			data: {
				customer_id: customer_id

			},

			beforeSend: function () {
				//$('#total_chrgs_box').html(placeholder_html);
				$('.customer_data_placeholder').html(placeholder_html);
			},
			success: function (result) {

				appendResults(result);

			}
		});
	}

	function appendResults(result){
		var htm = '';


		$.each(result, function(result, facility) {
			htm += '<h3>Facility : ' + facility.facility_id +' '+facility.block_number+'</h3><hr>';
			htm += '<p><i><strong>';
			htm += 'To be paid: ' + facility.summary.total_to_be_paid + ' | ';
			htm += 'Paid: ' + facility.summary.total_paid + ' | ';
			htm += 'Installments left' + facility.summary.total_installments_left + ' | ';
			htm += '</strong></i></p>';
			htm += '<table class="table-striped" width="100%">';
			htm += '<tr><th>Payment Model</th><th>Due Date</th><th>Payable</th><th>&nbsp;</th></tr>';
			//console.log(facility.payment_data[0].due_date);

			$.each(facility.payment_data, function(k, v) {
				htm += '<tr>'

				if(v.installment_number != ""){
					htm += '<td>'+ v.payment_model+' '+v.installment_number+'</td>';
					htm += '<td>'+v.due_date+'</td>';
				}else{
					htm += '<td>'+ v.payment_model+'</td>';
					htm += '<td>-</td>';
				}


				htm += '<td align="right">'+v.total_payable+'</td>';

				//console.log(v);

				var status =  '';
				var settlement = v.settlements;
				$.each(settlement, function(stlmnts, stlm) {
					//
					$.each(stlm, function(st_obj, st) {
						//console.log(st);
						status = st.status;
					});
				});

				if(status == 'Paid Full'){
					htm += '<td align="right"><i class="fa fa-check-circle" aria-hidden="true"></i></td>'
				}else{
					htm += '<td align="center">&nbsp;</td>';
				}



				htm += '</tr>';


			});
			htm += '</table>';
		});

		$('.customer_data_placeholder').html(htm);
	}


	function appendResults3(result){
		var htm = '';


		$.each(result, function(result, facility) {
			htm += '<h3>Facility : '+facility.facility_id+'</h3><hr>';
			htm += '<p><i><strong>';
			htm += 'To be paid: '+facility.summary.total_to_be_paid + ' | ';
			htm += 'Paid: '+facility.summary.total_paid + ' | ';
			htm += 'Installments left: '+facility.summary.total_installments_left + ' | ';
			htm += '</strong></i></p>';
			htm += '<table class="table-striped" width="100%">';
			htm += '<tr><th>Payment Model</th><th>Due Date</th><th>Payable</th><th>&nbsp;</th></tr>';

			//console.log(facility.payment_data[0].due_date);

			$.each(facility.payment_data, function(k, v) {
				htm += '<tr>'

				if(v.installment_number != ""){
					htm += '<td>'+ v.payment_model+' '+v.installment_number+'</td>';
					htm += '<td>'+v.due_date+'</td>';
				}else{
					htm += '<td>'+ v.payment_model+'</td>';
					htm += '<td>-</td>';
				}


				htm += '<td align="right">'+v.total_payable+'</td>';

				//console.log(v);

				var status =  '';
				var settlement = v.settlements;
				$.each(settlement, function(stlmnts, stlm) {
					//
					$.each(stlm, function(st_obj, st) {
						//console.log(st);
						status = st.status;
					});
				});

				if(status == 'Paid Full'){
					htm += '<td align="right"><i class="fa fa-check-circle" aria-hidden="true"></i></td>'
				}else{
					htm += '<td align="center">&nbsp;</td>';
				}



				htm += '</tr>';


			});

//			$.each(result, function(fc, payments) {
//
//				//htm += '<tr><td>'+payments.installment_number+'</td></tr>';
//				htm = payments;
//
//			});
//
			//htm +=  fc[0].summary.total to be paid;
		});

		htm += '</table>';

		$('.customer_data_placeholder').html(htm);
	}

</script>
