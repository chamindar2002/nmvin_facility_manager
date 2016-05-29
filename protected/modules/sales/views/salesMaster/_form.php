<?php
/* @var $this SalesMasterController */
/* @var $model SalesDetails */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sales-details-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'customercode'); ?>
		<?php echo $form->textField($model,'customercode'); ?>
		<?php echo $form->error($model,'customercode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'locationcode'); ?>
		<?php echo $form->textField($model,'locationcode'); ?>
		<?php echo $form->error($model,'locationcode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'projectcode'); ?>
		<?php echo $form->textField($model,'projectcode'); ?>
		<?php echo $form->error($model,'projectcode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'blockrefnumber'); ?>
		<?php echo $form->textField($model,'blockrefnumber'); ?>
		<?php echo $form->error($model,'blockrefnumber'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'payplanrefno'); ?>
		<?php echo $form->textField($model,'payplanrefno'); ?>
		<?php echo $form->error($model,'payplanrefno'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nofinstallments'); ?>
		<?php echo $form->textField($model,'nofinstallments'); ?>
		<?php echo $form->error($model,'nofinstallments'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'installamount'); ?>
		<?php echo $form->textField($model,'installamount'); ?>
		<?php echo $form->error($model,'installamount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'totalpayable'); ?>
		<?php echo $form->textField($model,'totalpayable'); ?>
		<?php echo $form->error($model,'totalpayable'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'paymentduedate'); ?>
		<?php echo $form->textField($model,'paymentduedate'); ?>
		<?php echo $form->error($model,'paymentduedate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'agrementstartdate'); ?>
		<?php echo $form->textField($model,'agrementstartdate'); ?>
		<?php echo $form->error($model,'agrementstartdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'agrementfinishdate'); ?>
		<?php echo $form->textField($model,'agrementfinishdate'); ?>
		<?php echo $form->error($model,'agrementfinishdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'saletype'); ?>
		<?php echo $form->textField($model,'saletype'); ?>
		<?php echo $form->error($model,'saletype'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'salerightoff_amt'); ?>
		<?php echo $form->textField($model,'salerightoff_amt'); ?>
		<?php echo $form->error($model,'salerightoff_amt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'salerightoff_status'); ?>
		<?php echo $form->textField($model,'salerightoff_status'); ?>
		<?php echo $form->error($model,'salerightoff_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'salerightoff_comment'); ?>
		<?php echo $form->textArea($model,'salerightoff_comment',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'salerightoff_comment'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'defaulted'); ?>
		<?php echo $form->textField($model,'defaulted'); ?>
		<?php echo $form->error($model,'defaulted'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'deleted'); ?>
		<?php echo $form->textField($model,'deleted'); ?>
		<?php echo $form->error($model,'deleted'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'addedby'); ?>
		<?php echo $form->textField($model,'addedby'); ?>
		<?php echo $form->error($model,'addedby'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'addeddate'); ?>
		<?php echo $form->textField($model,'addeddate'); ?>
		<?php echo $form->error($model,'addeddate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'addedtime'); ?>
		<?php echo $form->textField($model,'addedtime'); ?>
		<?php echo $form->error($model,'addedtime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lastmodifiedby'); ?>
		<?php echo $form->textField($model,'lastmodifiedby'); ?>
		<?php echo $form->error($model,'lastmodifiedby'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lastmodifieddate'); ?>
		<?php echo $form->textField($model,'lastmodifieddate'); ?>
		<?php echo $form->error($model,'lastmodifieddate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lastmodifiedtime'); ?>
		<?php echo $form->textField($model,'lastmodifiedtime'); ?>
		<?php echo $form->error($model,'lastmodifiedtime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'deletedby'); ?>
		<?php echo $form->textField($model,'deletedby'); ?>
		<?php echo $form->error($model,'deletedby'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'deleteddate'); ?>
		<?php echo $form->textField($model,'deleteddate'); ?>
		<?php echo $form->error($model,'deleteddate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'deletedtime'); ?>
		<?php echo $form->textField($model,'deletedtime'); ?>
		<?php echo $form->error($model,'deletedtime'); ?>
	</div>

	<div class="row buttons">
		\n"; ?>
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Add' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->