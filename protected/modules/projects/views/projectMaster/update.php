<?php
/* @var $this ProjectMasterController */
/* @var $model ProjectMaster */

$this->breadcrumbs=array(
	'Project Masters'=>array('index'),
	$model->projectcode=>array('view','id'=>$model->projectcode),
	'Update',
);

/*$this->menu=array(
	array('label'=>'List ProjectMaster', 'url'=>array('index')),
	array('label'=>'Create ProjectMaster', 'url'=>array('create')),
	array('label'=>'View ProjectMaster', 'url'=>array('view', 'id'=>$model->projectcode)),
	array('label'=>'Manage ProjectMaster', 'url'=>array('admin')),
);*/

$this->menu=array(
	array('label'=>'List', 'url'=>array('index')),
	array('label'=>'Add', 'url'=>array('create')),
	array('label'=>'View', 'url'=>array('view', 'id'=>$model->projectcode)),
	array('label'=>'Manage', 'url'=>array('admin')),
        array('label'=>'Delete', 'url'=>array('delete', 'id'=>$model->projectcode)),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>