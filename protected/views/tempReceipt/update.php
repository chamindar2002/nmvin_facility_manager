<?php
/* @var $this TempReceiptController */
/* @var $model TempReceipt */

$this->breadcrumbs=array(
	'Temp Receipts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TempReceipt', 'url'=>array('index')),
	array('label'=>'Create TempReceipt', 'url'=>array('create')),
	array('label'=>'View TempReceipt', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TempReceipt', 'url'=>array('admin')),
);
?>

<h1>Update TempReceipt <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>