<?php

class FacilityRefundController extends Controller
{
        
        public function beforeAction($action) {
            $this->layout = Payments::module()->layout;
            
            $authorize = array('manager','admin');
            
            User::_can($authorize);
            
            return parent::beforeAction($action);
        }
        
	public function actionIndex($id)
	{
//            echo Yii::app()->user->getState('roleId');
//            echo Yii::app()->user->getState('roleName');
//            exit;
            $model = FacilityMaster::model()->findByPk($id);
            
            $receipts = PaymentReceiptsMaster::model()->findAllByAttributes(array('facility_master_id'=>$id,'deleted'=>0));
            
            $facility_block_relation = ViewFacilityCustomerBlockRelation::model()
                                            ->findByAttributes(
                                                    array('facility_master_id'=>$id,)
                                                    );
            
            //die($facility_block_relation->blocknumber);
            
            //if(sizeof($receipts) == 0){
                $model->is_deletable = true;   
            //}else{
              //  Yii::app()->user->setFlash('error','Cannot delete, Receipts have been issued.');
            //}
            
            $this->render('index', array(
                        'receipts'=>$receipts,
                        'model'=>$model,
                        'facility_block_relation'=>$facility_block_relation,
                        ));
	}
        
        public function actionConfirm(){
            
            if(isset($_POST['facility_master_id'])){
               
                 $facility_master_id = $_POST['facility_master_id'];
                 
                 $fm = FacilityMaster::model()->findByPk($facility_master_id);
                 
                 $allValidReceipts = PaymentReceiptsMaster::model()
                                    ->findAllByAttributes(array('deleted'=>0,'facility_master_id'=>$facility_master_id));
                 
                 
                 $facility_block_relation = ViewFacilityCustomerBlockRelation::model()
                                            ->findByAttributes(
                                                    array('facility_master_id'=>$facility_master_id)
                                                    );
            
            //die($facility_block_relation->blocknumber);
                
                 $receipt_total = 0;
                 
                 foreach($allValidReceipts As $receipt){
                     
                    $receipt_total += $receipt->amount_paid;
                    
                    
                    
                 }
                 
                $fr = new FacilityRefunds();
                $fr->facility_master_id = $facility_master_id;
                $fr->customer_id = $fm->customer_id;
                $fr->customer_name = Customerdetails::getFullName2($fm->customer_id);
                $fr->block_name = $facility_block_relation->blocknumber;
                $fr->created_at = new CDbExpression('NOW()');
                $fr->refunded_by = yii::app()->user->userId;
                $fr->refunded_amount = $receipt_total;
                if(!$fr->save()){
                    Yii::app()->user->setFlash('Error','an error occured. please try again');
                        $this->redirect(array('FacilityMaster/index'));
                }
                    
                
                 
                 foreach($allValidReceipts As $receipt){
                     
                    $receipt = PaymentReceiptsMaster::model()->findByPk($receipt->id);
                    $receipt->deleted = 1;
                    $receipt->save();
                    
                    
                 }
                 
                 
                 $voidRpmStm = RepaymentSchemaSettlement::model()->voidAllSettlementsOnFacilityMaster($facility_master_id);
                 $voidRaymentSchemaPaidStatus = RepaymentSchema::model()->setUpaidAllByFacilityMaster($facility_master_id);
                
                 
//                 $allValidReceipts = PaymentReceiptsMaster::model()
//                                    ->findAllByAttributes(array('deleted'=>0,'facility_master_id'=>$facility_master_id));
//                 
//                 
               
                
                foreach($allValidReceipts As $receipt){
                    
                    $rr = new RefundedReceipts();
                    $rr->refund_id = $fr->id;
                    $rr->receipt_id = $receipt->id;
                    $rr->save();
                   
                   
                    
                    $fs = RepaymentSchema::fetchRepaymentSchema($facility_master_id);
                    
                    RepaymentSchema::invokeRepaymentSchemaSettlementFunctions($receipt->id,$fs,$receipt->amount_paid);
                }
                
                $allValidReceipts = PaymentReceiptsMaster::model()
                                    ->findAllByAttributes(array('deleted'=>0,'facility_master_id'=>$facility_master_id));
                
               
                 
                if(sizeof($allValidReceipts) == 0){
                    
                    $facility = FacilityMaster::model()->findByPk($facility_master_id);
                    $facility->deleted = 1;
                    $facility->is_refunded = 1;
                    if($facility->save()){
                        Yii::app()->user->setFlash('success','Facility Refunded Successfully');
                        $this->redirect(array('FacilityMaster/index'));
                    }
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