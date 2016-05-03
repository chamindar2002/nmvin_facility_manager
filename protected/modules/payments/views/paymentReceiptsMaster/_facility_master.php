<?php

//var_dump($fm);
//echo $fm->sales_ref_no;
if($fm){
    $sale = SalesDetails::model()->findByPk($fm->sales_ref_no);
}else{
    $sale = array();
}
//echo $sale->projectMaster->projectname.' - '.$sale->blockDetails->blocknumber;
if(sizeof($sale) > 0){
    echo CHtml::textField('dummy_project_dls',$sale->location->locationname.' - '.$sale->projectMaster->projectname.' - '.$sale->blockDetails->blocknumber,array('class'=>'form-control input-lg'));
}else{
    echo CHtml::textField('dummy_project_dls','',array('class'=>'form-control input-lg'));
}



?>
