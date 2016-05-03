<?php
/* @var $this PaymentPlanItemsController */
/* @var $model PaymentPlanItems */

$this->breadcrumbs=array(
	'Payment Plan Items'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List', 'url'=>array('index')),
	array('label'=>'Add', 'url'=>array('create')),
	//array('label'=>'View PaymentPlanItems', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>

<!--<h1>Update PaymentPlanItems <?php echo $model->id; ?></h1>-->

<?php $this->renderPartial('_form', array('model'=>$model)); ?>