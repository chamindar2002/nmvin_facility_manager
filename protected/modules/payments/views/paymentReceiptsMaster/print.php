<style>
    td{
        padding: 5px;
    }
    #receipt_print_prv{
        width: 100%;
    }
    #receipt_print_prv tr td{
/*        border: 1px solid black;*/
    }    
    
    .receipt_no{
        font-weight: bold;
        text-align: center;
    }
    .receipt_date{
        text-align: right;
    }
    
    .receipient_header{
        width:20%;
        float:left;
        /*border:1px solid red;*/
        
    }
    
    .receipt_receipient_name{
        width: 80%;
        float:left;
        font-weight: bold;
        /*border:1px solid red;*/
    }
    
    .receipt_receipient_address{
        text-align: left;
        font-weight: normal;
    }
    
    .facility_ptclrs_header{
       float: left;
        width:40%;
        
        /*border:1px solid red;*/
    }
    
    .facility_ptclrs_header_items{
        font-style: italic;
    }
    
    .facility_ptclrs_details{
        float: left;
        width:60%;
            /*border:1px solid red;*/
    }
    
    .mode_of_payment{
        width: 70%;
        float:left;
        /*border:1px solid red;*/
    }
    
    .payment_details{
        width: 30%;
        float:left;
        /*border:1px solid red;*/
        text-align: center;
    }
    
    .payment_details_amt{
        width: 10%;
        float: left;
        /*border:1px solid red;*/
        text-align: right;
        font-weight: bold;
    }
    
    .payment_details_amt_header{
        width: 20%;
        float: left;
        /*border:1px solid red;*/
        
    }
    
    .stamp_place_holder{
        float: right;
        text-align: center;
        border: 1px dotted #000;
        height:100px;
        width:80px;
        
    }
    
    .stamp_text{
        margin-top:33px;
    }
    
</style>

<table id="receipt_print_prv">
<!--    <tr><td><h2><?php echo Yii::app()->name; ?></h2></td></tr>-->
    <tr><td class="receipt_no"><span class="receipt_no">RECEIPT No: <?php echo $model->id; ?></span></td></tr>
    <tr><td class="receipt_date"><span class="receipt_date">Date/දිනය: <?php echo date(utilsComponents::getSiteConfigDateFormat(),strtotime($model->receipt_date)); ?></span></td></tr>
    <tr>
        <td>
        <div class="receipient_header">Received From<br>ගෙවු අයගේ නම:</div>
        <div class="receipt_receipient_name">
            <?php echo $model->customer_name; ?>
            <br>
            <span class="receipt_receipient_address">
            <?php echo $model->customer_address; ?>
            </span>
        </div>
        </td>
    </tr>
    
    <tr>
        <td>
        <div class="facility_ptclrs_header">
            Details/විස්තරය:
            <div class="facility_ptclrs_header_items">
                <?php
                    foreach($settlements As $k=>$v){
                        echo "$v<br>";
                    }
                ?>
            </div>
        </div>
        
        <div class="facility_ptclrs_details">
            <div class="">Name Of Scheme<br>නිවාස සංකීරණයේ නම: } <?php echo $model->name_of_scheme; ?></div>
            <div class="">House Number<br>නිවසේ අංකය: } <?php echo $model->house_number; ?></div>
            <div class="">Value Of House<br>නිවසේ වටිනාකම රු. } <?php echo utilsComponents::formatCurrency($model->value_of_house); ?></div>
        </div>
        </td>
    </tr>
    
    <tr><td><div class="mode_of_payment">Mode Of Payment/ගෙවූ ආකාරය</div><div class="payment_details">Amount/වටිනාකම</div></td></tr>
    <tr><td>
            <div class="mode_of_payment">
                <?php
                    foreach($receipt_details As $rd){
                        echo $rd->payment_type;
                        
                        if($rd->cheque_number != 0){
                            echo '&nbsp;&nbsp;&nbsp;'.$rd->cheque_number;
                        }
                        
                        if($rd->bank_id != 1){
                            echo '&nbsp;&nbsp;&nbsp;'.$rd->bank_name;
                        }
                    }
                ?>
            </div>
            <div class="payment_details_amt_header">Amount Paid/ගෙවූ මුදල:</div>
            <div class="payment_details_amt"><?php echo utilsComponents::formatCurrency($model->amount_paid); ?></div>
        </td></tr>
    
    <tr><td>
            This receipt is not valid until cheque subject to realization.
            <br>
            චෙක්පත් මුදල් වලට පරිවර්තනය වන තෙක් මෙය වලංගු නොවෙි.
        </td></tr>
    <tr><td><div class="stamp_place_holder"><div class="stamp_text">මුද්දරය</div></div></td></tr>
<!--    <tr><td><?php echo $model->customer_name; ?></td></tr>
    <tr><td><?php echo $model->customer_address; ?></td></tr>
    <tr><td><?php echo $model->name_of_scheme; ?></td></tr>
    <tr><td><?php echo $model->house_number; ?></td></tr>
    <tr><td><?php echo $model->value_of_house; ?></td></tr>
    <tr><td><?php echo $model->created_at; ?></td></tr>
    <tr><td><?php echo $model->amount_paid; ?></td></tr>
    <tr><td><?php echo $model->addedby; ?></td></tr>
    <tr><td><?php echo $model->details; ?></td></tr>-->
    
    	
</table>

<p>
    <?php echo  CHtml::link('PRINT',array('paymentReceiptsMaster/GeneratePdf/id/'.$model->id)); ?>
</p>
<?php
//print_r($settlements);
//$settlements = RepaymentSchemaSettlement::model()->getRepaymentSettlementsByReceiptId(974,true);

//print_r($settlements);


?>