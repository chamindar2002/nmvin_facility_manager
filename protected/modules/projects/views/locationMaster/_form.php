<?php
/* @var $this LocationMasterController */
/* @var $model LocationMaster */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'location-master-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'locationname'); ?>
		<?php echo $form->textField($model,'locationname',array('size'=>60,'maxlength'=>100, 'class'=>'form-control input-sm')); ?>
		<?php echo $form->error($model,'locationname'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'locationcity'); ?>
		<?php echo $form->textField($model,'locationcity',array('size'=>60,'maxlength'=>100, 'class'=>'form-control input-sm')); ?>
		<?php echo $form->error($model,'locationcity'); ?>
	</div>


	<div class="row buttons">
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Add' : 'Save',array('class'=>'btn btn-primary btn-lg btn-block')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->