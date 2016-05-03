<?php
/* @var $this PaymentReceiptsMasterController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Payment Receipts Masters',
);

$this->menu=array(
	array('label'=>'Add', 'url'=>array('create')),
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>

<!--<h1>Payment Receipts Masters</h1>-->

<?php /*$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); */?>



<?php

$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'receipt-master-grid',
    'dataProvider'=>$dataProvider,
    //'filter'=>$model,
    'columns'=>array(
        'id',          // display the 'title' attribute
        'transaction_id',
        'customer_name',
        'amount_paid',
        
        array(  

            'class'=>'CButtonColumn',
            //'template'=>'{view}{update}{delete}',
            'template'=>'{view}',
        ),
        /*array(
            'name'=>'customer_id',
            'value'=>'$data->customerDetails->firstname',
        ),*/
        
         

    ),

));

?>
