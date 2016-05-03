<?php
/* @var $this PaymentPlanItemsController */
/* @var $model PaymentPlanItems */

$this->breadcrumbs=array(
	'Payment Plan Items'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List', 'url'=>array('index')),
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>

<!--<h1>Create PaymentPlanItems</h1>-->

<?php $this->renderPartial('_form', array('model'=>$model)); ?>