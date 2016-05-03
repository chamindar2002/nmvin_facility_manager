<?php
/* @var $this TempReceiptController */
/* @var $model TempReceipt */

$this->breadcrumbs=array(
	'Temp Receipts'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TempReceipt', 'url'=>array('index')),
	array('label'=>'Create TempReceipt', 'url'=>array('create')),
	array('label'=>'Update TempReceipt', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TempReceipt', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TempReceipt', 'url'=>array('admin')),
);
?>

<h1>View TempReceipt #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'facility_id',
		'amount',
	),
)); ?>
