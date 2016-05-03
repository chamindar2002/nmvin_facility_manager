<?php
/* @var $this TempReceiptController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Temp Receipts',
);

$this->menu=array(
	array('label'=>'Create TempReceipt', 'url'=>array('create')),
	array('label'=>'Manage TempReceipt', 'url'=>array('admin')),
);
?>

<h1>Temp Receipts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
