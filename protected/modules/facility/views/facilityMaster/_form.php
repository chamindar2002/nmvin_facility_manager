<?php
/* @var $this FacilityMasterController */
/* @var $model FacilityMaster */
/* @var $form CActiveForm */

//print_r(count($facility_arr));
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'facility-master-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
    
        <div class="form-group">
            <?php
            $this->renderPartial('_msearch',array('form'=>$form,'model'=>$model));
            ?>
        </div>
        

<!--	<div class="form-group">-->
		<?php //echo $form->labelEx($model,'customer_id'); ?>
		<?php 
                //echo $form->textField($model,'customer_id');
                //echo $form->dropDownList($model, 'customer_id',  CHtml::listData(Customerdetails::model()->findAll(), 'customercode', 'familyname'), array('prompt' => '','class'=>'form-control input-sm'));
                ?>
		<?php //echo $form->error($model,'customer_id'); ?>
<!--	</div>-->

	<div class="form-group">
		<?php echo $form->labelEx($model,'payment_plan_master_id'); ?>
		<?php
                //echo $form->textField($model,'payment_plan_master_id');
                if($model->isNewRecord){
                    //echo $form->dropDownList($model, 'payment_plan_master_id',  CHtml::listData(PaymentPlanMaster::model()->findAll(), 'id', 'name'), array('prompt' => '','class'=>'form-control input-sm'));
                    echo $form->dropDownList($model, 'payment_plan_master_id', PaymentPlanMaster::model()->listPaymentPlans($model->customer_id), array('prompt' => '','class'=>'form-control input-sm'));
                }else{
                    echo CHtml::telField('dummypayment_plan_master_id',$model->paymentPlanMaster->name, array('readonly'=>'readonly','class'=>'form-control input-sm'));
                    echo $form->hiddenField($model,'payment_plan_master_id');
                }
                ?>
		<?php echo $form->error($model,'payment_plan_master_id'); ?>
	</div>

        <div class="form-group">
                <?php echo $form->labelEx($model,'sales_ref_no'); ?>
            <ul>
                <?php 
                if(sizeof($saleDetails) > 0){
                    foreach($saleDetails As $sd){
                        //echo $sd->blockrefnumber.'->'.$sd->blockDetails->blocknumber.' ['.$sd->projectMaster->projectname.'] '.'<br>';
                        
                        echo '<li>';
                        /*
                         * check if facility already exists for the sale.
                         */
                        if(!array_key_exists($sd->refno, $facility_arr)){
                            echo $form->radioButton($model, 'sales_ref_no', array('value' => $sd->refno,'uncheckValue'=>null,'class'=>'')) . 
                                $sd->blockrefnumber.'->'.$sd->location->locationname.'->'.$sd->blockDetails->blocknumber.' ['.$sd->projectMaster->projectname.'] ';
                        }else{
                            echo 'facilty exits -> '.$sd->blockrefnumber.'->'.$sd->blockDetails->blocknumber.' ['.$sd->projectMaster->projectname.'] ';
                        }
                        echo '</li>';
                    }
                    //$form->radioButton($model, 'voice_greet_type', array('value' => UserProfile::DEFAULT_GREET,'uncheckValue'=>null)) . ' Default Greeting';
                }else{
                    echo 'No records to display';
                } 
                ?>
            </ul>
                <?php echo $form->error($model,'sales_ref_no'); ?>
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
		<?php echo $form->labelEx($model,'is_active'); ?>
		<?php echo $form->textField($model,'is_active'); ?>
		<?php echo $form->error($model,'is_active'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'deleted'); ?>
		<?php echo $form->textField($model,'deleted'); ?>
		<?php echo $form->error($model,'deleted'); ?>
	</div>-->

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary btn-lg btn-block')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->


<!--<h2>Sale Details</h2>-->
<?php
   //var_dump($saleDetails);
    /*foreach($saleDetails As $sd){
        echo $sd->blockrefnumber.'->'.$sd->blockDetails->blocknumber.' ['.$sd->projectMaster->projectname.'] '.'<br>';
    }*/
?>