<?php
/* @var $this ProjectMasterController */
/* @var $data ProjectMaster */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('projectcode')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->projectcode), array('view', 'id'=>$data->projectcode)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('locationcode')); ?>:</b>
	<?php echo CHtml::encode($data->locationcode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('projectname')); ?>:</b>
	<?php echo CHtml::encode($data->projectname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nofblocks')); ?>:</b>
	<?php echo CHtml::encode($data->nofblocks); ?>
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

	<?php /*
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