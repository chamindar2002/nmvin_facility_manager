<?php echo $form->labelEx($model,'customer_id'); ?>
	
<?php
/*if($members == null){*/
    
echo $form->hiddenField($model,'customer_id');

    
Yii::import('zii.widgets.jui.CJuiAutoComplete');
// ext is a shortcut for application.extensions
$this->widget('ext.myAutoComplete', array(
    'name' => 'test_autocomplete3',
    'source' => $this->createUrl('/facility/facilityMaster/AutocompleteByMemberId'),
    // attribute_value is a custom property that returns the
    // name of our related object -ie return $model->related_model->name
    'value' => $model->customer_id,
    'options' => array(
        'minLength' => 1,
        'autoFill' => false,
        'focus' => 'js:function( event, ui ) {
            $( "#FacilityMaster_customer_id" ).val( ui.item.customercode );
            $( "#test_autocomplete3" ).val( ui.item.customercode );
            $( "#member_name").html( ui.item.firstname +" "+ ui.item.familyname +" "+ui.item.addressline1+" "+ui.item.passportno );
            
            return false;
        }',
        
        'select' => 'js:function( event, ui ) {
            $("#' . CHtml::activeId($model, 'customer_id') . '").val(ui.item.customercode);
            faciltyMasterSubmitCustomerCode();
            return false;
         }'
        
        
        
    ),
    'htmlOptions' => array('class' => 'input-1 form-control input-sm', 'autocomplete' => 'off'),
    'methodChain' => '.data( "autocomplete" )._renderItem = function( ul, item ) {
        return $( "<li></li>" )
        .data( "item.test_autocomplete3", item )
        .append( "<a>" + item.firstname +" "+ item.familyname +" "+item.addressline1+" "+item.addressline2+" "+item.passportno+"</a>" )
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
        if(sizeof($model) > 0){
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