<?php
/* @var $this CustomerdetailsController */
/* @var $model Customerdetails */

$this->breadcrumbs=array(
	'Customerdetails'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Customerdetails', 'url'=>array('index')),
	array('label'=>'Create Customerdetails', 'url'=>array('create')),
	array('label'=>'Update Customerdetails', 'url'=>array('update', 'id'=>$model->customercode)),
	array('label'=>'Delete Customerdetails', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->customercode),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Customerdetails', 'url'=>array('admin')),
);
?>

<h1>View Customerdetails #<?php echo $model->customercode; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'customercode',
		'title',
		'familyname',
		'firstname',
		'addressline1',
		'addressline2',
		'postcode',
		'country',
		'email',
		'Skype',
		'landline',
		'mobile',
		'workphone',
		'fax',
		'proffession',
		'gender',
		'passportno',
		'sladdressline1',
		'sladdressline2',
		'sladdressline3',
		'sllandline',
		'slmobile',
		'slcontactperson',
		'onlineuserid',
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
