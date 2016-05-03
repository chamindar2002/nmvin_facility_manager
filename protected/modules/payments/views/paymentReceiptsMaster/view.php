<?php
/* @var $this PaymentReceiptsMasterController */
/* @var $model PaymentReceiptsMaster */

$this->breadcrumbs=array(
	'Payment Receipts Masters'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List', 'url'=>array('index')),
	array('label'=>'Add', 'url'=>array('create')),
	array('label'=>'Update PaymentReceiptsMaster', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PaymentReceiptsMaster', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>

<h1>View PaymentReceiptsMaster #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'facility_master_id',
		'customercode',
		'customer_name',
		'transaction_id',
		'deleted',
		'addedby',
		'created_at',
		'updated_at',
	),
)); ?>
