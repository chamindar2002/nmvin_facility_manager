<?php
/* @var $this PaymentModelController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Payment Models',
);

$this->menu=array(
	array('label'=>'Create PaymentModel', 'url'=>array('create')),
	array('label'=>'Manage PaymentModel', 'url'=>array('admin')),
);
?>

<h1><?php echo $pplan_master->name; ?></h1>



<?php


$this->widget('zii.widgets.grid.CGridView', array(

    'dataProvider'=>$dataProvider,

    'columns'=>array(
        //'id',          // display the 'title' attribute
        'paymentPlanMaster.name',
        'paymentPlanItem.name',
        'is_installment_definer',
	'no_of_installments',
	'installment_amount',
        'interest',
	'tax',
	'total_payable',
        'payment_sequence',
                
        array(  

            'class'=>'CButtonColumn',
            'template'=>'{view}{update}',
        ),

         

    ),

));

?>
<p>
<input type="button" class="btn btn-primary" value="Sort Payment Sequence" data-toggle="modal" data-target="#sort_box">
</p>

<div id="sort_box" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Payment Sequence</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label>Payment Model Item</label>
           <select id="sort_payplan_model" name="sort_payplan_model" class="form-control input-lg">
               <?php 
                $data = $dataProvider->data;
                foreach($data As $d){
                    echo "<option value='".$d->id."'>".$d->paymentPlanItem->name."</option>";
                }
                
                ?>
            </select>
            
            <label>Sort Sequence</label>
            <select id="sort_payplan_sequence" name="sort_payplan_sequence" class="form-control input-lg">
                <option value="-1"></option>
               <?php 
                
                for($i=1; $i <= sizeof($data); $i++){
                    echo "<option id='>".$i."'>".$i."</option>";
                }
                
                ?>
            </select>
                <?php 
//                $data = $dataProvider->data;
//                foreach($data As $d){
//                    echo $d->paymentPlanItem->name.'<br>';
//                }
                
                ?>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="bnt_payment_seq_close" data-dismiss="modal">Close</button>
            </div>
            
            <div id="results_output" class="modal-footer">
                
            </div>
            
	</div>
      </div>
    </div>
    </div>
</div>
<?php
/*
 $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); */ ?>
<script type="text/javascript">

 $('select#sort_payplan_sequence').change(function() {
  
  var placeholder_html = '<br><span class="loader" style="margin-left:45%;"><img width="10px" src="<?php echo yii::app()->baseUrl; ?>/themes/images/loading.gif" alt="Loading...") /></span><br><br>';
  var sort_value = $(this).val();
  var payplan_model = $('#sort_payplan_model').val();
  
  if(sort_value == ''){
    return;
  }
  
  $.ajax({
                type :'POST',
                dataType:'html',
                
                cache: false,
                url : '<?php echo Yii::app()->baseUrl."/index.php/facilityutils/paymentModel/UpdateSortOrder"; ?>',
                data : { sort_value : sort_value, payplan_model : payplan_model},
                
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

$('select#sort_payplan_model').change(function() {

    $('#sort_payplan_sequence').val(-1);
            
});

$('#bnt_payment_seq_close').click(function(){
  location.reload();  
});
</script>