<?php
/* @var $this ProjectMasterController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Project Masters',
);

$this->menu=array(
	array('label'=>'Add', 'url'=>array('create')),
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'project-master-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'projectcode',
		//'locationcode',
                 array(
                  'name'=>'locationcode',
                  'value'=>'$data->locationDetails->locationname',
                  'filter' => CHtml::listData(LocationMaster::getLocations(), 'locationcode', 'locationname'),
                ),
		'projectname',
		'nofblocks',
		//'deleted',
		//'addedby',
		/*
		'addeddate',
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


