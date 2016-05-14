<?php
/* @var $this CustomerdetailsController */
/* @var $model Customerdetails */
/* @var $form CActiveForm */
?>
<style>
    .cust-dls{
        border:1px solid #ccc;
        width:48%;
        padding: 5px;
    }
    
    .left_box{
        float: left;
    }
    
    .right_box{
        float:left;
        margin-left: 2px;
        
    }
</style>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'customerdetails-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

<div class="cust-dls left_box">
    <p class="note">Fields with <span class="required">*</span> are required.</p>
    
    <div class="form-group">
	<?php echo $form->labelEx($model,'title'); ?>
	<?php echo $form->textField($model,'title',array('size'=>10,'maxlength'=>10, 'class'=>'form-control input-sm')); ?>
	<?php echo $form->error($model,'title'); ?>
    </div>
    
    <div class="form-group">
        <?php echo $form->labelEx($model,'familyname'); ?>
	<?php echo $form->textField($model,'familyname',array('size'=>60,'maxlength'=>100, 'class'=>'form-control input-sm')); ?>
	<?php echo $form->error($model,'familyname'); ?>
    </div>
    
    <div class="form-group">
        <?php echo $form->labelEx($model,'firstname'); ?>
	<?php echo $form->textField($model,'firstname',array('size'=>60,'maxlength'=>100, 'class'=>'form-control input-sm')); ?>
	<?php echo $form->error($model,'firstname'); ?>
        
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model,'passportno'); ?>
	<?php echo $form->textField($model,'passportno',array('size'=>60,'maxlength'=>100, 'class'=>'form-control input-sm')); ?>
	<?php echo $form->error($model,'passportno'); ?>
        <p>Please make sure the NIC/Passport no. is correct before saving.
Once Saved NIC/Passport no. cannot be modified</p>
    </div>
    <div class="form-group">
        
    </div>
    <div class="form-group">
        
    </div>
    <div class="form-group">
        
    </div>
    <div class="form-group">
        
    </div>
    <div class="form-group">
        
    </div>
    <div class="form-group">
        
    </div>
    <div class="form-group">
        
    </div>
    
</div>  
<div class="cust-dls right_box">
    <h2>B</h2>
</div>



<div class="form">



	

	<?php echo $form->errorSummary($model); ?>


	<div class="row">
		
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'addressline1'); ?>
		<?php echo $form->textField($model,'addressline1',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'addressline1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'addressline2'); ?>
		<?php echo $form->textField($model,'addressline2',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'addressline2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'postcode'); ?>
		<?php echo $form->textField($model,'postcode',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'postcode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'country'); ?>
		<?php echo $form->textField($model,'country',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'country'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Skype'); ?>
		<?php echo $form->textField($model,'Skype',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'Skype'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'landline'); ?>
		<?php echo $form->textField($model,'landline',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'landline'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mobile'); ?>
		<?php echo $form->textField($model,'mobile',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'mobile'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'workphone'); ?>
		<?php echo $form->textField($model,'workphone',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'workphone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fax'); ?>
		<?php echo $form->textField($model,'fax',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'fax'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'proffession'); ?>
		<?php echo $form->textField($model,'proffession',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'proffession'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gender'); ?>
		<?php echo $form->textField($model,'gender',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'gender'); ?>
	</div>

	<div class="row">
		
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sladdressline1'); ?>
		<?php echo $form->textField($model,'sladdressline1',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'sladdressline1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sladdressline2'); ?>
		<?php echo $form->textField($model,'sladdressline2',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'sladdressline2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sladdressline3'); ?>
		<?php echo $form->textField($model,'sladdressline3',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'sladdressline3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sllandline'); ?>
		<?php echo $form->textField($model,'sllandline',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'sllandline'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'slmobile'); ?>
		<?php echo $form->textField($model,'slmobile',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'slmobile'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'slcontactperson'); ?>
		<?php echo $form->textField($model,'slcontactperson',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'slcontactperson'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'onlineuserid'); ?>
		<?php echo $form->textField($model,'onlineuserid'); ?>
		<?php echo $form->error($model,'onlineuserid'); ?>
	</div>


	<div class="row buttons">
		
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Add' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->