<?php
/* @var $this PaymentPlanMasterController */
/* @var $model PaymentPlanMaster */

$this->breadcrumbs=array(
	'Payment Plan Masters'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List', 'url'=>array('index')),
	array('label'=>'Add', 'url'=>array('create')),
	//array('label'=>'View PaymentPlanMaster', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>

<!--<h1>Update PaymentPlanMaster <?php echo $model->id; ?></h1>-->

<?php $this->renderPartial('_form', array('model'=>$model)); ?>