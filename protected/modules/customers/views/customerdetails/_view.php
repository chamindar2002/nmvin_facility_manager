<?php
/* @var $this CustomerdetailsController */
/* @var $data Customerdetails */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('customercode')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->customercode), array('view', 'id'=>$data->customercode)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('familyname')); ?>:</b>
	<?php echo CHtml::encode($data->familyname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('firstname')); ?>:</b>
	<?php echo CHtml::encode($data->firstname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('addressline1')); ?>:</b>
	<?php echo CHtml::encode($data->addressline1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('addressline2')); ?>:</b>
	<?php echo CHtml::encode($data->addressline2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('postcode')); ?>:</b>
	<?php echo CHtml::encode($data->postcode); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('country')); ?>:</b>
	<?php echo CHtml::encode($data->country); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Skype')); ?>:</b>
	<?php echo CHtml::encode($data->Skype); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('landline')); ?>:</b>
	<?php echo CHtml::encode($data->landline); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mobile')); ?>:</b>
	<?php echo CHtml::encode($data->mobile); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('workphone')); ?>:</b>
	<?php echo CHtml::encode($data->workphone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fax')); ?>:</b>
	<?php echo CHtml::encode($data->fax); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('proffession')); ?>:</b>
	<?php echo CHtml::encode($data->proffession); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gender')); ?>:</b>
	<?php echo CHtml::encode($data->gender); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('passportno')); ?>:</b>
	<?php echo CHtml::encode($data->passportno); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sladdressline1')); ?>:</b>
	<?php echo CHtml::encode($data->sladdressline1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sladdressline2')); ?>:</b>
	<?php echo CHtml::encode($data->sladdressline2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sladdressline3')); ?>:</b>
	<?php echo CHtml::encode($data->sladdressline3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sllandline')); ?>:</b>
	<?php echo CHtml::encode($data->sllandline); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('slmobile')); ?>:</b>
	<?php echo CHtml::encode($data->slmobile); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('slcontactperson')); ?>:</b>
	<?php echo CHtml::encode($data->slcontactperson); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('onlineuserid')); ?>:</b>
	<?php echo CHtml::encode($data->onlineuserid); ?>
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