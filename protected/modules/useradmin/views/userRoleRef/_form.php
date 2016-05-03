<?php
/* @var $this UserRoleRefController */
/* @var $model UserRoleRef */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-role-ref-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'uid'); ?>
		<?php 
                    //echo $form->textField($model,'uid'); 
                    echo $form->dropDownList($model,'uid',CHtml::listData(User::model()->findAll(), 'uid', 'loginname'),
                                                array('prompt'=>'Select User','class'=>'form-control input-lg'));
                ?>
		<?php echo $form->error($model,'uid'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'rid'); ?>
		<?php
                //echo $form->textField($model,'rid');
                    echo $form->dropDownList($model,'rid',CHtml::listData(Role::model()->findAll(), 'rid', 'name'), 
                        array('prompt'=>'Select Role','class'=>'form-control input-lg'));
                ?>
		<?php echo $form->error($model,'rid'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary btn-lg btn-block')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->