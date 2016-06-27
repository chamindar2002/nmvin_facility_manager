<?php

class CustomerdetailsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';
        public function beforeAction($action) {
			User::_can(['manager','admin', 'staff-front-office']);
            $this->layout = Customers::module()->layout;
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
				'actions'=>array('create','update', 'delete', 'admin', 'AutocompleteByMemberId'),
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
		$model=new Customerdetails;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                $model->country = 'LK';

		if(isset($_POST['Customerdetails']))
		{
			$model->attributes=$_POST['Customerdetails'];
			if($model->save()){
				Yii::app()->user->setFlash('success','Customer details saved successfully');
				$this->redirect(array('view','id'=>$model->customercode));
			}

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

		if(isset($_POST['Customerdetails']))
		{
			$model->attributes=$_POST['Customerdetails'];
			if($model->save()){
				Yii::app()->user->setFlash('success','Customer details saved successfully');
				$this->redirect(array('view','id'=>$model->customercode));
			}

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

		$model=$this->loadModel($id);
		$model->deleted= 1;
		$model->deletedby = yii::app()->user->userId;
		//$model->deleteddate = CDbExpression('NOW()');
		$model->save();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
            
            $model = new Customerdetails('search');
                
            $model->unsetAttributes();
            
                if(isset($_GET['Customerdetails']))
			$model->attributes=$_GET['Customerdetails'];
                
                
		$dataProvider=new CActiveDataProvider('Customerdetails');
		$this->render('index',array(
			'dataProvider'=>$dataProvider, 'model'=>$model
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Customerdetails('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Customerdetails']))
			$model->attributes=$_GET['Customerdetails'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Customerdetails the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Customerdetails::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Customerdetails $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='customerdetails-form')
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

			$sql = 'SELECT 	customercode,title,familyname,firstname,addressline1,addressline2,passportno
                        FROM nmwndb.customerdetails  WHERE
                        LCASE(customercode) LIKE :strcode
                        OR LCASE(familyname) LIKE :strcode
                        OR LCASE(firstname) LIKE :strcode
                        OR LCASE(addressline1) LIKE :strcode
                        OR LCASE(addressline2) LIKE :strcode
                        OR LCASE(passportno) LIKE :strcode
                        AND deleted = 0';
			$cmd = Yii::app()->db->createCommand($sql);
			$cmd->bindValue(":strcode","%".strtolower($term)."%", PDO::PARAM_STR);
			$res = $cmd->queryAll();
		}
		echo CJSON::encode($res);
		Yii::app()->end();
	}
}
