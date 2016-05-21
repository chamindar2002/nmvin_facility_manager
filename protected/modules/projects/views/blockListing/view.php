<?php
/* @var $this BlockListingController */
/* @var $model ProjectDetails */

$this->breadcrumbs=array(
	'Project Details'=>array('index'),
	$model->refno,
);

$this->menu=array(
	array('label'=>'List ProjectDetails', 'url'=>array('index')),
	array('label'=>'Create ProjectDetails', 'url'=>array('create')),
	array('label'=>'Update ProjectDetails', 'url'=>array('update', 'id'=>$model->refno)),
	array('label'=>'Delete ProjectDetails', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->refno),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProjectDetails', 'url'=>array('admin')),
);
?>

<h1>View ProjectDetails #<?php echo $model->refno; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'refno',
		'locationcode',
		'projectcode',
		'customercode',
		'housecatcode',
		'blocknumber',
		'blocksize',
		'blockprice',
		'reservedate',
		'reservestatus',
		'paymentmethod',
		'duedate',
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
