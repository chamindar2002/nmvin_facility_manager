
<?php 
$criteria = new CDbCriteria();
$criteria->compare('customer_id', $customer_id);
$criteria->compare('facility_master_id',$facility->id);
$criteria->order = 'id';


/*$repaymentSchema = RepaymentSchema::model()
        ->findAllByAttributes(
                array(
                    'customer_id'=>$customer_id,
                    'facility_master_id'=>$facility->id,
                    'order'=>'id',
                    ));*/

$repaymentSchema = RepaymentSchema::model()->findAll($criteria);

$customer = Customerdetails::model()->getFullName2($customer_id);
$faddress = Customerdetails::model()->getFullAddress($customer_id);

$fcm = ViewFacilityCustomerBlockRelation::model()->findByAttributes(array('customer_id'=>$customer_id));


#fetch totals
$sqltot1 = "select sum(amount_payable) as total FROM  repayment_schema WHERE facility_master_id='$facility_master_id' AND paid='0'";
$total_installments_left = Yii::app()->db->createCommand($sqltot1)->queryScalar();
                
$sqltot2 = "select sum(amount_paid) as total FROM  payment_receipts_master WHERE facility_master_id='$facility_master_id' AND deleted='0'";
$total_paid = Yii::app()->db->createCommand($sqltot2)->queryScalar();
                
$sqltot3 = "select sum(amount_payable) as total FROM  repayment_schema WHERE facility_master_id='$facility_master_id'";
$total_to_be_paid = Yii::app()->db->createCommand($sqltot3)->queryScalar();

$payment_summary = array(
                        'total to be paid'=>abs($total_to_be_paid - $total_paid) ,
                        'total paid'=>$total_paid,
                        'total installments left'=>$total_installments_left     
                        );
?>


<h3>
    <?php echo $customer; ?>
    <br>
    <?php echo $faddress; ?>
    &nbsp;
    House: <?php echo $fcm->blocknumber; ?>
    
</h3>


<?php

foreach($repaymentSchema As $rs){
    //echo $rs->payment_model_id.'<br>';
    //echo 'payment model->'.$rs->paymentModel->total_payable.'<br>';
    //echo 'payment model Item->'.$rs->paymentModel->paymentPlanItem->name.'<br>';
}

?>
<style>
/*    tr td{
        border:1px solid black;
        padding:2px;
    }*/

.subtable tr td{
/*    border: 1px dotted black;*/
    padding: 2px;
}

.subtable th{
/*    border:1px dotted black;*/
    padding:2px;
}

.subtable{
    width: 100%;
}
</style>
<p>
<table class="table table-striped">
    <tr><th>Payment Model</th><th>Payable</th><th>Repayment Status</th></tr>
    <?php
        foreach($repaymentSchema As $rs){
    ?>
        <tr>
            <td>
            <?php
                echo $rs->paymentModel->paymentPlanItem->name;
                $installment_no = ($rs->installment_number == 0) ? '' : ': '.$rs->installment_number;
                echo " $installment_no";
                
                
            ?>
            </td>
            
            <td>
                <?php echo utilsComponents::formatCurrency($rs->paymentModel->total_payable).'<br>'; ?>
            </td>
            
            <td>
            <?php
                $repayment_settlement = RepaymentSchemaSettlement::model()
                                            ->findAllByAttributes(
                                                    array(
                                                        'deleted'=>0,
                                                        'repayment_schema_id'=>$rs->id,
                                                        )
                                                    );
                if($repayment_settlement){
                    echo '<table class="subtable">';
                    echo '<tr><th>Receipt#</th><th>Amount</th><th>Old receipt#</th><th>Date</th><th>Status</th></tr>';
                    foreach ($repayment_settlement As $rstlmnt){
                        $receipt = PaymentReceiptsMaster::model()->findByPk($rstlmnt->payment_receipt_master_id);
                        $ReceiptMappingObj = PaymentReceiptsImportsMapping::model()->findByAttributes(array('new_receipt_no'=>$rstlmnt->payment_receipt_master_id));
                        echo '<tr>';
                        echo '<td>'.$rstlmnt->payment_receipt_master_id.'</td>';
                        echo '<td>'.utilsComponents::formatCurrency($receipt->amount_paid).'</td>';
                        
                        if(sizeof($ReceiptMappingObj) > 0){
                            echo '<td>'.$ReceiptMappingObj->old_receipt_no.'</td>';
                        }else{
                            echo '<td>-</td>';
                        }
                        
                        if($ReceiptMappingObj){
                            echo '<td>'.$ReceiptMappingObj->oldReceiptNo->receiptdate.'</td>';
                        }else{
                            echo '<td>-</td>';
                        }
                        
                        if($rstlmnt->paid_full){
                            echo '<td>Paid Full</td>';
                            
                        }else{
                            echo '<td>-</td>';
                        }
                        
                        
                        
                        echo '</tr>';
                        
                    }
                    echo '</table>';
                }
            ?>
            
                
            </td>
            
            
        
        </tr>
    <?php
        }
    ?>
    
</table>
</p>


<?php if(!empty($payment_summary)){ ?>
<table class="table">
    <?php foreach($payment_summary As $k=>$v){ ?>
    <tr>
        <td><strong><?= ucfirst($k); ?></strong></td><td><?= utilsComponents::formatCurrency($v); ?></td>
    </tr>
    <?php } ?>
</table>
<?php } ?>


<?php
echo CHtml::link('<i class="fa fa-print"></i>', array('payments/print','id'=>$customer_id,'facility_master_id'=>$facility->id));
?>