<?php
/* @var $this PaymentPlanMasterController */
/* @var $model PaymentPlanMaster */

$this->breadcrumbs=array(
	'Payment Plan Masters'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List', 'url'=>array('index')),
	array('label'=>'Add', 'url'=>array('create')),
	array('label'=>'Update PaymentPlanMaster', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PaymentPlanMaster', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>

<h1>View PaymentPlanMaster #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'created_at',
		'updated_at',
		'is_active',
		'deleted',
	),
)); ?>
