<?php
/* @var $this FacilityMasterController */
/* @var $model FacilityMaster */

$this->breadcrumbs=array(
	'Facility Masters'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List', 'url'=>array('index')),
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>

<!--<h1>Create FacilityMaster</h1>-->



<?php $this->renderPartial('_form', array(
                                            'model'=>$model,
                                            'saleDetails'=>$saleDetails,
                                            'facility_arr'=>$facility_arr,)); ?>