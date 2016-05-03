<?php
/* @var $this UserRoleRefController */
/* @var $model UserRoleRef */

$this->breadcrumbs=array(
	'User Role Refs'=>array('index'),
	$model->uid=>array('view','id'=>$model->uid),
	'Update',
);

$this->menu=array(
	array('label'=>'List', 'url'=>array('index')),
	array('label'=>'Add', 'url'=>array('create')),
	//array('label'=>'View UserRoleRef', 'url'=>array('view', 'id'=>$model->uid)),
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>



<?php $this->renderPartial('_form', array('model'=>$model)); ?>