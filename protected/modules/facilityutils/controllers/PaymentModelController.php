<?php

class PaymentModelController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';
        public function beforeAction($action) {
			User::_can(['manager','admin', 'staff-front-office']);
            $this->layout = Facilityutils::module()->layout;
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','UpdateSortOrder'),
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

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		/*$this->render('view',array(
			'model'=>$this->loadModel($id),
		));*/
             $this->actionUpdate($id);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		//$model=new PaymentModel;
                 $model=new PaymentModelInstallment();
                
                 $pplan_id = Yii::app()->request->getParam('payment_plan');
                 $installment_definer = PaymentModel::getInstallmentsDefinerRecord($pplan_id);
                 $model->payment_plan_master_id = $pplan_id;
                 
                
                 
                 if(!empty($installment_definer) & !isset($_GET['installment'])){
                     
                     
                     $model = new PaymentModelPaymentPlanItem();
                    
                     $model->payment_plan_master_id = $pplan_id;
                     
                     $model->payment_sequence = (int)PaymentModel::model()->getCountOfPaymentPlanItems($pplan_id) + 1;
                     
                     if(isset($_POST['PaymentModelPaymentPlanItem']))
                     {
			$model->attributes=$_POST['PaymentModelPaymentPlanItem'];
                        $model->is_installment_definer = 0;
                        
                        $model->created_at = new CDbExpression('NOW()');
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
                     }
                     
                 }else{
                    
                     if(isset($_POST['PaymentModelInstallment']))
                     {
			$model->attributes=$_POST['PaymentModelInstallment'];
                        $model->is_installment_definer = 1;
                        $model->payment_sequence = (int)PaymentModel::model()->getCountOfPaymentPlanItems($pplan_id) + 1;
                        
                        $model->created_at = new CDbExpression('NOW()');
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
                     }
                
                 }
                 
                if($pplan_id){ 
                    $AvailablePaymentPlanItems = PaymentModel::model()->getAvailablePaymentPlanItems($pplan_id,0);
                }else{
                    $AvailablePaymentPlanItems = CHtml::listData(PaymentPlanItems::model()->findAll(), 'id','name');
                }

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PaymentModel']))
		{
			$model->attributes=$_POST['PaymentModel'];
                        $model->created_at = new CDbExpression('NOW()');
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
                
                

		$this->render('create',array(
			'model'=>$model,'AvailablePaymentPlanItems'=>$AvailablePaymentPlanItems,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
                //$model=new PaymentModelInstallment();
                //$model = new PaymentModelInstallment();
                //$model = $model->findByPk($id);
                
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                //$pplan_id = $model->payment_plan_master_id;
                
                
                //$installment_definer = PaymentModel::getInstallmentsDefinerRecord($pplan_id);
                //$model->payment_plan_master_id = $pplan_id;
                 if($model->isPaymentModelUtilized($id)){
                     Yii::app()->user->setFlash('error', "Cannot modify payment model as it is already utilized");
                     $this->redirect(Yii::app()->request->urlReferrer);
                 }
                                
                
                 if(($model->is_installment_definer == 0)){
                     
                     $model = new PaymentModelPaymentPlanItem();
                     $model = $model->findByPk($id);
                     $pplan_id = $model->payment_plan_master_id;
                     //$model = PaymentModelPaymentPlanItem::model()->findByPk($id);
                    
                     $model->payment_plan_master_id = $pplan_id;
                                          
                     if(isset($_POST['PaymentModelPaymentPlanItem']))
                     {
			$model->attributes=$_POST['PaymentModelPaymentPlanItem'];
                        $model->is_installment_definer = 0;
                        
                        $model->updated_at = new CDbExpression('NOW()');
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
                     }
                     
                 }else{
                     
                     //$model = PaymentModelInstallment::model()->findByPk($id);
                     $model = new PaymentModelInstallment();
                     $model = $model->findByPk($id);
                     $pplan_id = $model->payment_plan_master_id;
                     $model->payment_plan_master_id = $pplan_id;
                    
                     if(isset($_POST['PaymentModelInstallment']))
                     {
			$model->attributes=$_POST['PaymentModelInstallment'];
                        $model->is_installment_definer = 1;
                        
                        $model->created_at = new CDbExpression('NOW()');
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
                     }
                
                 }
                 
                 $AvailablePaymentPlanItems = PaymentModel::model()->getAvailablePaymentPlanItems($model->payment_plan_master_id, $model->payment_plan_item_id);

		/*if(isset($_POST['PaymentModel']))
		{
			$model->attributes=$_POST['PaymentModel'];
                        $model->updated_at = new CDbExpression('NOW()');
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}*/

		$this->render('update',array(
			'model'=>$model,'AvailablePaymentPlanItems'=>$AvailablePaymentPlanItems
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex($id)
	{
               $criteria=new CDbCriteria(array(                    
                                'condition'=>'deleted = 0 AND payment_plan_master_id = '.$id.' ORDER BY payment_sequence',
                                
                        ));
               
               $pplan_master = PaymentPlanMaster::model()->findByPk($id);
		$dataProvider=new CActiveDataProvider('PaymentModel',array('criteria'=>$criteria));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,'pplan_master'=>$pplan_master,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new PaymentModel('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PaymentModel']))
			$model->attributes=$_GET['PaymentModel'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return PaymentModel the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=PaymentModel::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param PaymentModel $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='payment-model-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function actionUpdateSortOrder(){
            if(isset($_POST['sort_value'])){
                $id = $_POST['payplan_model'];
                $sort_value = $_POST['sort_value'];
                
                
                
                $payment_model = $this->loadModel($id);
                
                if(!$payment_model->isPaymentModelUtilized($id)){
                    $payment_model->payment_sequence = $sort_value;
                    $payment_model->save();
                    echo 'Updated !';
                }else{
                    echo "Note: Cannot re-arrange payment model as it is already utilized";
                }
                    
                
                
            }
            
            
        }
}
