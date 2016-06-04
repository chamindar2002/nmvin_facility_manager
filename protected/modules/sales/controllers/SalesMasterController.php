<?php

class SalesMasterController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';

	public function beforeAction($action) {
		User::_can(['manager','admin', 'staff-front-office']);
		$this->layout = Sales::module()->layout;
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
				'actions'=>array('create','update', 'ProjectDetails', 'addnewsale', 'getsale', 'updatesale', 'deletesale'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actionsn
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate2()
	{
		$model=new SalesDetails;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SalesDetails']))
		{
			$model->attributes=$_POST['SalesDetails'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->refno));
		}

		$this->render('create',array(
			'model'=>$model,
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SalesDetails']))
		{
			$model->attributes=$_POST['SalesDetails'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->refno));
		}

		$this->render('update',array(
			'model'=>$model,
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
	public function actionIndex()
	{
		$model = new ViewSaleCustomerProjectLocation('search');

		$projects = ProjectMaster::getProjects();

		$model->unsetAttributes();

		if(isset($_GET['ViewSaleCustomerProjectLocation']))
			$model->attributes=$_GET['ViewSaleCustomerProjectLocation'];


		$dataProvider=new CActiveDataProvider('ViewSaleCustomerProjectLocation');
		$this->render('index',array(
			'dataProvider'=>$dataProvider, 'model'=>$model, 'projects'=>$projects
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new SalesDetails('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SalesDetails']))
			$model->attributes=$_GET['SalesDetails'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return SalesDetails the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=SalesDetails::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param SalesDetails $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='sales-details-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionProjectDetails(){


		$data=ProjectDetails::model()->findAll('projectcode=:project_id AND deleted=0 AND reservestatus=0',
			array(':project_id'=>(int) $_POST['project_id']));


		$data=CHtml::listData($data,'refno','blocknumber');

		echo "<option value=''></option>";
		foreach($data as $value=>$city_name)
			echo CHtml::tag('option', array('value'=>$value),CHtml::encode($city_name),true);

	}

	public function actionUpdateSale(){

		$data = $data = ['status' => 'error', 'data'=>array(), 'message'=>null];

		if(isset($_POST['sale_ref_no']))
		{
			//customercode
			if(count(SalesDetails::model()->facilityExists($_POST['sale_ref_no'])) > 0){
				echo json_encode(['status' => 'error', 'data'=>['Cannot modify. Facilty exists for this sale.'], 'message'=>null]);
				Yii::app()->end();
			}


			$model = SalesDetails::model()->findByPk($_POST['sale_ref_no']);

			$prv_block = $model->blockrefnumber;
			$new_block = $_POST['blockrefnumber'];

			$model->attributes=$_POST;
			$model->payplanrefno = 1;
			$model->nofinstallments = 0;
			$model->description = 'Not Given';
			$model->installamount = 0;
			$model->totalpayable = 0;
			$model->lastmodifieddate = date('Y-m-d');
			$model->lastmodifiedby = yii::app()->user->userId;

			$project = ProjectMaster::model()->findByPk($_POST['projectcode']);

			if(count($project) == 1){
				$model->locationcode = $project->locationDetails->locationcode;
			}
			//echo $model->blockrefnumber.'<br>';

			//echo "$prv_block ? $new_block";exit;


			if($model->validate()){

				if($model->save()){


					if($prv_block != $new_block){

						ProjectDetails::model()->setBlockSoldOut($new_block, $model->customercode);
						ProjectDetails::model()->unsetBlockSoldOut($prv_block);

					}


				}

				$data = ['status' => 'success', 'data'=>$model->attributes, 'message'=>'Updated successfully.'];

				//echo json_encode($data);

			}else{

				$data = ['status' => 'error', 'data'=>$model->getErrors(), 'message'=>null];

				//die('has errors');
			}
		}

		echo json_encode($data);

	}



	public function actionAddnewsale(){

		$data = $data = ['status' => 'error', 'data'=>array(), 'message'=>null];

		if(isset($_POST['customercode']))
		{

			$model=new SalesDetails;

			$model->attributes=$_POST;
			$model->payplanrefno = 1;
			$model->nofinstallments = 0;
			$model->description = 'Not Given';
			$model->installamount = 0;
			$model->totalpayable = 0;
			$model->addeddate = date('Y-m-d');
			$model->addedby = yii::app()->user->userId;

			$project = ProjectMaster::model()->findByPk($_POST['projectcode']);

			if(count($project) == 1){
				$model->locationcode = $project->locationDetails->locationcode;
			}


			//var_dump($model->validate());

			if($model->validate()){

				if($model->save()){

					ProjectDetails::model()->setBlockSoldOut($model->blockrefnumber, $model->customercode);


				}

				$data = ['status' => 'success', 'data'=>$model->attributes, 'message'=>'Saved successfully.'];

				//echo json_encode($data);

			}else{

				$data = ['status' => 'error', 'data'=>$model->getErrors(), 'message'=>null];

				//die('has errors');
			}

		}

		echo json_encode($data);

	}

	public function actionGetSale(){

		$data = $data = ['status' => 'error', 'data'=>array(), 'message'=>null];

		if(isset($_POST['sales_ref_no']))
		{
			$criteria = new CDbCriteria();
			$criteria->compare('sales_ref_no', $_POST['sales_ref_no']);
			$sale = ViewSaleCustomerProjectLocation::model()->find($criteria);


			$data = ['status' => 'success', 'data'=>$sale->attributes, 'message'=>'success'];
		}

		echo json_encode($data);

	}

	public function actionDeleteSale(){
		$data = $data = ['status' => 'error', 'data'=>array(), 'message'=>null];


		if(isset($_POST['sale_ref_no']))
		{
			if(count(SalesDetails::model()->facilityExists($_POST['sale_ref_no'])) > 0){
				echo json_encode(['status' => 'error', 'data'=>['Cannot delete. Facilty exists for this sale.'], 'message'=>null]);
				Yii::app()->end();
			}

			$model = SalesDetails::model()->findByPk($_POST['sale_ref_no']);
			$model->deleted = 1;
			$model->deleteddate = date('Y-m-d');
			$model->deletedby = yii::app()->user->userId;

			if($model->validate()){

				if($model->save()){

					$data = ['status' => 'success', 'data'=>$model->attributes, 'message'=>'Updated successfully.'];

				}


			}else{

				$data = ['status' => 'error', 'data'=>$model->getErrors(), 'message'=>null];

				//die('has errors');
			}


		}

		echo json_encode($data);

	}
}
