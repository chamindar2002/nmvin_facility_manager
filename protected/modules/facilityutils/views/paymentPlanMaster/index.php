<?php
/* @var $this PaymentPlanMasterController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Payment Plan Masters',
);

$this->menu=array(
	array('label'=>'Add', 'url'=>array('create')),
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>

<!--<h1>Payment Plan Masters</h1>-->


<?php

$this->widget('zii.widgets.grid.CGridView', array(

    'dataProvider'=>$dataProvider,

    'columns'=>array(
        //'id',          // display the 'title' attribute
        'name',
        
        array(
            'name'  => 'Payment Models',
            'value' => 'CHtml::link("View",Yii::app()->createUrl("facilityutils/paymentModel/index",array("id"=>$data->id)))',
            'type'  => 'raw',
        ),
                
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
));*/ ?>
