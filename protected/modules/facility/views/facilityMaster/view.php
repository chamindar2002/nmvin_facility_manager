<?php
/* @var $this FacilityMasterController */
/* @var $model FacilityMaster */

$this->breadcrumbs=array(
	'Facility Masters'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List', 'url'=>array('index')),
	array('label'=>'Add', 'url'=>array('create')),
	array('label'=>'Update FacilityMaster', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete FacilityMaster', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>

<h1>View FacilityMaster #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'customer_id',
		'payment_plan_master_id',
		'created_at',
		'updated_at',
		'is_active',
		'deleted',
	),
)); ?>
