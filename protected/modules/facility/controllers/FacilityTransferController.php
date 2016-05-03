<?php

class FacilityTransferController extends Controller
{
    
        public function beforeAction($action) {
            $this->layout = Facility::module()->layout;
            
            $authorize = array('manager','admin');
            
            User::_can($authorize);
            
            return parent::beforeAction($action);
        }
        
	public function actionIndex($id, $customer)
	{
            $fm = FacilityMaster::model()->findByPk($id);
            $sale = SalesDetails::model()->findByPk($fm->sales_ref_no);
            
            $model = new FacilityTransfers;
            
            if(isset($_POST['FacilityTransfers'])){
                
                $model->attributes=$_POST['FacilityTransfers'];
                $model->facility_master_id = $fm->id;
                $model->customer_id_original = $fm->customer_id;
                $model->created_at = new CDbExpression('NOW()');
                $model->added_by = yii::app()->user->userId;
                
                if($model->save()){
                    $fm->customer_id = $model->customer_id_new;
                    $fm->save();
                    
                    $connection = yii::app()->db;
                    $sql = "UPDATE repayment_schema SET customer_id = '".$model->customer_id_new."' WHERE facility_master_id='$id'";
                    $command=$connection->createCommand($sql);
                    $command->execute();
                    
                    $this->redirect(array('FacilityMaster/index'));
                }
                
                
                
                //exit();
            }
            
            $this->render('index', array('fm'=>$fm, 'sale'=>$sale, 'model'=>$model));
	}

	// Uncomment the following methods and override them if needed
	
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
				'actions'=>array('index'),
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
	
}