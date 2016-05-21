<?php
/* @var $this LocationMasterController */
/* @var $model LocationMaster */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'locationcode'); ?>
		<?php echo $form->textField($model,'locationcode'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'locationname'); ?>
		<?php echo $form->textField($model,'locationname',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'locationcity'); ?>
		<?php echo $form->textField($model,'locationcity',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'deleted'); ?>
		<?php echo $form->textField($model,'deleted'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'addedby'); ?>
		<?php echo $form->textField($model,'addedby'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'addeddate'); ?>
		<?php echo $form->textField($model,'addeddate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'addedtime'); ?>
		<?php echo $form->textField($model,'addedtime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lastmodifiedby'); ?>
		<?php echo $form->textField($model,'lastmodifiedby'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lastmodifieddate'); ?>
		<?php echo $form->textField($model,'lastmodifieddate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lastmodifiedtime'); ?>
		<?php echo $form->textField($model,'lastmodifiedtime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'deletedby'); ?>
		<?php echo $form->textField($model,'deletedby'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'deleteddate'); ?>
		<?php echo $form->textField($model,'deleteddate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'deletedtime'); ?>
		<?php echo $form->textField($model,'deletedtime'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->