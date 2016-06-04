<?php

class PaymentReceiptsMasterController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';
        public function beforeAction($action) {
            $this->layout = Payments::module()->layout;
            return parent::beforeAction($action);
        }

	/**
	 * @return array action filters
	 */
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
				'actions'=>array(),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','AutocompleteByMemberId','RenderFacilityMaster','GeneratePdf','SimulateDelete', 'admin', 'delete', 'index'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
        User::_can(['manager','admin', 'staff-front-office']);
//            $mPDF1 = Yii::app()->ePdf->mpdf('','A5-L');
//            $mPDF1->WriteHTML($this->render('print',array('model'=>$this->loadModel($id)),true));               
//            $mPDF1->Output(); 
            
             //http://www.yiiframework.com/extension/pdf/
                $settlements = RepaymentSchemaSettlement::model()->getRepaymentSettlementsByReceiptId($id);
                $receipt_details = PaymentReceiptDetails::model()->findAllByAttributes(array('payment_receipt_master_id'=>$id));
                
                
		$this->render('print',array(
			'model'=>$this->loadModel($id),'settlements'=>$settlements,'receipt_details'=>$receipt_details
		));
                        
                        
             //$this->actionIndex();
            //$this->actionCreate();
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
        User::_can(['manager','admin', 'staff-front-office']);

		$model=new PaymentReceiptsMaster;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                $facility_master = new FacilityMaster();
                
                $payment_types = PaymentTypes::model()->findAll();
                
                $model->method_of_payment = 'CASH'; //default
                
                $banks = PaymentBank::model()->findAllByAttributes(array('deleted'=>0));
                
		if(isset($_POST['PaymentReceiptsMaster']))
		{
                        $facility_master = FacilityMaster::model()->findByPk($_POST['PaymentReceiptsMaster']['facility_master_id']);
			             $model->attributes=$_POST['PaymentReceiptsMaster'];
                        
                        $facility_master_id = $_POST['PaymentReceiptsMaster']['facility_master_id'];
                        $amount = $_POST['PaymentReceiptsMaster']['amount_paid'];
                        
                        $fs = RepaymentSchema::fetchRepaymentSchema($facility_master_id);
                        
                        if(!$facility_master){
                            Yii::app()->user->setFlash('notice', "No facility selected");
                            $model->method_of_payment = $_POST['opt_method_of_payment'];
                            $this->render('create',
                                    array(
                                        'model'=>$model,
                                        'fm'=>$facility_master,
                                        'payment_types'=>$payment_types,
                                        'banks'=>$banks,
                                        ));
                            Yii::app()->end();
                        }
                        
                        if(isset($_POST['opt_method_of_payment'])){
                            $model->method_of_payment = $_POST['opt_method_of_payment'];
                            $model->cheque_number = $_POST['PaymentReceiptsMaster']['cheque_number'];
                            $model->bank = $_POST['PaymentReceiptsMaster']['bank'];
                            $model->setScenario('validate_method_of_payment');
                        }
                        
                        $model->setScenario('authenticateOverdueOveride');
                        
                        /*
                         * assign receipt data
                         */
                        $sale = SalesDetails::model()->findByPk($facility_master->sales_ref_no);
                        
                        $model->customer_address = Customerdetails::getFullAddress($_POST['PaymentReceiptsMaster']['customer_id']);
                        $model->created_at = new CDbExpression('NOW()');
                        $model->name_of_scheme = $sale->projectMaster->projectname.' '.$sale->location->locationname;
                        $model->house_number = $sale->blockDetails->blocknumber;
                        $model->value_of_house = $sale->blockDetails->blockprice;
                        $model->addedby = yii::app()->user->userId;
                        
                        $dtobj = new DateTime($_POST['PaymentReceiptsMaster']['receipt_date']);
                                                
                        $model->receipt_date = $dtobj->format('Y-m-d');
                        
                        
                        if($model->validate()){
                            $model->transaction_id = Transactions::getCurrentTransactionNumber();
                        }
                        
                        
                        //RepaymentSchema::invokeRepaymentSchemaSettlementFunctions($model->id,$fs, $amount);
                        //exit();
                        if($model->save()){
                            RepaymentSchema::invokeRepaymentSchemaSettlementFunctions($model->id,$fs, $amount);
                            $model->add_receipt_detail($model, $_POST);
                            
                            $message = array(
                                                'Receipt No'=>$model->id,
                                                'Amount Paid'=> utilsComponents::formatCurrency($amount),
                                                'Payment Type'=>$model->method_of_payment,
                                                'Sale Details'=>$model->name_of_scheme.':'.$model->house_number,
                                                'Customer Name'=>$model->customer_name,
                                                'NIC'=>$model->customer_id,
                                                'payment_type'=>$model->method_of_payment,
                                                                  );
                                                                  //var_dump($message);exit();
                            
                            
                            $txt = textHandler::fireSms(null,$message);

                            Yii::app()->user->setState('ajax_authorize', null);
                            //exit();
				$this->redirect(array('view','id'=>$model->id));
                        }
		}
                
                

		$this->render('create',array(
			'model'=>$model,
                        'fm'=>$facility_master,
                        'payment_types'=>$payment_types,
                        'banks'=>$banks,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
            die('invalid operation');
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PaymentReceiptsMaster']))
		{
			$model->attributes=$_POST['PaymentReceiptsMaster'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @para
         * m integer $id the ID of the model to be deleted
	 */
        
//        public function actionDelete($id){
//            $r = $this->loadModel($id);
//            $r->deleted = 1;
//            $r->save();
//            
//            $sql="UPDATE `nmwndb_asiast`.`repayment_schema_settlement`
//              SET `deleted` = '1'
//              WHERE `repayment_schema_settlement`.`payment_receipt_master_id` = $id";
//              Yii::app()->db->createCommand($sql)->query();
//              
//            $sql="UPDATE `nmwndb_asiast`.`repayment_schema` 
//                  SET `paid` = '0'
//                  WHERE `repayment_schema`.`facility_master_id` = $facility_master_id";
//            Yii::app()->db->createCommand($sql)->query();
//        }
        
        public function actionSimulateDelete($id){
           /*
            * for test purposes, same code used for delete() action below.
            * this function is fully functional and accurate. uncomment die() to test
            */ 
            
            die('invalid operation');
            
            $r = $this->loadModel($id);
            $r->deleted = 1;
            $r->save();
                
           $facility_master_id = PaymentReceiptsMaster::model()->getFacilityMasterIdByReceiptId($id);
                
                $voidRpmStm = RepaymentSchemaSettlement::model()->voidAllSettlementsOnFacilityMaster($facility_master_id);
                $voidRaymentSchemaPaidStatus = RepaymentSchema::model()->setUpaidAllByFacilityMaster($facility_master_id);
                
                $allValidReceipts = PaymentReceiptsMaster::model()
                                    ->findAllByAttributes(array('deleted'=>0,'facility_master_id'=>$facility_master_id));
                
                //$fs = RepaymentSchema::fetchRepaymentSchema($facility_master_id);
                
//                foreach($fs As $f){
//                    echo $f->amount_payable.'<br>';
//                }
//                
//                exit;
                foreach($allValidReceipts As $receipt){
                    $fs = RepaymentSchema::fetchRepaymentSchema($facility_master_id);
                    echo '---------------------------------------------------------<br>';
                    echo "receipt id -> ".$receipt->id.'<br>';
                    echo $receipt->amount_paid.'<br>';
                    echo '---------------------------------------------------------<br>';
                    RepaymentSchema::invokeRepaymentSchemaSettlementFunctions($receipt->id,$fs,$receipt->amount_paid);
                }
            
        }
        
	public function actionDelete($id)
	{
            $authorize = array('manager','admin');
            
            User::_can($authorize);
		
            $r = $this->loadModel($id);
            $r->deleted = 1;
            $r->save();
                
           $facility_master_id = PaymentReceiptsMaster::model()->getFacilityMasterIdByReceiptId($id);
                
                $voidRpmStm = RepaymentSchemaSettlement::model()->voidAllSettlementsOnFacilityMaster($facility_master_id);
                $voidRaymentSchemaPaidStatus = RepaymentSchema::model()->setUpaidAllByFacilityMaster($facility_master_id);
                
                $allValidReceipts = PaymentReceiptsMaster::model()
                                    ->findAllByAttributes(array('deleted'=>0,'facility_master_id'=>$facility_master_id));
                
                //$fs = RepaymentSchema::fetchRepaymentSchema($facility_master_id);

                foreach($allValidReceipts As $receipt){
                    $fs = RepaymentSchema::fetchRepaymentSchema($facility_master_id);
                    
                    RepaymentSchema::invokeRepaymentSchemaSettlementFunctions($receipt->id,$fs,$receipt->amount_paid);
                }

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        User::_can(['manager','admin', 'staff-front-office']);
             $criteria=new CDbCriteria(array(                    
                                'condition'=>'deleted = 0 ORDER BY id DESC',
                                
                        ));
             
		$dataProvider=new CActiveDataProvider('PaymentReceiptsMaster',array('criteria'=>$criteria));
                
                
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new PaymentReceiptsMaster('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PaymentReceiptsMaster']))
			$model->attributes=$_GET['PaymentReceiptsMaster'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return PaymentReceiptsMaster the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=PaymentReceiptsMaster::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param PaymentReceiptsMaster $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='payment-receipts-master-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function actionAutocompleteByMemberId() {
            $res = array();
            $term = Yii::app()->getRequest()->getParam('term', false);
            if ($term) {
            // test table is for the sake of this example
                //$sql = "SELECT mid, first_name,last_name FROM member where first_name = '$term'";
                //$sql = 'SELECT mid,first_name,last_name,association_memeber_id,gender,member_id FROM member where LCASE(member_id) LIKE :strcode';
                
                //$sql = 'SELECT mid,first_name,last_name,association_memeber_id,gender,member_id FROM member where LCASE(member_id) LIKE :strcode  OR LCASE(first_name) LIKE :strcode OR LCASE(last_name) LIKE :strcode';
                
                $sql = 'SELECT 	facility_master_id,customercode,title,familyname,firstname,addressline1,addressline2,passportno,blocknumber
                        FROM nmwndb_asiast.view_facility_customer_block_relation  WHERE 
                        LCASE(customercode) LIKE :strcode 
                        OR LCASE(familyname) LIKE :strcode
                        OR LCASE(firstname) LIKE :strcode
                        OR LCASE(addressline1) LIKE :strcode
                        OR LCASE(addressline2) LIKE :strcode
                        OR LCASE(passportno) LIKE :strcode
                        OR LCASE(blocknumber) LIKE :strcode 
                        AND deleted = 0';
                $cmd = Yii::app()->db->createCommand($sql);
                $cmd->bindValue(":strcode","%".strtolower($term)."%", PDO::PARAM_STR);
                $res = $cmd->queryAll();
            }
            echo CJSON::encode($res);
            Yii::app()->end();
        }
        
        public function actionRenderFacilityMaster(){
            if(isset($_POST['facility_master_id'])){
                
                $fm = FacilityMaster::model()->findByPk($_POST['facility_master_id']);
                
                $this->renderPartial('_facility_master',array('fm'=>$fm));
                
            }
        }
        
        public function actionGeneratePdf($id){
            //include_once('receipt_fpdf.php');
            //$pdf = new FPDF('L','mm','A5');
            $model = $this->loadModel($id);
            $settlements = RepaymentSchemaSettlement::model()->getRepaymentSettlementsByReceiptId($id,true);
            $receipt_details = PaymentReceiptDetails::model()->findAllByAttributes(array('payment_receipt_master_id'=>$id));
            
            $isDuplicate = PaymentReceiptPrintCounter::isDuplicate($id);
            
            $pdf = new Fpdf('L','mm','A5');
            //echo var_dump($pdf->_getfontpath());
            $pdf->AddFont('FMMalithix','','FM_MALIT.php');
            
            $pdf->AddPage();
			//$pdf->Ln(4);
           
            $pdf->SetFont('Arial','B',10);
            if($isDuplicate){
                $pdf->Cell(95,4,"RECEIPT No: ASST$id - Copy",0,0,'R');
            }else{
                $pdf->Cell(95,4,"RECEIPT No: ASST$id",0,0,'R');
            }
            $pdf->SetFont('Arial','I',8);
            $pdf->Cell(95,4,"",0,1,'R');
		
            $pdf->SetFont('Arial','',10);
		
	    $pdf->Cell(190,2," ",0,1,'L');
	    $pdf->Cell(35,4,"Received from",0,0,'L');
	    $pdf->Cell(95,4,"",0,0,'L');
	    $pdf->Cell(15,4,"Date/",0,0,'R');
	    $pdf->SetFont('FMMalithix','',10);
	    $pdf->Cell(15,4,"oskh(",0,0,'L');
	    $pdf->SetFont('Arial','',10);
	    $pdf->Cell(30,4,date(utilsComponents::getSiteConfigDateFormat(),strtotime($model->receipt_date)),0,1,'R');
            
            $pdf->SetFont('FMMalithix','',10);
            $pdf->Cell(35,4,"f.jq whf.a ku(",0,0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(155,4,$model->customer_name,0,1,'L');
            $pdf->Cell(35,4,"",0,0,'L');
            $pdf->SetFont('Arial','I',10);
            $pdf->Cell(155,4,$model->customer_address,0,1,'L');
            
            $pdf->Cell(190,2,"",0,1,'L');
	    $pdf->Cell(15,4,"Details/",0,0,'L');
	    $pdf->SetFont('FMMalithix','',10);
	    $pdf->Cell(15,4,"jssia;rh(",0,1,'L');
	    $pdf->SetFont('Arial','',8);
            $pfor = '';
            foreach($settlements As $k=>$v){
                   // $pfor .= "$v \n";
                $pdf->Cell(35,4,"$v",0,1,'L');
            }
	    //$pdf->Cell(35,4,"$pfor",1,0,'L');
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(65,3,"",0,0,'L');
            $pdf->Cell(35,3,"Name Of Scheme",0,1,'L');
	    $pdf->SetFont('FMMalithix','',10);
	    $pdf->Cell(65,3,"",0,0,'L');
	    $pdf->Cell(35,3,"ksjdi ixlSrKfha ku(",0,0,'L');
	    $pdf->SetFont('Arial','',10);
	    $pdf->Cell(90,3,"} $model->name_of_scheme",0,1,'L');
            
            $pdf->Cell(190,1,"",0,1,'L');
	    $pdf->Cell(65,3,"",0,0,'L');
	    $pdf->Cell(35,3,"House Number",0,1,'L');
	    $pdf->Cell(65,3,"",0,0,'L');
	    $pdf->SetFont('FMMalithix','',10);
	    $pdf->Cell(35,3,"ksjfia wxlh(",0,0,'L');
	    $pdf->SetFont('Arial','',10);
	    $pdf->Cell(90,3,"} $model->house_number",0,1,'L');
            
            $pdf->Cell(190,1,"",0,1,'L');
	    $pdf->Cell(65,3,"",0,0,'L');
            $pdf->Cell(35,3,"Value Of House Rs.",0,1,'L');
            $pdf->SetFont('FMMalithix','',10);
            $pdf->Cell(65,3,"",0,0,'L');
            $pdf->Cell(35,3,"ksjfia jgskdlu re'",0,0,'L');
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(90,3,"} ".utilsComponents::formatCurrency($model->value_of_house),0,1,'L');
            
            $pdf->Cell(190,2,"",0,1,'L');	

	    $pdf->SetFont('Arial','B',10);
	    $pdf->Cell(30,4,"Mode Of Payment/",0,0,'L');
	    $pdf->SetFont('FMMalithix','',10);
	    $pdf->Cell(30,4," f.jQ wdldrh ",0,0,'L');
	    $pdf->Cell(81,4,"",0,0,'L');
            
	    $pdf->SetFont('Arial','',10);
	    $pdf->Cell(24.5,4,"Amount/",0,0,'R');
            $pdf->SetFont('FMMalithix','',10);
	    $pdf->Cell(24.5,4,"jgskdlu",0,1,'L');
	
	    $pdf->SetFont('Arial','',8);
            
            foreach($receipt_details As $rd){
                        //echo $rd->payment_type;
                        $pdf->Cell(47,3,$rd->payment_type,0,0,'L');
			
                        
                        if($rd->cheque_number != 0){
                            $pdf->Cell(47,3,$rd->cheque_number,0,0,'C');                        
                        }else{                     
                            $pdf->Cell(47,3,"",0,0,'C');
                        }
                        
                        if($rd->bank_id != 1){
                            $pdf->Cell(47,3,$rd->bank_name,0,0,'C');
                            //echo '&nbsp;&nbsp;&nbsp;'.$rd->bank_name;
                        }else{
                            $pdf->Cell(47,3,"",0,0,'C');
                        }
                         $pdf->Cell(49,3," ",0,1,'R');
            }
            $pdf->SetFont('Arial','',10);
            
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(81,4,"",0,0,'R');
            $pdf->Cell(30,4,"Amount Paid /",0,0,'R');
	    $pdf->SetFont('FMMalithix','',10);
	    $pdf->Cell(30,4," f.jQ uqo,(",0,0,'L');
	    $pdf->SetFont('Arial','BU',10);
	    $pdf->Cell(49,4,utilsComponents::formatCurrency($model->amount_paid),0,1,'R');
            
            $utils = new utilsComponents();
            $amountinwords = $utils->convert_number($model->amount_paid);
            
            $pdf->Cell(190,2,"",0,1,'R');
            $pdf->SetFont('Arial','I',8);
            $pdf->Cell(190,3,"($amountinwords)",0,1,'R');
            
            $pdf->SetFont('Arial','',8);
	    $pdf->Cell(190,3,"This receipt is not valid until cheque subject to realization.",0,1,'L');
	    $pdf->SetFont('FMMalithix','',8);
	    $pdf->Cell(190,3,"fplam;a uqo,a j,g mrsjra;kh jk f;la fuh j,x.= fkdfjs'",0,1,'L');
            
            $pdf->Cell(160,4,"",0,0,'R');
            $pdf->SetFont('FMMalithix','',10);
            $pdf->Cell(15,16,"uqoaorh",1,1,'C');
            $pdf->SetFont('Arial','',10);
			//$pdf->Cell(190,4,"_______________________",0,1,'R');
            $pdf->SetFont('Arial','',7);
            $pdf->Cell(95,2,"Prepared By:".$model->userRef->loginname.", Printed By:".Yii::app()->user->name.", Reference: FM".$model->facility_master_id."/CCD".$model->customer_id."/RCT/".$id.", Time: ".$model->created_at,0,0,'LR');
            $pdf->SetFont('Arial','',10);
            
            $pdf->Output("receipt.pdf",'D');
            
            PaymentReceiptPrintCounter::addPrintReceiptCounterRecord($id);
        }
}
