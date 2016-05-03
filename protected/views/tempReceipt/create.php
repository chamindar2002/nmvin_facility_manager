<?php
/* @var $this TempReceiptController */
/* @var $model TempReceipt */

$this->breadcrumbs=array(
	'Temp Receipts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TempReceipt', 'url'=>array('index')),
	array('label'=>'Manage TempReceipt', 'url'=>array('admin')),
);
?>

<h1>Create TempReceipt</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>