<?php
/* @var $this CustomerdetailsController */
/* @var $model Customerdetails */

$this->breadcrumbs=array(
	'Customerdetails'=>array('index'),
	$model->title=>array('view','id'=>$model->customercode),
	'Update',
);

/*$this->menu=array(
	array('label'=>'List Customerdetails', 'url'=>array('index')),
	array('label'=>'Create Customerdetails', 'url'=>array('create')),
	array('label'=>'View Customerdetails', 'url'=>array('view', 'id'=>$model->customercode)),
	array('label'=>'Manage Customerdetails', 'url'=>array('admin')),
);*/

$this->menu=array(
	array('label'=>'List', 'url'=>array('index')),
	array('label'=>'Add', 'url'=>array('create')),
	array('label'=>'View', 'url'=>array('view', 'id'=>$model->customercode)),
	array('label'=>'Manage', 'url'=>array('admin')),
        array('label'=>'Delete', 'url'=>array('delete', 'id'=>$model->customercode)),
);
?>

<h1>Update Customerdetails <?php echo $model->customercode; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>