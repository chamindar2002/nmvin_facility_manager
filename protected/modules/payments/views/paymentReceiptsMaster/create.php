<?php
/* @var $this PaymentReceiptsMasterController */
/* @var $model PaymentReceiptsMaster */

$this->breadcrumbs=array(
	'Payment Receipts Masters'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List', 'url'=>array('index')),
	//array('label'=>'Manage', 'url'=>array('admin')),
);
?>

<!--<h1>Create PaymentReceiptsMaster</h1>-->

<?php $this->renderPartial('_form', array('model'=>$model,'fm'=>$fm,'payment_types'=>$payment_types,'banks'=>$banks,)); ?>
