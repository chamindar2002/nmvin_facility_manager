


<h3>
    Collection Report
    <br>
    <?= "$from_date :: $to_date"; ?>
    
    
</h3>

<p>
<table class="table table-striped">
    <tr>
        <th>Receipt #</th>
        <th>Customer</th>
        <th>Receipt Date</th>
        <th>House</th>
        <th>Pay Method</th>
        <th>Bank</th>
        <th>Amount Paid</th>
        
    </tr>
<?php
if(sizeof($data) > 0){
    
    foreach($data As $d){
        
        //isset($receipt_user[$d->userRef->loginname]) ?  $receipt_user[$d->userRef->loginname] += $d->amount_paid : $receipt_user[$d->userRef->loginname] = 0;
        if(!isset($receipt_user[$d->addedby])){
            $receipt_user[$d->addedby] = 0;
        }
        
        $receipt_user[$d->addedby] += $d->amount_paid;
?>

    <tr>
        <td><?= $d->id;?></td>
        <td><?= $d->customer_name;?></td>
<!--        <td><?= $d->name_of_scheme;?></td>-->
        <td><?= utilsComponents::dateFormat(strtotime($d->receipt_date)); ?></td>
        <td><?= $d->house_number;?></td>
        <td><?= $d->payment_type; ?></td>
        <td><?= $d->bank_name; ?></td>
        <td style='text-align: right'><?= utilsComponents::formatCurrency($d->amount_paid);?></td>
    </tr>
    


<?php
    }

} else{ echo 'No records to display.';}?>

    <tr>
        <td colspan="6" style='text-align: right'><strong>Total</strong></td>
        <td style='text-align: right'><strong><?= utilsComponents::formatCurrency($total_paid); ?></strong></td>
    </tr>
</table>
</p>

<?php if(!empty($receipt_user)){ ?>
<table class="table">
    <?php foreach($receipt_user As $k=>$v){ ?>
    <tr>
        <td>
            <strong>
                <?php
                 echo ucfirst(User::model()->findByPk($k)->loginname);
                ?>
            </strong>
        </td><td><?= utilsComponents::formatCurrency($v); ?></td>
    </tr>
    <?php } ?>
</table>
<?php } ?>

<?php
echo CHtml::link('<i class="fa fa-print"></i>', array('collection/print','from_date'=>$from_date,'to_date'=>$to_date,'bank_id'=>$bank_id,'user_id'=>$user_id));
?>
