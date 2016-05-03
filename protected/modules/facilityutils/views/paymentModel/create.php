<?php
/* @var $this PaymentModelController */
/* @var $model PaymentModel */

$this->breadcrumbs=array(
	'Payment Models'=>array('index'),
	'Create',
);

if($model->payment_plan_master_id){
    $this->menu=array(
            array('label'=>'List PaymentModel', 'url'=>array('index','id'=>$model->payment_plan_master_id)),
            array('label'=>'Manage PaymentModel', 'url'=>array('admin')),
    );  
}else{
     $this->menu=array(
           array('label'=>'Manage PaymentModel', 'url'=>array('admin')),
    );  
}
?>

<!--<h1>Create PaymentModel</h1>-->

<?php $this->renderPartial('_form', array('model'=>$model,'AvailablePaymentPlanItems'=>$AvailablePaymentPlanItems)); ?>