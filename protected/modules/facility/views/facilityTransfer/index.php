<?php
/* @var $this FacilityTransferController */

$this->breadcrumbs=array(
	'Facility Transfer',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'facility-master-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>


<?php echo $form->labelEx($model,'customer_id_original'); ?>

<div class="form-group" id="transfer_dls_div">
    <pre>
<?php
//var_dump($fm);
echo Customerdetails::model()->getFullName2($fm->customer_id);
echo '<br>';
echo Customerdetails::model()->getFullAddress($fm->customer_id);
echo '<br>';
echo 'Facilty : '.$sale->blockrefnumber.'->'.$sale->blockDetails->blocknumber.' ['.$sale->projectMaster->projectname.'] ';
?>
    </pre>
</div>
    
    
<div class="form-group">

<?php
     $this->renderPartial('_msearch',array('form'=>$form,'model'=>$model));
?>

</div>

<div class="row buttons">
		<?php //echo CHtml::submitButton('Submit',array('class'=>'btn btn-primary btn-lg btn-block')); ?>
	</div>

<?php $this->endWidget(); ?>

</div>

<input type="button" id="btn_search" class="btn btn-success" name="btn_search"  value="Select" data-toggle="modal" data-target="#myModal" >

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header" id="div_summary">
            
        </div>
            
        
        
        <div class="modal-footer">
        <button type="button" id="btn_confirm" class="btn btn-success" disabled="disabled">Confirm Transfer</button>
        
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>

<script>
   $('#btn_search').click(function(){
       
      var transfaree = $('#FacilityTransfers_customer_id_new').val();
      
      if(transfaree != ''){
          
          var $html = $( "#transfer_dls_div" ).html();
          $html += '<p><strong>Transfer To: </strong></p>'
          $html += '<pre>';
          $html += $( "#member_name" ).html();
         // $( "#member_name" ).appendTo( "<$pre>" );
          $("#div_summary" ).html($html);
         // $( "#member_name" ).appendTo( "#</pre>" );
         
         $('#btn_confirm').prop("disabled", false); 
          
          
      } 
   });
   
   $('#btn_confirm').click(function(){
       
      var r = confirm("Confirm Transfer ?");
        if (r == true) {
            $('#facility-master-form').submit();
        }
   });
</script>