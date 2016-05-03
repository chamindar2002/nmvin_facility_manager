<?php
/* @var $this PaymentModelController */
/* @var $model PaymentModel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'payment_plan_master_id'); ?>
		<?php echo $form->textField($model,'payment_plan_master_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'payment_plan_item_id'); ?>
		<?php echo $form->textField($model,'payment_plan_item_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_installment_definer'); ?>
		<?php echo $form->textField($model,'is_installment_definer'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'no_of_installments'); ?>
		<?php echo $form->textField($model,'no_of_installments'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'installment_amount'); ?>
		<?php echo $form->textField($model,'installment_amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'interest'); ?>
		<?php echo $form->textField($model,'interest'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tax'); ?>
		<?php echo $form->textField($model,'tax'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total_payable'); ?>
		<?php echo $form->textField($model,'total_payable'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created_at'); ?>
		<?php echo $form->textField($model,'created_at'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'updated_at'); ?>
		<?php echo $form->textField($model,'updated_at'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'deleted'); ?>
		<?php echo $form->textField($model,'deleted'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->