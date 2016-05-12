<?php

/* @var $this CollectionController */

$this->breadcrumbs = array(
    'Collection',
);
?>
<?php echo CHtml::label('From', ''); ?>
<?php

//echo $form->textField($model,'receipt_date',array('class'=>'form-control input-sm'));

$this->widget('zii.widgets.jui.CJuiDatePicker', array(
    //'model' => $model,
    //'attribute' => 'start_date',
    'name' => 'from_date',
    'options' => array(
        'changeMonth' => 'true',
        'changeYear' => 'true',
        'showAnim' => 'fold',
        //'dateFormat'=>'mm-dd-yy',
        'dateFormat' => utilsComponents::getSiteConfigDateFormatForDatePicker(),
        'yearRange' => "2014:2030",
    ),
    'htmlOptions' => array(
        'class' => 'form-control input-sm',
        'value' => date('d-m-Y'),
    ),
));
?>


<?php echo CHtml::label('To', ''); ?>
<?php

//echo $form->textField($model,'receipt_date',array('class'=>'form-control input-sm'));

$this->widget('zii.widgets.jui.CJuiDatePicker', array(
    //'model' => $model,
    //'attribute' => 'start_date',
    'name' => 'to_date',
    'options' => array(
        'changeMonth' => 'true',
        'changeYear' => 'true',
        'showAnim' => 'fold',
        //'dateFormat'=>'mm-dd-yy',
        'dateFormat' => utilsComponents::getSiteConfigDateFormatForDatePicker(),
        'yearRange' => "2014:2030",
    ),
    'htmlOptions' => array(
        'class' => 'form-control input-sm',
        'value' => date('d-m-Y'),
    ),
));
?>

<?php echo CHtml::label('Filter By Bank', ''); ?>
<?php echo CHtml::dropDownList('bank_id', 'bank_id', 
        CHtml::listData(
                PaymentBank::model()->findAll(), 'id', 'bank_name'),
                array('prompt' => 'All','class'=>'form-control input-sm'));
?>


<?php echo CHtml::label('Filter By User', ''); ?>
<?php echo CHtml::dropDownList('user_id', 'user_id', 
        CHtml::listData(
                 User::model()->listAllValidUsers(), 'uid', 'loginname'),
                array('prompt' => 'All','class'=>'form-control input-sm'));
?>


<br>
<input type="button" id="btn_search" class="btn btn-success" name="btn_search" value="Search">
<div id="results_output"></div>


<script type="text/javascript">

$("#btn_search").click(function(){
  
  var placeholder_html = '<br><span class="loader" style="margin-left:45%;"><img src="<?php echo yii::app()->baseUrl; ?>/themes/images/loading.gif" alt="Loading...") /></span><br><br>';
  var from_date = $("#from_date").val();
  var to_date = $('#to_date').val();
  var bank_id = $('#bank_id').val();
  var user_id = $('#user_id').val();
  
      
  $.ajax({
                type :'POST',
                dataType:'html',
                
                cache: false,
                url : '<?php echo Yii::app()->baseUrl."/index.php/reports/collection/RenderCollectionResults"; ?>',
                data : { from_date : from_date, to_date:to_date, bank_id:bank_id, user_id:user_id },
                
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
