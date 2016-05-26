<?php

class BlockListingController extends Controller
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'GetCustomer', 'SaveUpdates', 'DeleteBlock', 'GenerateBlocks'),
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

		$model=new ProjectDetails;

		$projects = ProjectMaster::getProjects();

		$project_id = Yii::app()->request->getParam('project_code');
		$model->projectcode = $project_id;

		$blockListdata = array();
		$projectMaster = array();

		if($project_id != 0){
			$blockListdata = $model->getBlockListData($project_id);
			$projectMaster = ProjectMaster::model()->findByPk($project_id);

		}

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ProjectDetails']))
		{

			$rows = $_POST['num_rows'];
			$connection=Yii::app()->db2;



			for($i=0; $i<=$rows; $i++){

				if(isset($_POST["block_refno_$i"])){
					$block_refno = $_POST["block_refno_$i"];
					$block_no = isset($_POST["block_no_$i"]) ? $_POST["block_no_$i"] : 'Undefined';
					$block_size = isset($_POST["block_size_$i"]) ? $_POST["block_size_$i"]: 0;
					$block_price = isset($_POST["block_price_$i"]) ? $_POST["block_price_$i"]: 0;


                    $sql = "UPDATE `projectdetails` SET `blockprice` = '$block_price', `blocknumber` = '$block_no', `blocksize` = '$block_size'  WHERE `projectdetails`.`refno` = $block_refno;";
                    $command = $connection->createCommand($sql);
                    $command->execute();

                    //echo "[$i] -> $block_refno -> $block_no [$block_price]<br>";


				}

			}
            Yii::app()->user->setFlash('success','Updated successfully');

            $this->redirect(Yii::app()->request->urlReferrer);
			/*$model->attributes=$_POST['ProjectDetails'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->refno));*/
		}

		$this->render('create',array(
			'model'=>$model,
			'projects'=>$projects,
			'blockListdata'=>$blockListdata,
			'projectMaster'=>$projectMaster
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

		if(isset($_POST['ProjectDetails']))
		{
			$model->attributes=$_POST['ProjectDetails'];
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
		User::_can(['manager','admin']);
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
		$model = new ViewCustomerBlockRelation('search');

		$model->unsetAttributes();

		if(isset($_GET['ViewCustomerBlockRelation']))
			$model->attributes=$_GET['ViewCustomerBlockRelation'];


		$dataProvider=new CActiveDataProvider('ViewCustomerBlockRelation');


		$this->render('index',array(
			'dataProvider'=>$dataProvider,'model'=>$model
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		User::_can(['manager','admin']);
		$model=new ProjectDetails('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ProjectDetails']))
			$model->attributes=$_GET['ProjectDetails'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ProjectDetails the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ProjectDetails::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ProjectDetails $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='project-details-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionGetCustomer(){

		$customer = array();

		if($_GET['customer_id'] != 0) {
			$customer = Customerdetails::getCustomer($_GET['customer_id']);
		}

		$data = array(
				'customer' => $customer,
				'block' => ProjectDetails::getBlock($_GET['block_id'])
			);

		//sleep(10);

		echo json_encode($data);

		//echo json_encode(['cat','dog','cow',$_GET['customer_id']]);
	}

	public function actionSaveUpdates(){

		$data = $data = ['status' => 'error', 'data'=>array(), 'message'=>null];

		if(isset($_POST['blockrefno']))
		{

		$model=$this->loadModel($_POST['blockrefno']);


			$model->attributes=$_POST;

			//var_dump($model->validate());

			if($model->validate()){

				$model->save();

				$data = ['status' => 'success', 'data'=>$model->attributes, 'message'=>'Updates saved successfully.'];

				//echo json_encode($data);

			}else{

				$data = ['status' => 'error', 'data'=>$model->getErrors(), 'message'=>null];

				//die('has errors');
			}

		}

		echo json_encode($data);

	}

	public function actionDeleteBlock(){

		$data = $data = ['status' => 'error', 'data'=>array(), 'message'=>null];


		if(User::_can(['manager','admin'], true)){

			if(isset($_POST['blockrefno'])) {

				$model = $this->loadModel($_POST['blockrefno']);
				$model->deleted = 1;
				$model->save();

				$data = ['status' => 'success', 'data'=>$model->attributes, 'message'=>'Deleted successfully.'];
			}

		}else{

			$data = ['status' => 'error', 'data'=>['No Permission',403], 'message'=>null];

		}

		echo json_encode($data);
	}

	public function actionGenerateBlocks(){

		if(isset($_POST['nofblocks'])){
			$project_id = $_POST['project_id'];
			$nofblocks = $_POST['nofblocks'];
			$location_id = $_POST['location_id'];

			$connection=Yii::app()->db2;

			for($n=0; $n<$nofblocks; $n++){

				$sql = "INSERT INTO `projectdetails`
										(`locationcode`,
										 `projectcode`,
										 `customercode`,
										 `housecatcode`,
										 `blocknumber`,
										 `blocksize`,
										 `blockprice`)
									  VALUES ('$location_id', '$project_id', '0', '0', 'Undefined', '0', '0');";
				$command = $connection->createCommand($sql);
				$command->execute();

			}
			echo json_encode(['status' => 'success', 'data'=>null, 'message'=>'Blocks generated successfully.']);
		}
		//echo json_encode(['dog','cat','mouse',$_POST['nofblocks']]);
	}
}
