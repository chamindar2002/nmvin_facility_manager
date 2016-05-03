<?php
/* @var $this PaymentModelController */
/* @var $model PaymentModel */

$this->breadcrumbs=array(
	'Payment Models'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List PaymentModel', 'url'=>array('index')),
	array('label'=>'Create PaymentModel', 'url'=>array('create')),
	array('label'=>'Update PaymentModel', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PaymentModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PaymentModel', 'url'=>array('admin')),
);
?>

<h1>View PaymentModel #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'payment_plan_master_id',
		'payment_plan_item_id',
		'is_installment_definer',
		'no_of_installments',
		'installment_amount',
		'interest',
		'tax',
		'total_payable',
		'created_at',
		'updated_at',
		'deleted',
	),
)); ?>
