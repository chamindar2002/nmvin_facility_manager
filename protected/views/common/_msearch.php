<?php echo CHtml::label('Customer', 'Customer', array('class'=>'required')); ?>
	
<?php
/*if($members == null){*/
    
echo CHtml::hiddenField('customer_id','');
echo CHtml::hiddenField('facility_master_id','');


    
Yii::import('zii.widgets.jui.CJuiAutoComplete');
// ext is a shortcut for application.extensions
$this->widget('ext.myAutoComplete', array(
    'name' => 'msearch_receipt_master',
    'source' => $this->createUrl('/customers/Customerdetails/AutocompleteByMemberId'),
    // attribute_value is a custom property that returns the
    // name of our related object -ie return $model->related_model->name
    'value' => '',
    'options' => array(
        'minLength' => 1,
        'autoFill' => false,
        'focus' => 'js:function( event, ui ) {
            $( "#customer_id" ).val( ui.item.customercode );
            $( "#facility_master_id" ).val( ui.item.facility_master_id );
//            $( "#customer_id" ).val( ui.item.customercode );
            $( "#msearch_receipt_master" ).val( ui.item.customercode );
            $("#PaymentReceiptsMaster_facility_master_id").val(ui.item.facility_master_id);
            $( "#PaymentReceiptsMaster_customer_name").val(ui.item.firstname +" "+ ui.item.familyname);
            $( "#member_name").html( ui.item.firstname +" "+ ui.item.familyname +" "+ui.item.addressline1+" "+ui.item.passportno+" [House: "+ui.item.blocknumber+"]" );
            
            return false;
        }',
        
        'select' => 'js:function( event, ui ) {
            $("#' . CHtml::activeId('customer_id', 'customer_id') . '").val(ui.item.customercode);
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


?>

<div id="member_name"></div>

<script type='text/javascript'>

    function fetchFacility(){
        var customer_id = $('#customer_id').val();
        var facility_master_id = $('#facility_master_id').val();

        $.ajax({
            type :'POST',
            dataType:'html',

            cache: false,
            url : '<?php //echo Yii::app()->baseUrl."/index.php/payments/paymentReceiptsMaster/RenderFacilityMaster"; ?>',
            data : { facility_master_id : facility_master_id,},

            beforeSend: function() {

            },
            success : function(result){

                $('#facility_master_placeholder').html(result);
            }
        });


    }
</script>