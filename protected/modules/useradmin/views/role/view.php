<?php
/* @var $this RoleController */
/* @var $model Role */

$this->breadcrumbs=array(
	'Roles'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List', 'url'=>array('index')),
	array('label'=>'Add', 'url'=>array('create')),
	array('label'=>'Update Role', 'url'=>array('update', 'id'=>$model->rid)),
	array('label'=>'Delete Role', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->rid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'rid',
		'name',
		'description',
	),
)); ?>
