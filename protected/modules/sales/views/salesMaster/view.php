<?php
/* @var $this SalesMasterController */
/* @var $model SalesDetails */

$this->breadcrumbs=array(
	'Sales Details'=>array('index'),
	$model->refno,
);

$this->menu=array(
	array('label'=>'List SalesDetails', 'url'=>array('index')),
	array('label'=>'Create SalesDetails', 'url'=>array('create')),
	array('label'=>'Update SalesDetails', 'url'=>array('update', 'id'=>$model->refno)),
	array('label'=>'Delete SalesDetails', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->refno),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SalesDetails', 'url'=>array('admin')),
);
?>

<h1>View SalesDetails #<?php echo $model->refno; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'refno',
		'customercode',
		'locationcode',
		'projectcode',
		'blockrefnumber',
		'payplanrefno',
		'nofinstallments',
		'description',
		'installamount',
		'totalpayable',
		'paymentduedate',
		'agrementstartdate',
		'agrementfinishdate',
		'saletype',
		'salerightoff_amt',
		'salerightoff_status',
		'salerightoff_comment',
		'defaulted',
		'deleted',
		'addedby',
		'addeddate',
		'addedtime',
		'lastmodifiedby',
		'lastmodifieddate',
		'lastmodifiedtime',
		'deletedby',
		'deleteddate',
		'deletedtime',
	),
)); ?>
