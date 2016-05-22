<?php
/* @var $this BlockListingController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Project Details',
);

$this->menu=array(
	array('label'=>'Add', 'url'=>array('create')),
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'project-details-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'refno',
		//'locationcode',
		'project_name',
		//		array(
//			'name'=>'customercode',
//			'value'=>'$data->customerDetails->firstname',
//			//'filter' => CHtml::listData(Customerdetails::getCustomers(), 'customercode', 'fullName'),
//		),
		//'customercode',
		//'housecatcode',
		'blocknumber',
		'customercode',
		'firstname',
		'familyname',
		'passportno',
		/*
		'blocksize',
		'blockprice',
		'reservedate',
		'reservestatus',
		'paymentmethod',
		'duedate',
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
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
));


?>