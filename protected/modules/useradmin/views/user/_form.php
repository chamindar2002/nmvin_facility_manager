<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'enabled'); ?>
		<?php 
                //echo $form->textField($model,'enabled');
                echo $form->dropdownlist($model,'enabled',User::model()->userStates(),array('class'=>'form-control input-lg'));
                ?>
		<?php echo $form->error($model,'enabled'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'loginname'); ?>
		<?php echo $form->textField($model,'loginname',array('size'=>60,'maxlength'=>200,'class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'loginname'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'familyname'); ?>
		<?php echo $form->textField($model,'familyname',array('size'=>60,'maxlength'=>200,'class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'familyname'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'firstname'); ?>
		<?php echo $form->textField($model,'firstname',array('size'=>60,'maxlength'=>200,'class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'firstname'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>200, 'class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary btn-lg btn-block')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->