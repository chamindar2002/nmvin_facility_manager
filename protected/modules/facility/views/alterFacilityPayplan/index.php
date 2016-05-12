<?php
/* @var $this AlterFacilityPayplanController */

$this->breadcrumbs=array(
	'Alter Facility Payplan',
);
?>


<div class="panel panel-primary">
  <div class="panel-heading">
      <i class="fa fa-user"></i>

  <?php echo Customerdetails::getFullName2($facility->customer_id) ?>    
  </div>
  <div class="panel-body">
      <?php echo CHtml::label('Current Payment Plan',''); ?>
      <br>
      <?php echo  $facility->paymentPlanMaster->name; ?>   
      
  </div>
 
  
</div>

<p>
     <?php echo CHtml::label('New Payment Plan',''); ?>
    
     <?php
        echo CHtml::dropDownList('payment_plan_master_id', 'payment_plan_master_id',
           PaymentPlanMaster::model()->listPaymentPlans(
                   $facility->customer_id),
                   array(
                       'prompt' => '',
                       'class'=>'form-control input-sm',
                       'options'=>$selectedOptions,
                       ));
     ?>
</p>
<div id='results_output'>
    
</div>


<br>
    <?php echo CHtml::button('Update',array('id'=>'btn_update_pplan', 'class'=>'btn btn-primary btn-lg btn-block')); ?>
      


<script type="text/javascript">

$("#btn_update_pplan").click(function(){
  
  var placeholder_html = '<br><span class="loader" style="margin-left:45%;"><img src="<?php echo yii::app()->baseUrl; ?>/themes/images/loading.gif" alt="Loading...") /></span><br><br>';
  var customer_id = '<?php echo $facility->customer_id; ?>';
  var payment_plan = $('#payment_plan_master_id').val();
  var facility_id = '<?php echo $facility->id; ?>';
  
  $("#btn_update_pplan").attr("disabled", true);
  
  if(!confirm("Confirm changing of payment plan?")){
      
      $('#btn_update_pplan').removeAttr('disabled');
      return;
  }
      
  $.ajax({
                type :'POST',
                dataType:'html',
                
                cache: false,
                url : '<?php echo Yii::app()->baseUrl."/index.php/facility/AlterFacilityPayplan/updatePaymentPlan"; ?>',
                data : { customer_id: customer_id, payment_plan: payment_plan, facility_id:facility_id},
                
                beforeSend: function() {
                    //$('#total_chrgs_box').html(placeholder_html);
                    $('#results_output').html(placeholder_html);
                },
                success : function(result){
                     //console.log(result);
                     $('#results_output').html(result);
                }
            });
            
    
});

</script>