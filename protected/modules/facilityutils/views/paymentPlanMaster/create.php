<?php
/* @var $this PaymentPlanMasterController */
/* @var $model PaymentPlanMaster */

$this->breadcrumbs=array(
	'Payment Plan Masters'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List', 'url'=>array('index')),
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>

<!--<h1>Create PaymentPlanMaster</h1>-->

<?php $this->renderPartial('_form', array('model'=>$model)); ?>