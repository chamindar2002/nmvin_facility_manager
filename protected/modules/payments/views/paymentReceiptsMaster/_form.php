<?php
/* @var $this PaymentReceiptsMasterController */
/* @var $model PaymentReceiptsMaster */
/* @var $form CActiveForm */
?>
<!--<pre>
<?php
$r = RepaymentSchema::model()->getOverPaidAmountFromLastPayment(2);
echo $r;
?>
</pre>-->

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'payment-receipts-master-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
        
        <div class="form-group">
		<?php echo $form->labelEx($model,'receipt_date'); ?>
		<?php
                //echo $form->textField($model,'receipt_date',array('class'=>'form-control input-sm'));
                 
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                'model' => $model,
                                'attribute' => 'receipt_date',
                                'htmlOptions' => array(
                                    'size' => '10', // textField size
                                    'maxlength' => '10', // textField maxlength
                                ),
                                'options' => array(
                                    'changeMonth' => 'true',
                                    'changeYear' => 'true',
                                    'showAnim' => 'fold',
                                    //'dateFormat'=>'mm-dd-yy',
                                    'dateFormat' =>  utilsComponents::getSiteConfigDateFormatForDatePicker(),
                                    'yearRange' => "2014:2030",
                                    
                                ),
                                'htmlOptions'=>array(
                                    'class'=>'form-control input-sm',
                                    'value'=> date('d-m-Y'),
                                ),
                            ));
                ?>
                
		<?php echo $form->error($model,'receipt_date'); ?>
	</div>


        <div class="form-group">
            <?php
            $this->renderPartial('_msearch',array('form'=>$form,'model'=>$model));
            ?>
        </div>

<!--	<div class="form-group">
		<?php echo $form->labelEx($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
		<?php echo $form->error($model,'id'); ?>
	</div>-->

	<div class="form-group">
		<?php echo $form->labelEx($model,'facility_master_id'); ?>
           
                <?php
                echo $form->hiddenField($model,'facility_master_id',array('class'=>'form-control input-sm'));
                //echo $form->dropDownList($model, 'facility_master_id', CHtml::listData(FacilityMaster::getValidFacility($customer_id), 'id', 'name'), array('prompt' => '','class'=>'form-control input-sm'));
                ?>
                 <div id='facility_master_placeholder'>
                     <?php $this->renderPartial('_facility_master',array('fm'=>$fm)); ?>
                 </div>
		<?php echo $form->error($model,'facility_master_id'); ?>
	</div>

        

<!--	<div class="form-group">
		<?php echo $form->labelEx($model,'customer_id'); ?>
		<?php echo $form->textField($model,'customer_id',array('class'=>'form-control input-sm')); ?>
		<?php echo $form->error($model,'customer_id'); ?>
	</div>-->

	<div class="form-group">
		<?php echo $form->labelEx($model,'customer_name'); ?>
		<?php echo $form->textField($model,'customer_name',array('size'=>60,'maxlength'=>255,'class'=>'form-control input-sm')); ?>
		<?php echo $form->error($model,'customer_name'); ?>
	</div>

<!--	<div class="form-group">
		<?php echo $form->labelEx($model,'transaction_id'); ?>
		<?php echo $form->textField($model,'transaction_id',array('class'=>'form-control input-sm')); ?>
		<?php echo $form->error($model,'transaction_id'); ?>
	</div>-->

        <div class="form-group">
		<?php echo $form->labelEx($model,'amount_paid'); ?>
		<?php echo $form->textField($model,'amount_paid',array('class'=>'form-control input-sm')); ?>
		<?php echo $form->error($model,'amount_paid'); ?>
	</div>

<!--	<div class="form-group">
		<?php echo $form->labelEx($model,'deleted'); ?>
		<?php echo $form->textField($model,'deleted'); ?>
		<?php echo $form->error($model,'deleted'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'addedby'); ?>
		<?php echo $form->textField($model,'addedby'); ?>
		<?php echo $form->error($model,'addedby'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'created_at'); ?>
		<?php echo $form->textField($model,'created_at'); ?>
		<?php echo $form->error($model,'created_at'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'updated_at'); ?>
		<?php echo $form->textField($model,'updated_at'); ?>
		<?php echo $form->error($model,'updated_at'); ?>
	</div>-->

<div class="form-group">
<?php echo $form->labelEx($model,'method_of_payment'); ?>
    <br>
<?php 

foreach($payment_types As $pt){
   
   if($model->method_of_payment == $pt->name){
       
       if($pt->name == 'CHEQUE' || $pt->name == 'BANK DEPOSIT'){
            echo '<input type="radio" value="'.$pt->name.'" name="opt_method_of_payment" data-toggle="modal" data-target="#myModal" checked>'.$pt->name.'<br>';
       }else{
            echo '<input type="radio" value="'.$pt->name.'" name="opt_method_of_payment" checked>'.$pt->name.'<br>';
       }
   }else{
       if($pt->name == 'CHEQUE' || $pt->name == 'BANK DEPOSIT'){
            echo '<input type="radio" value="'.$pt->name.'" name="opt_method_of_payment" data-toggle="modal" data-target="#myModal">'.$pt->name.'<br>';
       }else{
            echo '<input type="radio" value="'.$pt->name.'" name="opt_method_of_payment">'.$pt->name.'<br>';
       }
   }
    
}
?>

<?php echo $form->error($model,'method_of_payment'); ?>
</div>
       
<!--<input type="radio" value="CASH" name="opt_method_of_payment" checked> CASH
<input type="radio" value="CHEQUE" name="opt_method_of_payment" data-toggle="modal" data-target="#myModal"> CHEQUE-->
<?php $this->renderPartial('_cheque_details', array('model'=>$model,'form'=>$form,'banks'=>$banks,)); ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary btn-lg btn-block')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<div class="modal fade" id="modal_payment_validation" tabindex="-1" role="dialog" aria-labelledby="modal_payment_validation_label">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" id="close-modal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Authorization Required</h4>
			</div>
			<div class="modal-body">
				<div class="response_data_placeholder"></div>
				<br />
				<div class="user_data_placeholder">
					<div class="form-group">
						<div class="input-group">
												<span class="input-group-addon">
													<i class="fa fa-user" aria-hidden="true"></i>
												</span>
							<input class="form-control" placeholder="Username" id="loginname" name="loginname" type="text" autofocus>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
												<span class="input-group-addon">
													<i class="fa fa-unlock" aria-hidden="true"></i>
												</span>
							<input class="form-control" placeholder="Password" id="password" name="password" type="password" value="">
						</div>
					</div>
					<div class="form-group">
						<input type="button" id="btn_authrize" class="btn btn-lg btn-primary btn-block" value="Sign in">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">

<?php if($model->defualted){ ?>

	$( document ).ready(function() {
		$('#modal_payment_validation').modal();

		$('.errorSummary').appendTo('.response_data_placeholder');
	});
<?php } ?>

$('#btn_authrize').click(function(){

	var user = $('#loginname').val();
	var pwd = $('#password').val();
	var customer_id = $('#PaymentReceiptsMaster_customer_id').val();
	var placeholder_html = '<br><span class="loader" style="margin-left:45%;"><img src="<?php echo yii::app()->baseUrl; ?>/themes/images/loading.gif" alt="Loading...") /></span><br><br>';
	var resp = '<div class="errorSummary">';
	$.ajax({
		type :'POST',
		dataType:'JSON',

		cache: false,
		url : '<?php echo Yii::app()->baseUrl."/index.php/site/authorize"; ?>',
		data : { username:user, password:pwd, customer_id:customer_id},

		beforeSend: function() {
			//$('#total_chrgs_box').html(placeholder_html);
			$('.response_data_placeholder').html(placeholder_html);
		},
		success : function(result){

			if(result.response == 'error'){

				$.each(result.data,function(k,v){

					resp += v

				})


			}else if(result.response == 'success'){

				$( document ).ready(function() {
					$('#close-modal').trigger('click');
				});



			}else{

				resp += 'An unknow error occured. Please contact IT department';

			}

			resp += '</div>';


			$('.response_data_placeholder').html(resp);

		}
	});
})

</script>