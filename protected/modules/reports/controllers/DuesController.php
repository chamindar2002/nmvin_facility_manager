<?php

class DuesController extends Controller
{
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
        
        public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','Print'),
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
        
	public function actionIndex()
	{
            $criteria = new CDbCriteria();
            $criteria->compare('deleted',0);
            $criteria->compare('is_active',1);
            $criteria->order = 'blockrefnumber ASC';
            
            if(Yii::app()->getRequest()->getParam('lid')){
                $lid = Yii::app()->getRequest()->getParam('lid');
                $criteria->compare('locationcode',$lid);
            }
                        
            $total = ViewFacilitySaleProjectLocation::model()->count($criteria);
            $pages=new CPagination($total);
            $pages->pageSize=50;
            $pages->applyLimit($criteria);
            //$data = FacilityMaster::model()->findAll($criteria);
            
            $data = ViewFacilitySaleProjectLocation::model()->findAll($criteria);
            
            $projects = ViewFacilitySaleProjectLocation::listProjects();
            
            
            //var_dump($projects);exit;
            
		$this->render('index',array('data'=>$data,'pages'=>$pages,'projects'=>$projects));
	}
        
        public function actionPrint(){
            set_time_limit(600);
            
            $criteria = new CDbCriteria();
            $criteria->compare('deleted',0);
            $criteria->compare('is_active',1);
            $criteria->order = 'blockrefnumber ASC';
            
            if(Yii::app()->getRequest()->getParam('lid')){
                $lid = Yii::app()->getRequest()->getParam('lid');
                $criteria->compare('locationcode',$lid);
            }
            
            $data = ViewFacilitySaleProjectLocation::model()->findAll($criteria);
            
            $mPDF1 = Yii::app()->ePdf->mpdf('','A4');
            $stylesheet = file_get_contents(Yii::app()->getBasePath().'/modules/reports/views/payments/pdf.css'); // external css
            $mPDF1->WriteHTML($stylesheet,1);
            $mPDF1->WriteHTML(
                    $this->renderPartial(
                            'application.modules.reports.views.dues._print',
                             array('data'=>$data,'pages'=>$pages),2));               
            $mPDF1->Output('Dues_report.pdf','D'); 
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