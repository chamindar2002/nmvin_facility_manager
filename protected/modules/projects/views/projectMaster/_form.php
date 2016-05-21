<?php
/* @var $this ProjectMasterController */
/* @var $model ProjectMaster */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'project-master-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'locationcode'); ?>
		<?php
                echo $form->dropDownList($model, 'locationcode', CHtml::listData(LocationMaster::model()->getLocations(),'locationcode', 'locationname'), array('prompt' => '','class'=>'form-control input-sm'));
                //echo $form->textField($model,'locationcode', array('class'=>'form-control input-sm')); ?>
		<?php echo $form->error($model,'locationcode'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'projectname'); ?>
		<?php echo $form->textField($model,'projectname',array('size'=>60,'maxlength'=>100, 'class'=>'form-control input-sm')); ?>
		<?php echo $form->error($model,'projectname'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'nofblocks'); ?>
		<?php echo $form->textField($model,'nofblocks', array('class'=>'form-control input-sm')); ?>
		<?php echo $form->error($model,'nofblocks'); ?>
	</div>

	<div class="row buttons">
		
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Add' : 'Save', array('class'=>'btn btn-primary btn-lg btn-block')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->