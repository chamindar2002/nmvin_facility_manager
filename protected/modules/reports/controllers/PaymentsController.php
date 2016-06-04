<?php

class PaymentsController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
        
        public function beforeAction($action) {
			User::_can(['manager','admin', 'staff-front-office']);
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
				'actions'=>array('index','RenderPayementsResults','Print'),
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
        
        public function actionRenderPayementsResults(){
            if(isset($_POST['customer_id'])){
                $customer_id = $_POST['customer_id'];
                $facility_master_id = $_POST['facility_master_id'];
                
                
                $facility = FacilityMaster::model()->findByPk($facility_master_id);
                
                
                
                sleep(1);
                $this->renderPartial('application.modules.reports.views.payments._results',
                        array(
                            'customer_id'=>$customer_id,
                            'facility'=>$facility,
                            'facility_master_id'=>$facility_master_id,
                            ));
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
        
        public function actionPrint($id,$facility_master_id)
	{
            $customer_id = $id;
            //sleep(5);
            //$this->renderPartial('application.modules.reports.views.payments._results',array('customer_id'=>$customer_id));
            $facility = FacilityMaster::model()->findByPk($facility_master_id);
            
            $mPDF1 = Yii::app()->ePdf->mpdf('','A4');
            $stylesheet = file_get_contents(Yii::app()->getBasePath().'/modules/reports/views/payments/pdf.css'); // external css
            $mPDF1->WriteHTML($stylesheet,1);
            $mPDF1->WriteHTML(
                    $this->renderPartial(
                            'application.modules.reports.views.payments._results',
                            array(
                                'customer_id'=>$customer_id,
                                'facility'=>$facility,
                                'facility_master_id'=>$facility_master_id),
                                2));               
            $mPDF1->Output('Repayment_report.pdf','D'); 
            
          
	}
}