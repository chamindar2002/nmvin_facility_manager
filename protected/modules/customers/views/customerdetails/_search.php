<?php
/* @var $this CustomerdetailsController */
/* @var $model Customerdetails */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'customercode'); ?>
		<?php echo $form->textField($model,'customercode'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'familyname'); ?>
		<?php echo $form->textField($model,'familyname',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'firstname'); ?>
		<?php echo $form->textField($model,'firstname',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'addressline1'); ?>
		<?php echo $form->textField($model,'addressline1',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'addressline2'); ?>
		<?php echo $form->textField($model,'addressline2',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'postcode'); ?>
		<?php echo $form->textField($model,'postcode',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'country'); ?>
		<?php echo $form->textField($model,'country',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Skype'); ?>
		<?php echo $form->textField($model,'Skype',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'landline'); ?>
		<?php echo $form->textField($model,'landline',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mobile'); ?>
		<?php echo $form->textField($model,'mobile',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'workphone'); ?>
		<?php echo $form->textField($model,'workphone',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fax'); ?>
		<?php echo $form->textField($model,'fax',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'proffession'); ?>
		<?php echo $form->textField($model,'proffession',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gender'); ?>
		<?php echo $form->textField($model,'gender',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'passportno'); ?>
		<?php echo $form->textField($model,'passportno',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sladdressline1'); ?>
		<?php echo $form->textField($model,'sladdressline1',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sladdressline2'); ?>
		<?php echo $form->textField($model,'sladdressline2',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sladdressline3'); ?>
		<?php echo $form->textField($model,'sladdressline3',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sllandline'); ?>
		<?php echo $form->textField($model,'sllandline',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'slmobile'); ?>
		<?php echo $form->textField($model,'slmobile',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'slcontactperson'); ?>
		<?php echo $form->textField($model,'slcontactperson',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'onlineuserid'); ?>
		<?php echo $form->textField($model,'onlineuserid'); ?>
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