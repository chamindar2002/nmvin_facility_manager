<strong><?php echo $fcm->firstname; ?> <?php echo $fcm->familyname; ?>
<br>
House #;
<?php echo $fcm->blocknumber; ?>
</strong>

<input type="hidden" name="facility_master_id" id="facility_master_id" value="<?php echo $fcm->facility_master_id; ?>">
<table>
    <tr><th>#</th><th>Receipt Number</th><th>Date</th><th>Amount</th></tr>
<?php
$i=0;
$style = '#f1f1f1';
$t = 0;
foreach($data As $d){
    
    $style = ( $i % 2) == 0 ? '#f1f1f1' : '';
    //echo $style;
    $t += $d->paidamount;
?>
    
    <tr style="background: <?php echo $style; ?>">
        <td style="width:18px"><input type='checkbox' class="receiptnos" name='receiptno[]' id="receipt_<?php echo $i?>" value="<?php echo $d->receiptno;  ?>" checked></td>
        <td><?php echo $d->receiptno; ?></td>
        <td><?php echo $d->receiptdate; ?></td>
        <td style="text-align: right;"><?php echo utilsComponents::formatCurrency($d->paidamount); ?></td>
    </tr>
    
<?php
    $i++;
}
?>
    <tr><td>&nbsp;</td><td>&nbsp;</td><td><strong>Total</strong></td><td style="text-align: right;"><strong><?php echo utilsComponents::formatCurrency($t); ?></strong></td></tr></strong>
</table>


<br>

  
<input type="button" id="btn_search" class="btn btn-success" name="btn_search"  value="Select" data-toggle="modal" data-target="#myModal" >

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header" id="div_summary">
            
        </div>
        
        <div class="modal-footer">
        <button type="button" id="btn_import_receipts" class="btn btn-success">Import</button>
        
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<script type="text/javascript">

var placeholder_html = '<br><span class="loader" style="margin-left:45%;"><img src="<?php echo yii::app()->baseUrl; ?>/themes/images/loading.gif" alt="Loading...") /></span><br><br>';

$("#btn_search").click(function(){
  
  
  
  //var receipt_nos_selected = $("input[name='receiptno[]']:checked");
  
  var items = [];
  $("input[name='receiptno[]']:checked").each(function(){items.push($(this).val());});
  
  var facility_master_id = $('#facility_master_id').val();
  
  $.ajax({
                type :'POST',
                dataType:'html',
                
                cache: false,
                url : '<?php echo Yii::app()->baseUrl."/index.php/dataimport/ReceiptImporter/ListReceiptSummary"; ?>',
                data : { receipt_nos_selected : items, facility_master_id:facility_master_id},
                
                beforeSend: function() {
                    //$('#total_chrgs_box').html(placeholder_html);
                    $('#div_summary').html(placeholder_html);
                },
                success : function(result){
                     //console.log(result);
                     $('#div_summary').html(result);
                }
            });
            
    
});


$("#btn_import_receipts").click(function(){
    var selected_receipts = $('#selected_receipts').val();
    var facility_master_id = $('#facility_master_id').val();
    
    var r = confirm("Confirm Import.");
    if(r == true){
    $.ajax({
                type :'POST',
                dataType:'html',
                
                cache: false,
                url : '<?php echo Yii::app()->baseUrl."/index.php/dataimport/ReceiptImporter/ImportReceiptsToFacility"; ?>',
                data : { selected_receipts : selected_receipts, facility_master_id:facility_master_id},
                
                beforeSend: function() {
                    //$('#total_chrgs_box').html(placeholder_html);
                    $('#div_summary').html(placeholder_html);
                },
                success : function(result){
                     //console.log(result);
                     $('#div_summary').html(result);
                      $('#btn_import_receipts').attr('disabled','disabled');
                }
            });
    }
    
    //alert(selected_receipts+' facility master id : '+facility_master_id);
});
</script>