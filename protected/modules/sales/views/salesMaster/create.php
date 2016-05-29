<?php
/* @var $this SalesMasterController */
/* @var $model SalesDetails */

$this->breadcrumbs=array(
	'Sales Details'=>array('index'),
	'Create',
);

/*$this->menu=array(
	array('label'=>'List SalesDetails', 'url'=>array('index')),
	array('label'=>'Manage SalesDetails', 'url'=>array('admin')),
);*/

$this->menu=array(
	array('label'=>'List', 'url'=>array('index')),
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>

<h1>Create SalesDetails</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>