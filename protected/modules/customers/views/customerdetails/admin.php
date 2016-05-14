<?php
/* @var $this CustomerdetailsController */
/* @var $model Customerdetails */

$this->breadcrumbs=array(
	'Customerdetails'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Customerdetails', 'url'=>array('index')),
	array('label'=>'Create Customerdetails', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#customerdetails-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Customerdetails</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'customerdetails-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'customercode',
		'title',
		'familyname',
		'firstname',
		'addressline1',
		'addressline2',
		/*
		'postcode',
		'country',
		'email',
		'Skype',
		'landline',
		'mobile',
		'workphone',
		'fax',
		'proffession',
		'gender',
		'passportno',
		'sladdressline1',
		'sladdressline2',
		'sladdressline3',
		'sllandline',
		'slmobile',
		'slcontactperson',
		'onlineuserid',
		'deleted',
		'addedby',
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
		),
	),
)); ?>
