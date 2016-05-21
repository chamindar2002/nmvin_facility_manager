<?php
/* @var $this ProjectMasterController */
/* @var $model ProjectMaster */

$this->breadcrumbs=array(
	'Project Masters'=>array('index'),
	'Create',
);

/*$this->menu=array(
	array('label'=>'List ProjectMaster', 'url'=>array('index')),
	array('label'=>'Manage ProjectMaster', 'url'=>array('admin')),
);*/

$this->menu=array(
	array('label'=>'List', 'url'=>array('index')),
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>