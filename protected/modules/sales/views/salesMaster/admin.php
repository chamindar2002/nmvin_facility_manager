<?php
/* @var $this SalesMasterController */
/* @var $model SalesDetails */

$this->breadcrumbs=array(
	'Sales Details'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List SalesDetails', 'url'=>array('index')),
	array('label'=>'Create SalesDetails', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#sales-details-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Sales Details</h1>

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
	'id'=>'sales-details-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'refno',
		'customercode',
		'locationcode',
		'projectcode',
		'blockrefnumber',
		'payplanrefno',
		/*
		'nofinstallments',
		'description',
		'installamount',
		'totalpayable',
		'paymentduedate',
		'agrementstartdate',
		'agrementfinishdate',
		'saletype',
		'salerightoff_amt',
		'salerightoff_status',
		'salerightoff_comment',
		'defaulted',
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
