<?php
/* @var $this BlockListingController */
/* @var $model ProjectDetails */

$this->breadcrumbs=array(
	'Project Details'=>array('index'),
	'Create',
);

/*$this->menu=array(
	array('label'=>'List ProjectDetails', 'url'=>array('index')),
	array('label'=>'Manage ProjectDetails', 'url'=>array('admin')),
);*/

$this->menu=array(
	array('label'=>'List', 'url'=>array('index')),
	//array('label'=>'Manage', 'url'=>array('admin')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model,'projects'=>$projects,'blockListdata'=>$blockListdata, 'projectMaster'=>$projectMaster)); ?>