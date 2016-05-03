<?php

class CollectionController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
        
        public function beforeAction($action) {
            //echo Address::model()->tableName();
                $this->layout = UserAdmin::module()->layout;
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
				'actions'=>array('view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('RenderCollectionResults','Print','index'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete',),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        
        public function ActionRenderCollectionResults(){
            
            $start = date("Y-m-d",strtotime($_POST['from_date']));
            $end = date("Y-m-d",strtotime($_POST['to_date']));
            $bank_id = isset($_POST['bank_id']) ? $_POST['bank_id'] : null;
            $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : null;
            
            $criteria = new CDbCriteria;             
            $criteria->addBetweenCondition('receipt_date', $start, $end, 'AND');
            
            if($bank_id){
                $criteria->compare('bank_id', $bank_id);
            }
            
            if($user_id){
                $criteria->compare('addedby', $user_id);
            }

            //$data = PaymentReceiptsMaster::model()->findAll($criteria);
            $data = ViewReceiptMasterDetail::model()->findAll($criteria);
            
              
            $criteria->select = '(sum(`amount_paid`)) as total_paid';
            

            $total_paid = ViewReceiptMasterDetail::model()->find($criteria)->total_paid;
 
            
            sleep(1);
                $this->renderPartial(
                        'application.modules.reports.views.collection._results',
                        array(
                            'data'=>$data,
                            'total_paid'=>$total_paid,
                            'from_date'=>$_POST['from_date'],
                            'to_date'=>$_POST['to_date'],
                            'receipt_user'=>array(),
                            'bank_id'=>$bank_id,
                            'user_id'=>$user_id,
                            ));
        }
        
        public function actionPrint($from_date,$to_date,$bank_id,$user_id){
            //echo "$from_date,$to_date";
             set_time_limit(600);
            
            $start = date("Y-m-d",strtotime($from_date));
            $end = date("Y-m-d",strtotime($to_date));
            $criteria = new CDbCriteria;             
            $criteria->addBetweenCondition('receipt_date', $start, $end, 'AND');
            
            if($bank_id){
                $criteria->compare('bank_id', $bank_id);
            }
            
            if($user_id){
                $criteria->compare('addedby', $user_id);
            }
            //$data = PaymentReceiptsMaster::model()->findAll($criteria);
            $data = ViewReceiptMasterDetail::model()->findAll($criteria);
            
            
              
            $criteria->select = '(sum(`amount_paid`)) as total_paid';
            

            $total_paid = ViewReceiptMasterDetail::model()->find($criteria)->total_paid;
            
            
                
            $mPDF1 = Yii::app()->ePdf->mpdf('','A4');
            $stylesheet = file_get_contents(Yii::app()->getBasePath().'/modules/reports/views/payments/pdf.css'); // external css
            $mPDF1->WriteHTML($stylesheet,1);
            $mPDF1->WriteHTML(
                    $this->renderPartial(
                            'application.modules.reports.views.collection._results',
                             array(
                                'data'=>$data,
                                'total_paid'=>$total_paid,
                                'from_date'=>$from_date,
                                'to_date'=>$to_date,
                                ),2));               
            $mPDF1->Output('Collectio_report.pdf','D'); 
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