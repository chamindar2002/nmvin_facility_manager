<?php
/* @var $this LocationMasterController */
/* @var $model LocationMaster */

$this->breadcrumbs=array(
	'Location Masters'=>array('index'),
	$model->locationcode,
);

$this->menu=array(
	array('label'=>'List LocationMaster', 'url'=>array('index')),
	array('label'=>'Create LocationMaster', 'url'=>array('create')),
	array('label'=>'Update LocationMaster', 'url'=>array('update', 'id'=>$model->locationcode)),
	array('label'=>'Delete LocationMaster', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->locationcode),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage LocationMaster', 'url'=>array('admin')),
);
?>

<h1>View LocationMaster #<?php echo $model->locationcode; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'locationcode',
		'locationname',
		'locationcity',
		'deleted',
		'addedby',
		'addeddate',
		'addedtime',
		'lastmodifiedby',
		'lastmodifieddate',
		'lastmodifiedtime',
		'deletedby',
		'deleteddate',
		'deletedtime',
	),
)); ?>
