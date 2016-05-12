
<!-- Trigger the modal with a button -->
<!--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>-->

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Bank Details</h4>
      </div>
      <div class="modal-body">
      
        <div class="form-group">
		<?php echo CHtml::label('Cheque Number',''); ?>
		<?php echo $form->textField($model,'cheque_number',array('size'=>60,'maxlength'=>255,'class'=>'form-control input-sm')); ?>
		<?php echo $form->error($model,'cheque_number'); ?>
	</div>

	<div class="form-group">
		<?php echo CHtml::label('Bank',''); ?>
		<?php
                //echo $form->textField($model,'bank',array('size'=>60,'maxlength'=>255,'class'=>'form-control input-sm'));
                echo $form->dropdownlist($model,'bank',CHtml::listData($banks, 'id','bank_name'),array('prompt'=>'','class'=>'form-control input-sm'));
                ?>
		<?php echo $form->error($model,'bank'); ?>
	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>