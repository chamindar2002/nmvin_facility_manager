<?php
/* @var $this CustomerdetailsController */
/* @var $model Customerdetails */

$this->breadcrumbs=array(
	'Customerdetails'=>array('index'),
	$model->firstname=>array('view','id'=>$model->customercode),
	'Update',
);

/*$this->menu=array(
	array('label'=>'List Customerdetails', 'url'=>array('index')),
	array('label'=>'Create Customerdetails', 'url'=>array('create')),
	array('label'=>'View Customerdetails', 'url'=>array('view', 'id'=>$model->customercode)),
	array('label'=>'Manage Customerdetails', 'url'=>array('admin')),
);*/


if(User::_can(['manager','admin'], true)){
	$this->menu=array(
		array('label'=>'List', 'url'=>array('index')),
		array('label'=>'Add', 'url'=>array('create')),
		array('label'=>'Manage', 'url'=>array('admin')),

	);
}else{


	$this->menu=array(
		array('label'=>'List', 'url'=>array('index')),
		array('label'=>'Add', 'url'=>array('create')),


	);
}


?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>