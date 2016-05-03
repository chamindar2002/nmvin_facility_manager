<?php

class ReceiptImporterController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
        
        public function actionFetchSale(){
            if(isset($_POST['customer_id'])){
                $customer_id = $_POST['customer_id'];
                $fcm = ViewFacilityCustomerBlockRelation::model()->findAllByAttributes(array('customer_id'=>$customer_id));
                echo '<ul>';
                foreach ($fcm As $f){
                    echo '<li>';
                    echo CHtml::link($f->blocknumber,array('ReceiptImporter/ListReceipts','id'=>$f->sales_ref_no,'cust'=>$customer_id),array('class'=>'btn btn-link'));
                    echo '</li>';
                }
                echo '<ul>';
            }
        }
        
        public function actionListReceipts($id,$cust){
            
            
            $customer_receipts = Customerreceipts::model()->findAllByAttributes(array('salerefno'=>$id,'deleted'=>'0'));
            $fcm = ViewFacilityCustomerBlockRelation::model()->findByAttributes(array('sales_ref_no'=>$id));

            $importable = PaymentReceiptsMaster::model()
                    ->findAllByAttributes(
                            array('facility_master_id'=>$fcm->facility_master_id)
                            );
                    
            if(sizeof($importable) > 0)
                throw new CHttpException(null,'Cannot import receits, Already imported....');
            
            $this->render('list',array('data'=>$customer_receipts,'fcm'=>$fcm));
        }
        
        public function actionListReceiptSummary(){
            //if(isset($_POST['receipt_nos_selected"'])){
               
                $receipt_nos_selected = $_POST['receipt_nos_selected'];
                //var_dump($_POST['receipt_nos_selected']);
                $t = 0;
                echo '<strong>Receipts Selected</strong><hr>';
                echo '<table>';
                foreach($receipt_nos_selected As $key=>$value){
                    $receiptObj = Customerreceipts::model()->findByPk($value);
                    echo '<tr>';
                    echo '<td>';
                    echo $value;
                    echo '</td>';
                    
                    echo '<td>';
                    echo $receiptObj->receiptdate;
                    echo '</td>';
                    
                    
                    echo '<td>';
                    echo utilsComponents::formatCurrency($receiptObj->paidamount);
                    echo '</td>';
                    echo '</tr>';
                    
                    $t += $receiptObj->paidamount;
                }
                echo '</table>';
                
                $facility_master_id = $_POST['facility_master_id'];
               
                
                    
                $receipt_nos_selected = json_encode($_POST['receipt_nos_selected']);
                echo '<strong>Receipts Total : </strong>'.utilsComponents::formatCurrency($t).'<br>';
                echo "<input type='hidden' name='selected_receipts' id='selected_receipts' value=$receipt_nos_selected>";
                
                
           // }
        }
        
        public function actionImportReceiptsToFacility(){
            if(isset($_POST['facility_master_id'])){
                $facility_master_id = $_POST['facility_master_id'];
                $selected_receipts = json_decode($_POST['selected_receipts']);
                
                $facility_master = FacilityMaster::model()->findByPk($facility_master_id);
                $sale = SalesDetails::model()->findByPk($facility_master->sales_ref_no);
                
                $t = 0;
                foreach($selected_receipts As $key=>$value){
                     $oldReceiptObj = Customerreceipts::model()->findByPk($value);
                     $t +=  $oldReceiptObj->paidamount;
                }
                
                $repaymentTotal = RepaymentSchema::model()->getRepaymentSchemaTotalPayable($facility_master_id);
                
                if($t > $repaymentTotal){
                    echo "Receipts Total : ".utilsComponents::formatCurrency($t).'<br>';
                    echo "Repayment Schema Total : ".utilsComponents::formatCurrency($repaymentTotal);
                    die("<p style='color:red'><strong>Note: Sum of receipts greater than repayment schema total. </strong></p>");
                   
                }
                
                foreach($selected_receipts As $key=>$value){
                     $oldReceiptObj = Customerreceipts::model()->findByPk($value);
                     
                     $newReceiptObj = new PaymentReceiptsMaster();
                     $newReceiptObj->facility_master_id = $facility_master_id;
                     $newReceiptObj->customer_id = $facility_master->customer_id;
                     $newReceiptObj->customer_name = Customerdetails::getFullName2($facility_master->customer_id);
                     $newReceiptObj->customer_address = Customerdetails::getFullAddress($facility_master->customer_id);
                     $newReceiptObj->transaction_id = Transactions::getCurrentTransactionNumber();
                     $newReceiptObj->amount_paid = $oldReceiptObj->paidamount;
                     
                     $dtobj = new DateTime($oldReceiptObj->receiptdate);
                     $newReceiptObj->receipt_date = $dtobj->format('Y-m-d');
                     $newReceiptObj->addedby = yii::app()->user->userId;
                     $newReceiptObj->created_at = new CDbExpression('NOW()');
                     $newReceiptObj->name_of_scheme = $sale->projectMaster->projectname;
                     $newReceiptObj->house_number = $sale->blockDetails->blocknumber;
                     $newReceiptObj->value_of_house = $sale->blockDetails->blockprice;
                     $newReceiptObj->old_receipt_no = $oldReceiptObj->receiptno;
                     $newReceiptObj->save();
                     
                     $oldReceiptMethodOfPayment = CustomerReceiptmethodofpayment::model()->findAllByAttributes(array('receiptno'=>$oldReceiptObj->receiptno));
                     
                     $mofp = array('CA'=>1,'CH'=>2,'BD'=>3);
                     
                     $banks = Array("0"=>"" ,
                            "ASST" => "Asia Asset",
 			    "BOC"=>"Bank Of Ceylon" ,
			    "COM"=>"Commercial Bank Of Ceylon" ,
			    "DFCC"=>"DFCC Bank" ,
			    "HNB"=>"Hatton National Bank" ,
				"HSBC"=>"HSBC Bank" ,
				"NTB"=>"Nations Trust Bank" ,
				"NDB"=>"National Development Bank" ,
				"PABC"=>"Pan Asia Bank" ,
				"PBC"=>"Peoples Bank" ,
				"SEYB"=>"Seylan Bank" ,
 				"SAMP"=>"Sampath Bank",
 				"UB"=>"Union Bank",
				"AB"=>"Amana Bank",
				"SCB"=>"Standard Chartered Bank",
                                "MCB"=>"MCB Islamic Banking",
				);
				
                     
                     foreach($oldReceiptMethodOfPayment As $oldmof){
                        $newReceiptDetails = new PaymentReceiptDetails();
                        $newReceiptDetails->payment_receipt_master_id = $newReceiptObj->id;
                        $newReceiptDetails->payment_type_id = $mofp[$oldmof->receiptstatus];

                        $pmtTypeObj = PaymentTypes::model()->findByPk($mofp[$oldmof->receiptstatus]);
                        $newReceiptDetails->payment_type = $pmtTypeObj->name;
                        $newReceiptDetails->cheque_number =  $oldmof->chequnumber;
                        
                        $bankObj = PaymentBank::model()->findByAttributes(array('bank_code'=>$oldmof->bank));
                        if(sizeof($bankObj) > 0){
                            $newReceiptDetails->bank_id = $bankObj->id;
                        
                            $newReceiptDetails->bank_name = $bankObj->bank_name;
                        }else{
                            $newReceiptDetails->bank_id = 1;
                        
                            $newReceiptDetails->bank_name = 'Undefined';
                        }
                        
                        $newReceiptDetails->cheque_date = $oldmof->chequedate;
                        $newReceiptDetails->amount = $oldmof->amount;

                        $newReceiptDetails->save();
                        //print_r($newReceiptDetails->getErrors());exit;
                     }
                     $fs = RepaymentSchema::fetchRepaymentSchema($facility_master_id);
                    
                     RepaymentSchema::invokeRepaymentSchemaSettlementFunctions($newReceiptObj->id,$fs,$newReceiptObj->amount_paid);
                     
                     PaymentReceiptsImportsMapping::model()->addMappingEntry($value, $newReceiptObj->id, $oldReceiptObj->salerefno);
                }
            }
        }

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}