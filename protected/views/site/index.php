<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

?>

<strong>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></strong>


<p>
<div class="panel panel-success">
  <div class="panel-heading">
      Today's Receipts | <i class="fa fa-calendar"></i>
        <?= date('Y-M-d'); ?></div>
  <div class="panel-body">
      
      <ul>
      <?php if(sizeof($receipts_today) > 0){ ?>
        
        <li><?= sizeof($receipts_today);?> Receipts</li>
        <li>Collection (Rs.): <?= utilsComponents::formatCurrency($receipts_total->total_paid); ?></li>
      
      <?php } else { echo 'No receipts today so far.'; } ?>
      </div>
 
  
</div>
<?php
/*$conn=odbc_connect("myacccon", "sa", "admin");

$sql    =   "Select * From tbl_table_1";
$rs =   odbc_exec($conn, $sql);

echo '<table>';
while (odbc_fetch_row($rs)) {
  $str_1=odbc_result($rs,"field_1");
  $str_2=odbc_result($rs,"field_2");
  echo "<tr><td>$str_1</td>";
  echo "<td>$str_2</td></tr>";
}

echo '<table>';*/

?>
