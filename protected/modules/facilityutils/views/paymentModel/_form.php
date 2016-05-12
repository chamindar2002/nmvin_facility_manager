<?php
/* @var $this PaymentModelController */
/* @var $model PaymentModel */
/* @var $form CActiveForm */
 echo $model->getModelName();


?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'payment-model-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'payment_plan_master_id'); ?>
		<?php 
                //echo $form->textField($model,'payment_plan_master_id');
                if($model->isNewRecord){
                    echo $form->dropDownList($model, 'payment_plan_master_id', CHtml::listData(PaymentPlanMaster::model()->findAll(), 'id', 'name'), array('prompt' => '','class'=>'form-control input-sm'));
                }else{
                    echo CHtml::telField('dummy',$model->paymentPlanMaster->name,array('class'=>'form-control input-sm','readonly'=>'readonly'));
                    echo $form->hiddenField($model, 'payment_plan_master_id', array('readonly' => 'readonly','class'=>'form-control input-sm'));
                }
                ?>
		<?php echo $form->error($model,'payment_plan_master_id'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'payment_plan_item_id'); ?>
		<?php 
                //echo $form->textField($model,'payment_plan_item_id');
                /*if($model->isNewRecord){
                    echo $form->dropDownList($model, 'payment_plan_item_id', CHtml::listData(PaymentPlanItems::model()->findAll(), 'id', 'name'), array('prompt' => '','class'=>'form-control input-sm'));
                }else{
                    echo $form->dropDownList($model, 'payment_plan_item_id', $AvailablePaymentPlanItems, array('prompt' => '','class'=>'form-control input-sm'));
                }*/
                //if($model->is_installment_definer == 1){
                    //echo 'installment definer : '.$model->is_installment_definer;
                        //echo CHtml::telField('dummy',$model->paymentPlanItem->name,array('class'=>'form-control input-sm','readonly'=>'readonly'));
                        //echo $form->hiddenField($model, 'payment_plan_item_id', array('readonly' => 'readonly','class'=>'form-control input-sm'));
                    
               //}else{
                    echo $form->dropDownList($model, 'payment_plan_item_id', $AvailablePaymentPlanItems, array('prompt' => '','class'=>'form-control input-sm'));
                //}
                ?>
		<?php echo $form->error($model,'payment_plan_item_id'); ?>
	</div>
        
        <?php if($model->getModelName() == 'PaymentModelPaymentPlanItem'){ ?>
        
        <div class="form-group">
		<?php echo CHtml::label('Enforce Installment Definer',''); ?>
		<?php 
                if(isset($_GET['installment'])){
                     echo CHtml::checkBox('chk_enforce_installment_definer',array('checked'=>true));
                }else{
                    echo CHtml::checkBox('chk_enforce_installment_definer');
                }
                ?>
		
	</div>
        
        <?php } ?>

<!--	<div class="form-group">
		<?php echo $form->labelEx($model,'is_installment_definer'); ?>
		<?php echo $form->textField($model,'is_installment_definer'); ?>
		<?php echo $form->error($model,'is_installment_definer'); ?>
	</div>-->

        <?php if($model->getModelName() == 'PaymentModelInstallment'){ ?>
        
	<div class="form-group">
		<?php echo $form->labelEx($model,'no_of_installments'); ?>
		<?php echo $form->textField($model,'no_of_installments',array('class'=>'form-control input-sm')); ?>
		<?php echo $form->error($model,'no_of_installments'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'installment_amount'); ?>
		<?php echo $form->textField($model,'installment_amount',array('class'=>'form-control input-sm')); ?>
		<?php echo $form->error($model,'installment_amount'); ?>
	</div>
        
        <?php } ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'interest'); ?>
		<?php echo $form->textField($model,'interest',array('class'=>'form-control input-sm')); ?>
		<?php echo $form->error($model,'interest'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'tax'); ?>
		<?php echo $form->textField($model,'tax',array('class'=>'form-control input-sm')); ?>
		<?php echo $form->error($model,'tax'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'total_payable'); ?>
		<?php echo $form->textField($model,'total_payable',array('class'=>'form-control input-sm')); ?>
		<?php echo $form->error($model,'total_payable'); ?>
	</div>

<!--	<div class="form-group">
		<?php echo $form->labelEx($model,'created_at'); ?>
		<?php echo $form->textField($model,'created_at'); ?>
		<?php echo $form->error($model,'created_at'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'updated_at'); ?>
		<?php echo $form->textField($model,'updated_at'); ?>
		<?php echo $form->error($model,'updated_at'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'deleted'); ?>
		<?php echo $form->textField($model,'deleted'); ?>
		<?php echo $form->error($model,'deleted'); ?>
	</div>-->

        <div class="form-group">
		<?php echo $form->labelEx($model,'payment_sequence'); ?>
		<?php echo $form->textField($model,'payment_sequence',array('class'=>'form-control input-sm')); ?>
		<?php echo $form->error($model,'payment_sequence'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary btn-lg btn-block')); ?>
	</div>

<?php $this->endWidget(); ?>


</div><!-- form -->
