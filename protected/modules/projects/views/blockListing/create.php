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
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>

<h1>Create ProjectDetails</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>