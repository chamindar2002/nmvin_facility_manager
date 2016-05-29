<?php
/* @var $this SalesMasterController */
/* @var $data SalesDetails */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('refno')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->refno), array('view', 'id'=>$data->refno)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customercode')); ?>:</b>
	<?php echo CHtml::encode($data->customercode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('locationcode')); ?>:</b>
	<?php echo CHtml::encode($data->locationcode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('projectcode')); ?>:</b>
	<?php echo CHtml::encode($data->projectcode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('blockrefnumber')); ?>:</b>
	<?php echo CHtml::encode($data->blockrefnumber); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('payplanrefno')); ?>:</b>
	<?php echo CHtml::encode($data->payplanrefno); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nofinstallments')); ?>:</b>
	<?php echo CHtml::encode($data->nofinstallments); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('installamount')); ?>:</b>
	<?php echo CHtml::encode($data->installamount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('totalpayable')); ?>:</b>
	<?php echo CHtml::encode($data->totalpayable); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paymentduedate')); ?>:</b>
	<?php echo CHtml::encode($data->paymentduedate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('agrementstartdate')); ?>:</b>
	<?php echo CHtml::encode($data->agrementstartdate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('agrementfinishdate')); ?>:</b>
	<?php echo CHtml::encode($data->agrementfinishdate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('saletype')); ?>:</b>
	<?php echo CHtml::encode($data->saletype); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('salerightoff_amt')); ?>:</b>
	<?php echo CHtml::encode($data->salerightoff_amt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('salerightoff_status')); ?>:</b>
	<?php echo CHtml::encode($data->salerightoff_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('salerightoff_comment')); ?>:</b>
	<?php echo CHtml::encode($data->salerightoff_comment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('defaulted')); ?>:</b>
	<?php echo CHtml::encode($data->defaulted); ?>
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