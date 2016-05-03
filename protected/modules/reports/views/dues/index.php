<?php
/* @var $this DuesController */

$this->breadcrumbs=array(
	'Dues',
);

if($projects){
    echo "<strong>Filter By:</strong><br/>";
    foreach($projects As $key=>$value){
?>

<ul>
    <li>
        <?php
            echo CHtml::link($value,array('Dues/index','lid'=>$key,'location'=>  urlencode($value)));
            if(Yii::app()->getRequest()->getParam('lid') == $key){
                echo '<i class="fa fa-check"></i>';
            }
         ?>
    </li>
</ul>
<?php
 
    }
}
?>
<!--<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>-->

<?php $this->widget('CLinkPager', array('pages' => $pages)); ?>
<p/>
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

   <?php } ?> 

</table>
<?php } ?>


<?php
echo CHtml::link('<i class="fa fa-print"></i>',
        array(
            'dues/print','lid'=>Yii::app()->getRequest()->getParam('lid'),
            'location'=>  Yii::app()->getRequest()->getParam('location')));

?>
<br/>
<?php $this->widget('CLinkPager', array('pages' => $pages)); ?>
