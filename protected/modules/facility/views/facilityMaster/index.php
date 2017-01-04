<?php
/* @var $this FacilityMasterController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Facility Masters',
);

$this->menu=array(
	array('label'=>'Add', 'url'=>array('create')),
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>

<!--<h1>Facility Masters</h1>-->

<?php /*$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); */ ?>



<?php

$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'facility-master-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        //'id',          // display the 'title' attribute
        'customer_id',
        /*array(
            'name'=>'customer_id',
            'value'=>'$data->customerDetails->firstname',
        ),*/
        
        array(
                  'name'=>'id',
                  'value'=>'$data->customerDetails->firstname." ".$data->customerDetails->familyname',
                  'filter' => CHtml::listData(Customerdetails::getCustomers(), 'customercode', 'fullName'),
                ),

        array(
            'name'=>'payment_plan_master_id',
            'value'=>'$data->paymentPlanMaster->name'
        ),
                
        array(  

            'class'=>'CButtonColumn',
            'template'=>'{view}{update}',
        ),

         

    ),

));

?>
