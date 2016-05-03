<?php
//echo sizeof($receipts);

//var_dump($model->is_deletable);
?>
<h3>Delete Facility For :: <?= Customerdetails::getFullName2($model->customer_id); ?></h3>

<?php if(isset($facility_block_relation)){ ?>
<h3><?= $facility_block_relation->blocknumber; ?></h3>
<?php } ?>

<?php if(sizeof($receipts) > 0){ ?>

<div class="panel panel-primary">
  <div class="panel-heading">
      Issued Receipts 
  </div>
        
      <div class="panel-body">
          <ul>
          <?php foreach($receipts As $r){?>
              <li><?= $r->id; ?> -> <?= utilsComponents::formatCurrency($r->amount_paid); ?></li>
          <?php } ?>
          </ul>
      </div>
      
</div>
</div>

<?php } ?>

<p>
<?php $form = $this->beginWidget('CActiveForm', array(
    'id'=>'delete-form',
    'action'=>array('FacilityMaster/destroy'),
    //'focus'=>array($model,'firstName'),
)); ?>
    
<?php echo CHtml::hiddenField('facility_master_id',$model->id) ?>

<?php if($model->is_deletable){ ?>
<div class="row buttons">
	<?php echo CHtml::submitButton('Delete',array('class'=>'btn btn-danger btn-lg btn-block')); ?>
</div>
<?php } ?>

<?php $this->endWidget(); ?>