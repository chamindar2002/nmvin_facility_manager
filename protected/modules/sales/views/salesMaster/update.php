<?php
/* @var $this SalesMasterController */
/* @var $model SalesDetails */

$this->breadcrumbs=array(
	'Sales Details'=>array('index'),
	$model->refno=>array('view','id'=>$model->refno),
	'Update',
);

/*$this->menu=array(
	array('label'=>'List SalesDetails', 'url'=>array('index')),
	array('label'=>'Create SalesDetails', 'url'=>array('create')),
	array('label'=>'View SalesDetails', 'url'=>array('view', 'id'=>$model->refno)),
	array('label'=>'Manage SalesDetails', 'url'=>array('admin')),
);*/

$this->menu=array(
	array('label'=>'List', 'url'=>array('index')),
	array('label'=>'Add', 'url'=>array('create')),
	array('label'=>'View', 'url'=>array('view', 'id'=>$model->refno)),
	array('label'=>'Manage', 'url'=>array('admin')),
        array('label'=>'Delete', 'url'=>array('delete', 'id'=>$model->refno)),
);
?>

<h1>Update SalesDetails <?php echo $model->refno; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>