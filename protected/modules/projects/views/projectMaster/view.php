<?php
/* @var $this ProjectMasterController */
/* @var $model ProjectMaster */

$this->breadcrumbs=array(
	'Project Masters'=>array('index'),
	$model->projectcode,
);

$this->menu=array(
	array('label'=>'List ProjectMaster', 'url'=>array('index')),
	array('label'=>'Create ProjectMaster', 'url'=>array('create')),
	array('label'=>'Update ProjectMaster', 'url'=>array('update', 'id'=>$model->projectcode)),
	array('label'=>'Delete ProjectMaster', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->projectcode),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProjectMaster', 'url'=>array('admin')),
);
?>

<h1>View ProjectMaster #<?php echo $model->projectcode; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'projectcode',
		'locationcode',
		'projectname',
		'nofblocks',
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
