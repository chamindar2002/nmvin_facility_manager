<?php
/* @var $this FacilityMasterController */
/* @var $model FacilityMaster */

//echo '<pre>';
//var_dump($saleDetails);
//echo '</pre>';

$this->breadcrumbs=array(
	'Facility Masters'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);


$customer_code = 0;

if(key_exists(0, $saleDetails)){
    $customer_code = $saleDetails[0]->customercode;
}elseif(key_exists(0, $house_transfers)){
   $customer_code = $house_transfers[0]->customercode_previous;
}

//echo $customer_code;

if($customer_code != 0){
    $this->menu=array(
            array('label'=>'List', 'url'=>array('index')),
            array('label'=>'Add', 'url'=>array('create')),
            //array('label'=>'View FacilityMaster', 'url'=>array('view', 'id'=>$model->id)),
            array('label'=>'Manage', 'url'=>array('admin')),
            array('label'=>'Delete', 'url'=>array('viewdelete','id'=>$model->id)),
            array('label'=>'Change Payment Plan', 'url'=>array('AlterFacilityPayplan/index','id'=>$model->id,'customer'=>$customer_code)),
            array('label'=>'Transfer', 'url'=>array('FacilityTransfer/index','id'=>$model->id,'customer'=>$customer_code)),
            array('label'=>'Refund', 'url'=>array('FacilityRefund/index','id'=>$model->id,'customer'=>$customer_code)),

    );
}
?>

<!--<h1>Update FacilityMaster <?php echo $model->id; ?></h1>-->

<?php $this->renderPartial('_form', array('model'=>$model,'saleDetails'=>$saleDetails,'facility_arr'=>$facility_arr)); ?>

