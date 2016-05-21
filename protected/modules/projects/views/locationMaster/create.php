<?php
/* @var $this LocationMasterController */
/* @var $model LocationMaster */

$this->breadcrumbs=array(
	'Location Masters'=>array('index'),
	'Create',
);

/*$this->menu=array(
	array('label'=>'List LocationMaster', 'url'=>array('index')),
	array('label'=>'Manage LocationMaster', 'url'=>array('admin')),
);*/

$this->menu=array(
	array('label'=>'List', 'url'=>array('index')),
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>


<?php $this->renderPartial('_form', array('model'=>$model)); ?>