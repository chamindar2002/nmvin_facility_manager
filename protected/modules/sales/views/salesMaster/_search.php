<?php
/* @var $this SalesMasterController */
/* @var $model SalesDetails */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'refno'); ?>
		<?php echo $form->textField($model,'refno'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'customercode'); ?>
		<?php echo $form->textField($model,'customercode'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'locationcode'); ?>
		<?php echo $form->textField($model,'locationcode'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'projectcode'); ?>
		<?php echo $form->textField($model,'projectcode'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'blockrefnumber'); ?>
		<?php echo $form->textField($model,'blockrefnumber'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'payplanrefno'); ?>
		<?php echo $form->textField($model,'payplanrefno'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nofinstallments'); ?>
		<?php echo $form->textField($model,'nofinstallments'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'installamount'); ?>
		<?php echo $form->textField($model,'installamount'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'totalpayable'); ?>
		<?php echo $form->textField($model,'totalpayable'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'paymentduedate'); ?>
		<?php echo $form->textField($model,'paymentduedate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'agrementstartdate'); ?>
		<?php echo $form->textField($model,'agrementstartdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'agrementfinishdate'); ?>
		<?php echo $form->textField($model,'agrementfinishdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'saletype'); ?>
		<?php echo $form->textField($model,'saletype'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'salerightoff_amt'); ?>
		<?php echo $form->textField($model,'salerightoff_amt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'salerightoff_status'); ?>
		<?php echo $form->textField($model,'salerightoff_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'salerightoff_comment'); ?>
		<?php echo $form->textArea($model,'salerightoff_comment',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'defaulted'); ?>
		<?php echo $form->textField($model,'defaulted'); ?>
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