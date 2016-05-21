<?php
/* @var $this BlockListingController */
/* @var $data ProjectDetails */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('refno')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->refno), array('view', 'id'=>$data->refno)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('locationcode')); ?>:</b>
	<?php echo CHtml::encode($data->locationcode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('projectcode')); ?>:</b>
	<?php echo CHtml::encode($data->projectcode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customercode')); ?>:</b>
	<?php echo CHtml::encode($data->customercode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('housecatcode')); ?>:</b>
	<?php echo CHtml::encode($data->housecatcode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('blocknumber')); ?>:</b>
	<?php echo CHtml::encode($data->blocknumber); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('blocksize')); ?>:</b>
	<?php echo CHtml::encode($data->blocksize); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('blockprice')); ?>:</b>
	<?php echo CHtml::encode($data->blockprice); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reservedate')); ?>:</b>
	<?php echo CHtml::encode($data->reservedate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reservestatus')); ?>:</b>
	<?php echo CHtml::encode($data->reservestatus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paymentmethod')); ?>:</b>
	<?php echo CHtml::encode($data->paymentmethod); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('duedate')); ?>:</b>
	<?php echo CHtml::encode($data->duedate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deleted')); ?>:</b>
	<?php echo CHtml::encode($data->deleted); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('addedby')); ?>:</b>
	<?php echo CHtml::encode($data->addedby); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('addeddate')); ?>:</b>
	<?php echo CHtml::encode($data->addeddate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('addedtime')); ?>:</b>
	<?php echo CHtml::encode($data->addedtime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lastmodifiedby')); ?>:</b>
	<?php echo CHtml::encode($data->lastmodifiedby); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lastmodifieddate')); ?>:</b>
	<?php echo CHtml::encode($data->lastmodifieddate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lastmodifiedtime')); ?>:</b>
	<?php echo CHtml::encode($data->lastmodifiedtime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deletedby')); ?>:</b>
	<?php echo CHtml::encode($data->deletedby); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deleteddate')); ?>:</b>
	<?php echo CHtml::encode($data->deleteddate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deletedtime')); ?>:</b>
	<?php echo CHtml::encode($data->deletedtime); ?>
	<br />

	*/ ?>

</div>