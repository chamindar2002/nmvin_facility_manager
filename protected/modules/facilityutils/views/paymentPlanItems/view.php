<?php
/* @var $this PaymentPlanItemsController */
/* @var $model PaymentPlanItems */

$this->breadcrumbs=array(
	'Payment Plan Items'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List', 'url'=>array('index')),
	array('label'=>'Add', 'url'=>array('create')),
	array('label'=>'Update PaymentPlanItems', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PaymentPlanItems', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>

<h1>View PaymentPlanItems #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'sort_order',
		'created_at',
		'updated_at',
		'is_active',
	),
)); ?>
