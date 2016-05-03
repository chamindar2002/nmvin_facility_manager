<?php
/* @var $this PaymentModelController */
/* @var $data PaymentModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('payment_plan_master_id')); ?>:</b>
	<?php echo CHtml::encode($data->payment_plan_master_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('payment_plan_item_id')); ?>:</b>
	<?php echo CHtml::encode($data->payment_plan_item_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_installment_definer')); ?>:</b>
	<?php echo CHtml::encode($data->is_installment_definer); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('no_of_installments')); ?>:</b>
	<?php echo CHtml::encode($data->no_of_installments); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('installment_amount')); ?>:</b>
	<?php echo CHtml::encode($data->installment_amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('interest')); ?>:</b>
	<?php echo CHtml::encode($data->interest); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('tax')); ?>:</b>
	<?php echo CHtml::encode($data->tax); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_payable')); ?>:</b>
	<?php echo CHtml::encode($data->total_payable); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_at')); ?>:</b>
	<?php echo CHtml::encode($data->created_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updated_at')); ?>:</b>
	<?php echo CHtml::encode($data->updated_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deleted')); ?>:</b>
	<?php echo CHtml::encode($data->deleted); ?>
	<br />

	*/ ?>

</div>