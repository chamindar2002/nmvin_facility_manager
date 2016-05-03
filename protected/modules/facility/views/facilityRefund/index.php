<?php
//echo sizeof($receipts);

//var_dump($model->is_deletable);
?>
<h3>Refund Facility For :: <?= Customerdetails::getFullName2($model->customer_id); ?></h3>

<?php if(isset($facility_block_relation)){ ?>
<h3><?= $facility_block_relation->blocknumber; ?></h3>
<?php } ?>

<?php if(sizeof($receipts) > 0){ ?>

<div class="panel panel-primary">
  <div class="panel-heading">
      Issued Receipts 
  </div>
        
      <div class="panel-body">
          <table class="table table-striped">
              <tr><th>Receipt No</th><th>Amount</th></tr>
          <?php
            $refund_total = 0;
            foreach($receipts As $r){
              
          ?>
              <tr>
                <td><?= $r->id; ?></td>
                <td align="right"><?= utilsComponents::formatCurrency($r->amount_paid); ?></td>
              </tr>
              
              <?php $refund_total += $r->amount_paid ?>
          <?php } ?>
              <tr>
                  <td><strong>Total to be refunded</strong></td>
                  <td align="right"><strong><u><?= utilsComponents::formatCurrency($refund_total) ?></u><strong</td>
              </tr>
          </table>
      </div>
    
</div>
</div>

<?php } ?>

<p>
<?php $form = $this->beginWidget('CActiveForm', array(
    'id'=>'delete-form',
    'action'=>array('FacilityRefund/confirm'),
    //'focus'=>array($model,'firstName'),
)); ?>
    
<?php echo CHtml::hiddenField('facility_master_id',$model->id) ?>

<?php if($model->is_deletable){ ?>
<div class="row buttons">
	<?php echo CHtml::submitButton('Confirm',array('class'=>'btn btn-danger btn-lg btn-block')); ?>
</div>
<?php } ?>

<?php $this->endWidget(); ?>