<?php
/* @var $this CustomerdetailsController */
/* @var $model Customerdetails */

$this->breadcrumbs=array(
	'Customerdetails'=>array('index'),
	'Create',
);

/*$this->menu=array(
	array('label'=>'List Customerdetails', 'url'=>array('index')),
	array('label'=>'Manage Customerdetails', 'url'=>array('admin')),
);*/

$this->menu=array(
	array('label'=>'List', 'url'=>array('index')),
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>