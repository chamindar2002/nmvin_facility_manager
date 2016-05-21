<?php
/* @var $this BlockListingController */
/* @var $model ProjectDetails */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'project-details-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

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
		<?php echo $form->labelEx($model,'customercode'); ?>
		<?php echo $form->textField($model,'customercode'); ?>
		<?php echo $form->error($model,'customercode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'housecatcode'); ?>
		<?php echo $form->textField($model,'housecatcode'); ?>
		<?php echo $form->error($model,'housecatcode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'blocknumber'); ?>
		<?php echo $form->textField($model,'blocknumber',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'blocknumber'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'blocksize'); ?>
		<?php echo $form->textField($model,'blocksize'); ?>
		<?php echo $form->error($model,'blocksize'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'blockprice'); ?>
		<?php echo $form->textField($model,'blockprice'); ?>
		<?php echo $form->error($model,'blockprice'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reservedate'); ?>
		<?php echo $form->textField($model,'reservedate'); ?>
		<?php echo $form->error($model,'reservedate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reservestatus'); ?>
		<?php echo $form->textField($model,'reservestatus'); ?>
		<?php echo $form->error($model,'reservestatus'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'paymentmethod'); ?>
		<?php echo $form->textField($model,'paymentmethod'); ?>
		<?php echo $form->error($model,'paymentmethod'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'duedate'); ?>
		<?php echo $form->textField($model,'duedate'); ?>
		<?php echo $form->error($model,'duedate'); ?>
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