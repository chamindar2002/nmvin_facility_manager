<?php
/* @var $this CustomerdetailsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Customerdetails',
);

$this->menu=array(
	array('label'=>'Add', 'url'=>array('create')),
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'customerdetails-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'customercode',
                'passportno',
		//'title',
		'familyname',
		'firstname',
		'addressline1',
		'addressline2',
		/*
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
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
