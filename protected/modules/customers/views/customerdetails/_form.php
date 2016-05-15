<?php
/* @var $this CustomerdetailsController */
/* @var $model Customerdetails */
/* @var $form CActiveForm */
?>
<style>
    .cust-dls{
        /*border:1px solid #ccc;*/
        width:48%;
        padding: 5px;
    }
    
    .left_box{
        float: left;
    }
    
    .right_box{
        float:left;
        margin-left: 10px;
        
    }
</style>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'customerdetails-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->errorSummary($model); ?>

<div class="cust-dls left_box">



    <p class="note">Fields with <span class="required">*</span> are required.</p>
    
    <div class="form-group">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->dropDownList($model, 'title', utilsComponents::getCutomerTitles(), array('class'=>'form-control input-sm')); ?>
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
		<?php if($model->isNewRecord){ ?>
			<?php echo $form->textField($model,'passportno',array('size'=>60,'maxlength'=>100, 'class'=>'form-control input-sm')); ?>
		<?php }else{ ?>
			<?php echo $form->textField($model,'passportno',array('size'=>60,'maxlength'=>100,'readonly'=>'readonly', 'class'=>'form-control input-sm')); ?>
		<?php } ?>
		<?php echo $form->error($model,'passportno'); ?>

		<?php if($model->isNewRecord){ ?>
        	<p class="bg-info small">Please make sure the NIC/Passport number is correct before saving. Once Saved NIC/Passport no. cannot be modified</p>
		<?php } ?>
    </div>
    <div class="form-group">
		<?php echo $form->labelEx($model,'addressline1'); ?>
		<?php echo $form->textField($model,'addressline1',array('size'=>60,'maxlength'=>100, 'class'=>'form-control input-sm')); ?>
		<?php echo $form->error($model,'addressline1'); ?>
    </div>
    <div class="form-group">
		<?php echo $form->labelEx($model,'addressline2'); ?>
		<?php echo $form->textField($model,'addressline2',array('size'=>60,'maxlength'=>100, 'class'=>'form-control input-sm')); ?>
		<?php echo $form->error($model,'addressline2'); ?>
    </div>
    <div class="form-group">
		<?php echo $form->labelEx($model,'postcode'); ?>
		<?php echo $form->textField($model,'postcode',array('size'=>20,'maxlength'=>20, 'class'=>'form-control input-sm')); ?>
		<?php echo $form->error($model,'postcode'); ?>
    </div>
    <div class="form-group">
		<?php echo $form->labelEx($model,'country'); ?>
		<?php echo $form->dropDownList($model, 'country', countries::getCountries(), array('class'=>'form-control input-sm')); ?>
		<?php echo $form->error($model,'country'); ?>
    </div>
    <div class="form-group">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100, 'class'=>'form-control input-sm')); ?>
		<?php echo $form->error($model,'email'); ?>
    </div>
    <div class="form-group">
		<?php echo $form->labelEx($model,'landline'); ?>
		<?php echo $form->textField($model,'landline',array('size'=>60,'maxlength'=>100, 'class'=>'form-control input-sm')); ?>
		<?php echo $form->error($model,'landline'); ?>
    </div>
    <div class="form-group">
		<?php echo $form->labelEx($model,'mobile'); ?>
		<?php echo $form->textField($model,'mobile',array('size'=>60,'maxlength'=>100, 'class'=>'form-control input-sm')); ?>
		<?php echo $form->error($model,'mobile'); ?>
    </div>
	<div class="form-group">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary btn-lg btn-block')); ?>
	</div>

    
</div>

<div class="cust-dls right_box">
	<div class="form-group">
		<?php echo $form->labelEx($model,'Skype'); ?>
		<?php echo $form->textField($model,'Skype',array('size'=>60,'maxlength'=>100, 'class'=>'form-control input-sm')); ?>
		<?php echo $form->error($model,'Skype'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'workphone'); ?>
		<?php echo $form->textField($model,'workphone',array('size'=>60,'maxlength'=>100, 'class'=>'form-control input-sm')); ?>
		<?php echo $form->error($model,'workphone'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'fax'); ?>
		<?php echo $form->textField($model,'fax',array('size'=>60,'maxlength'=>100, 'class'=>'form-control input-sm')); ?>
		<?php echo $form->error($model,'fax'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'proffession'); ?>
		<?php echo $form->textField($model,'proffession',array('size'=>60,'maxlength'=>100, 'class'=>'form-control input-sm')); ?>
		<?php echo $form->error($model,'proffession'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'sladdressline1'); ?>
		<?php echo $form->textField($model,'sladdressline1',array('size'=>60,'maxlength'=>100, 'class'=>'form-control input-sm')); ?>
		<?php echo $form->error($model,'sladdressline1'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'sladdressline2'); ?>
		<?php echo $form->textField($model,'sladdressline2',array('size'=>60,'maxlength'=>100, 'class'=>'form-control input-sm')); ?>
		<?php echo $form->error($model,'sladdressline2'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'sladdressline3'); ?>
		<?php echo $form->textField($model,'sladdressline3',array('size'=>60,'maxlength'=>100, 'class'=>'form-control input-sm')); ?>
		<?php echo $form->error($model,'sladdressline3'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'sllandline'); ?>
		<?php echo $form->textField($model,'sllandline',array('size'=>60,'maxlength'=>100, 'class'=>'form-control input-sm')); ?>
		<?php echo $form->error($model,'sllandline'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'slmobile'); ?>
		<?php echo $form->textField($model,'slmobile',array('size'=>60,'maxlength'=>100, 'class'=>'form-control input-sm')); ?>
		<?php echo $form->error($model,'slmobile'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'slcontactperson'); ?>
		<?php echo $form->textField($model,'slcontactperson',array('size'=>60,'maxlength'=>100, 'class'=>'form-control input-sm')); ?>
		<?php echo $form->error($model,'slcontactperson'); ?>
	</div>


</div>
<div style="clear: both"></div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<br>