<?php
/* @var $this BlockListingController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Project Details',
);

$this->menu=array(
	array('label'=>'Create ProjectDetails', 'url'=>array('create')),
	array('label'=>'Manage ProjectDetails', 'url'=>array('admin')),
);
?>

<h1>Project Details</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
