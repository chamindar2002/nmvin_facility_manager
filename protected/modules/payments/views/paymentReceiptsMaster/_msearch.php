<?php echo $form->labelEx($model,'customer_id'); ?>
	
<?php
/*if($members == null){*/
    
echo $form->hiddenField($model,'customer_id');

    
Yii::import('zii.widgets.jui.CJuiAutoComplete');
// ext is a shortcut for application.extensions
$this->widget('ext.myAutoComplete', array(
    'name' => 'msearch_receipt_master',
    'source' => $this->createUrl('/payments/paymentReceiptsMaster/AutocompleteByMemberId'),
    // attribute_value is a custom property that returns the
    // name of our related object -ie return $model->related_model->name
    'value' => $model->customer_id,
    'options' => array(
        'minLength' => 1,
        'autoFill' => false,
        'focus' => 'js:function( event, ui ) {
            $( "#PaymentReceiptsMaster_id" ).val( ui.item.customercode );
//            $( "#PaymentReceiptsMaster_customer_id" ).val( ui.item.customercode );
            $( "#msearch_receipt_master" ).val( ui.item.customercode );
            $("#PaymentReceiptsMaster_facility_master_id").val(ui.item.facility_master_id);
            $( "#PaymentReceiptsMaster_customer_name").val(ui.item.title+". "+ui.item.firstname +" "+ ui.item.familyname);
            $( "#member_name").html( ui.item.firstname +" "+ ui.item.familyname +" "+ui.item.addressline1+" "+ui.item.passportno+" [House: "+ui.item.blocknumber+"]" );
            
            return false;
        }',
        
        'select' => 'js:function( event, ui ) {
            $("#' . CHtml::activeId($model, 'customer_id') . '").val(ui.item.customercode);
            fetchFacility();
            return false;
         }'
        
        
        
    ),
    'htmlOptions' => array('class' => 'input-1 form-control input-sm', 'autocomplete' => 'off'),
    'methodChain' => '.data( "autocomplete" )._renderItem = function( ul, item ) {
        return $( "<li></li>" )
        .data( "item.msearch_receipt_master", item )
        .append( "<a>" + item.firstname +" "+ item.familyname +" "+item.addressline1+" "+item.addressline2+" "+item.passportno+" [House: "+item.blocknumber+"]</a>" )
        .appendTo( ul );
    };'
));


/*
}else{
    // e.x. if template is defined to restrict to Diamond Members 
    echo $form->dropDownList($model,'member_id',CHtml::listData($members,'mid','FullName'),
                            array('prompt'=>''));
}
*/
?>
<?php echo $form->error($model,'customer_id'); ?>

<div id="member_name">
        <?php
        if($model->customer_id != 0){
            if(!$model->isNewRecord || isset($model->customer_id)){
                echo Customerdetails::model()->findByPk($model->customer_id)->firstname." ";
                echo Customerdetails::model()->findByPk($model->customer_id)->familyname." ";
                echo Customerdetails::model()->findByPk($model->customer_id)->addressline1." ";
                echo Customerdetails::model()->findByPk($model->customer_id)->addressline2." ";
                echo Customerdetails::model()->findByPk($model->customer_id)->passportno." ";

            }
        }
        ?>
        
    </div>

<script type='text/javascript'>
    
function fetchFacility(){
    var customer_id = $('#PaymentReceiptsMaster_customer_id').val();
    var facility_master_id = $('#PaymentReceiptsMaster_facility_master_id').val();
    
    $.ajax({
                type :'POST',
                dataType:'html',
                
                cache: false,
                url : '<?php echo Yii::app()->baseUrl."/index.php/payments/paymentReceiptsMaster/RenderFacilityMaster"; ?>',
                data : { facility_master_id : facility_master_id,},
                
                beforeSend: function() {
                    //$('#total_chrgs_box').html(placeholder_html);
                },
                success : function(result){
                     //console.log(result);
                     $('#facility_master_placeholder').html(result);
                }
            });
    
    //alert(facility_master_id);
}
</script>