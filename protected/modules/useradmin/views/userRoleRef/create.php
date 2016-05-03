<?php
/* @var $this UserRoleRefController */
/* @var $model UserRoleRef */

$this->breadcrumbs=array(
	'User Role Refs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List', 'url'=>array('index')),
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>


<?php $this->renderPartial('_form', array('model'=>$model)); ?>