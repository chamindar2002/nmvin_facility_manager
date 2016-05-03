<?php

class AlterFacilityPayplanController extends Controller
{
    
        public function beforeAction($action) {
            $this->layout = Facility::module()->layout;
            
            $authorize = array('manager','admin');
            
            User::_can($authorize);
            
            return parent::beforeAction($action);
        }
        
        
        public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}
        
        
        /**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','AutocompleteByMemberId','UpdatePaymentPlan'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        
	public function actionIndex($id,$customer)
	{
            
            $facility = FacilityMaster::model()->findByPk($id);
            $selectedOptions[$facility->paymentPlanMaster->id] = array('selected'=>'selected');
		$this->render('index',
                        [
                            'facility'=>$facility,
                            'selectedOptions'=>$selectedOptions,
                            ]);
	}
        
        public function actionUpdatePaymentPlan(){
            //var_dump($_POST);
            #1 delete repayment schema
            #2 delete repayment settlement
            #3 re generate repayment schema
            #4 re generate repayment settlemnt
            #5 updtae facility master with new payment plan id
            
            $facility_master_id = $_POST['facility_id'];
            $customer_id = $_POST['customer_id'];
            $new_payment_plan_id = $_POST['payment_plan'];
            
            $facility_master = FacilityMaster::model()->findByPk($facility_master_id);
            
            if($facility_master->payment_plan_master_id == $new_payment_plan_id){
                
                echo 'Same payment plan';
                Yii::app()->end();
            }
                
            
            
            
            #1 delete repayment schema
            $criteria = new CDbCriteria;
            $criteria->compare('facility_master_id',$facility_master_id);
            RepaymentSchema::model()->deleteAll($criteria);
            
            #2 delete repayment settlement
            
            $connection = yii::app()->db;
            $sql = "UPDATE repayment_schema_settlement SET deleted = '1' WHERE 	facility_master_id='$facility_master_id' AND deleted = 0";
            $command=$connection->createCommand($sql);
            $command->execute();
            
            
            
            
            $paymentModel = PaymentModel::model()
                                                ->findAllByAttributes(
                                                        array(
                                                            'payment_plan_master_id'=>$new_payment_plan_id,
                                                        ),array('order'=>'payment_sequence')
                                                        );
            
            
           
                            
            
            #3 re generate repayment schema
            
            $rpm_schma = new RepaymentSchema();
                            
            $installment_no = 1;
            
            foreach($paymentModel As $pm){
                   if($pm->is_installment_definer){
                         for($i=1;$i<=$pm->no_of_installments;$i++){
                         //echo "[$i] Installment ".$pm->installment_amount.'<br>';
                                 $rpm_schma->buildNewRepaymentSchemaForCustomer
                                              (  $customer_id,
                                                 $pm,
                                                 $facility_master_id,
                                                 $installment_no,
                                                 $new_payment_plan_id
                                                );
                                        $installment_no++;
                                    }
                     }else{
                           //echo $pm->paymentPlanItem->name.' '.$pm->total_payable.'<br>';
                           $rpm_schma->buildNewRepaymentSchemaForCustomer
                                                ($customer_id,
                                                 $pm,
                                                 $facility_master_id,
                                                 0,
                                                 $new_payment_plan_id
                                                );
                                }
             }
           
            #4 re generate repayment settlemnt
             
            $valid_receipts = PaymentReceiptsMaster::model()->findAllByAttributes(
                        array(
                            'deleted' => 0,
                            'facility_master_id'=>$facility_master_id,
                        )
                    );
            
            foreach($valid_receipts As $vr){
                $fs = RepaymentSchema::fetchRepaymentSchema($facility_master_id);
                    
                RepaymentSchema::invokeRepaymentSchemaSettlementFunctions($vr->id,$fs,$vr->amount_paid);
            }
            
            #5 updtae facility master with new payment plan id
            $facility_master->payment_plan_master_id = $new_payment_plan_id;
            
            if($facility_master->save()){
                echo '<br><strong>Payment plan changed successfully</strong>';
                Yii::app()->end();
            }
            
           print_r($facility_master->getErrors()); 
            
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