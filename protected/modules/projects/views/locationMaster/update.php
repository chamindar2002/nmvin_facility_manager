<?php
/* @var $this LocationMasterController */
/* @var $model LocationMaster */

$this->breadcrumbs=array(
	'Location Masters'=>array('index'),
	$model->locationcode=>array('view','id'=>$model->locationcode),
	'Update',
);

/*$this->menu=array(
	array('label'=>'List LocationMaster', 'url'=>array('index')),
	array('label'=>'Create LocationMaster', 'url'=>array('create')),
	array('label'=>'View LocationMaster', 'url'=>array('view', 'id'=>$model->locationcode)),
	array('label'=>'Manage LocationMaster', 'url'=>array('admin')),
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