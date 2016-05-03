<?php
/* @var $this DuesController */

$this->breadcrumbs=array(
	'Dues',
);

$summary = array(
    'total_payable'=>0,
    'total_paid'=>0,
    'total_dues'=>0
)
?>
<!--<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>-->
<h3><?php echo urldecode(Yii::app()->getRequest()->getParam('location')); ?> (Dues Report)</h3>

<?php if($data) {?>

<table class="table table-striped">
    <tr>
        <th>Customer</th>
        <th>House #</th>
        <th>Payable</th>
        <th>Paid</th>
        <th>Due</th>
            
    </tr>
   <?php foreach($data As $d){ ?>
    
    <tr>
        <td><?php echo Customerdetails::model()->getFullName2($d->customer_id); ?></td>
         <td><?php echo $d->blocknumber; ?></td>
        <td><?php echo utilsComponents::formatCurrency(PaymentModel::model()->getTotalPayableByPplanMaster($d->payment_plan_master_id)); ?></td>
        <td><?php echo utilsComponents::formatCurrency(PaymentModel::model()->getTotalPaid($d->facility_master_id)); ?></td>
        <td align='right'><?php echo utilsComponents::formatCurrency(PaymentModel::model()->getTotalPayableByPplanMaster($d->payment_plan_master_id) - PaymentModel::model()->getTotalPaid($d->facility_master_id)); ?></td>
            
    </tr>
    
    <?php
    $summary['total_payable'] += PaymentModel::model()->getTotalPayableByPplanMaster($d->payment_plan_master_id);
    $summary['total_paid'] += PaymentModel::model()->getTotalPaid($d->facility_master_id);
    $summary['total_dues'] += PaymentModel::model()->getTotalPayableByPplanMaster($d->payment_plan_master_id) - PaymentModel::model()->getTotalPaid($d->facility_master_id);
    ?>

   <?php } ?> 

</table>
<?php } ?>

<p>
<h4>Summary</h4>
</p>
<table width='50%'>
    <tr><th>Total Payable</th><td align='right'><?= utilsComponents::formatCurrency($summary['total_payable']); ?></td></tr>
    <tr><th>Total Paid</th><td align='right'><?= utilsComponents::formatCurrency($summary['total_paid']); ?></td></tr>
    <tr><th>Total Dues</th><td align='right'><?= utilsComponents::formatCurrency($summary['total_dues']); ?></td></tr>
</table>
