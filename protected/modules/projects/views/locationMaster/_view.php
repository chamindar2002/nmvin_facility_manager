<?php
/* @var $this LocationMasterController */
/* @var $data LocationMaster */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('locationcode')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->locationcode), array('view', 'id'=>$data->locationcode)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('locationname')); ?>:</b>
	<?php echo CHtml::encode($data->locationname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('locationcity')); ?>:</b>
	<?php echo CHtml::encode($data->locationcity); ?>
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

	<?php /*
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