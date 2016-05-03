<?php $this->renderPartial('application.modules.reports.views.common._msearch'); ?>

<br>
<input type="button" id="btn_search" class="btn btn-success" name="btn_search" value="Search">
<div id="results_output"></div>

<script type="text/javascript">

$("#btn_search").click(function(){
  
  var placeholder_html = '<br><span class="loader" style="margin-left:45%;"><img src="<?php echo yii::app()->baseUrl; ?>/themes/images/loading.gif" alt="Loading...") /></span><br><br>';
  var customer_id = $("#customer_id").val();
  var facility_master_id = $('#facility_master_id').val();
 
  
  if(customer_id == ''){
    return;
  }
      
  $.ajax({
                type :'POST',
                dataType:'html',
                
                cache: false,
                url : '<?php echo Yii::app()->baseUrl."/index.php/reports/payments/RenderPayementsResults"; ?>',
                data : { customer_id : customer_id, facility_master_id:facility_master_id,},
                
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
