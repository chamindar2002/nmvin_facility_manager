<?php
/* @var $this BlockListingController */
/* @var $model ProjectDetails */

$this->breadcrumbs=array(
	'Project Details'=>array('index'),
	$model->refno=>array('view','id'=>$model->refno),
	'Update',
);

/*$this->menu=array(
	array('label'=>'List ProjectDetails', 'url'=>array('index')),
	array('label'=>'Create ProjectDetails', 'url'=>array('create')),
	array('label'=>'View ProjectDetails', 'url'=>array('view', 'id'=>$model->refno)),
	array('label'=>'Manage ProjectDetails', 'url'=>array('admin')),
);*/

$this->menu=array(
	array('label'=>'List', 'url'=>array('index')),
	array('label'=>'Add', 'url'=>array('create')),
	array('label'=>'View', 'url'=>array('view', 'id'=>$model->refno)),
	array('label'=>'Manage', 'url'=>array('admin')),
        array('label'=>'Delete', 'url'=>array('delete', 'id'=>$model->refno)),
);
?>

<h1>Update ProjectDetails <?php echo $model->refno; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>