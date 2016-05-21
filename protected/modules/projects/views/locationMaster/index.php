<?php
/* @var $this LocationMasterController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Location Masters',
);

$this->menu=array(
	array('label'=>'Add', 'url'=>array('create')),
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>
<?php
//$this->widget('zii.widgets.CListView', array(
//	'dataProvider'=>$dataProvider,
//	'itemView'=>'_view',
//)); ?>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'location-master-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'locationcode',
		'locationname',
		'locationcity',
//		'deleted',
//		'addedby',
//		'addeddate',;
		/*
		'addedtime',
		'lastmodifiedby',
		'lastmodifieddate',
		'lastmodifiedtime',
		'deletedby',
		'deleteddate',
		'deletedtime',
		*/
		array(
			'class'=>'CButtonColumn',
                         'template'=>'{update}',
		),
	),
)); ?>
