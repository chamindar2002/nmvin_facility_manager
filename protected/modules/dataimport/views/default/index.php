<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);
?>
<?php $this->renderPartial('application.modules.reports.views.common._msearch'); ?>



<br>
<input type="button" id="btn_search" class="btn btn-success" name="btn_search" value="Search">
<p>
<div id="results_output"></div>
</p>

<script type="text/javascript">

$("#btn_search").click(function(){
  
  var placeholder_html = '<br><span class="loader" style="margin-left:45%;"><img src="<?php echo yii::app()->baseUrl; ?>/themes/images/loading.gif" alt="Loading...") /></span><br><br>';
  var customer_id = $("#customer_id").val();
  
  if(customer_id == ''){
    return;
  }
      
  $.ajax({
                type :'POST',
                dataType:'html',
                
                cache: false,
                url : '<?php echo Yii::app()->baseUrl."/index.php/dataimport/ReceiptImporter/FetchSale"; ?>',
                data : { customer_id : customer_id},
                
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