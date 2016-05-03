<?php
/* @var $this PaymentPlanItemsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Payment Plan Items',
);

$this->menu=array(
	array('label'=>'Add', 'url'=>array('create')),
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>

<!--<h1>Payment Plan Items</h1>-->


<?php



$this->widget('zii.widgets.grid.CGridView', array(

    'dataProvider'=>$dataProvider,

    'columns'=>array(
        //'id',          // display the 'title' attribute
        'name',
        'sort_order',
        
        array(  

            'class'=>'CButtonColumn',
            'template'=>'{view}{update}',
        ),

         

    ),

));

?>

<?php /*$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); */ ?>
