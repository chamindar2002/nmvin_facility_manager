<?php
/* @var $this PaymentModelController */
/* @var $model PaymentModel */

$this->breadcrumbs=array(
	'Payment Models'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PaymentModel', 'url'=>array('index','id'=>$model->payment_plan_master_id)),
	array('label'=>'Create PaymentModel', 'url'=>array('create')),
	array('label'=>'View PaymentModel', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PaymentModel', 'url'=>array('admin')),
);
?>

<!--<h1>Update PaymentModel <?php echo $model->id; ?></h1>-->

<?php $this->renderPartial('_form', array('model'=>$model,'AvailablePaymentPlanItems'=>$AvailablePaymentPlanItems)); ?>