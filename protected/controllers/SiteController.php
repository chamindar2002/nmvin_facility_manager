<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
    
        //public $layout='//layouts/column2';
        public $layout = '//layouts/admin_layout_main';
        //public $layout = 'application.modules.useradmin.views.layouts.user_layout';
    
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
           
                $criteria = new CDbCriteria();
                //$criteria->condition = 'created_at >'."'".date('Y-m-d H:i:s')."'";
                $criteria->compare('DATE_FORMAT(created_at,"%Y-%m-%d")',date("Y-m-d"),true);
                $criteria->compare('deleted',0);
                $receipts_today = PaymentReceiptsMaster::model()->findAll($criteria);
                
                $criteria->select = '(sum(`amount_paid`)) as total_paid';
                $receipts_total = PaymentReceiptsMaster::model()->find($criteria);
                
		$this->render('index',array('receipts_today'=>$receipts_today,'receipts_total'=>$receipts_total));
	}
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
            //$this->layout='//layouts/column2';
            
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
        
        public function actionErrorFE()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
               
            $this->layout = 'application.views.layouts.login_layout';
            
                $model=new LoginForm();
                              
                
                Yii::app()->session['isLoggedIn'] = false;
            
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()){

                            Yii::app()->session['isLoggedIn'] = true;
                            
                            //if(Yii::app()->user->returnUrl == Yii::app()->baseUrl.'/index.php'){
				$this->redirect(yii::app()->baseUrl.'/index.php/site/index');
                            //}else{
                            //    $this->redirect(Yii::app()->user->returnUrl);
                            //}
                        }
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
                Yii::app()->session->clear();
                Yii::app()->session->destroy();
		Yii::app()->user->logout();
		//$this->redirect(Yii::app()->homeUrl);
                //Yii::app()->user->userId = 2;
                $this->redirect(yii::app()->baseUrl.'/index.php/site/login');
	}
        
        public function actionSiteAdminLogout()
	{
                Yii::app()->session->clear();
                Yii::app()->session->destroy();
		Yii::app()->user->logout();
		//$this->redirect(Yii::app()->homeUrl);
                //Yii::app()->user->userId = 2;
                $this->redirect(yii::app()->baseUrl.'/index.php/site/login');
	}

	public function actionAuthorize(){
		$model=new LoginForm();
		$model->attributes=$_POST;

		$data = ['response'=>'error','data'=>null];

		if($model->validate() && $model->login()){

			$record = User::model()->findByAttributes(array('loginname'=>$model->username,'enabled'=>true,'password'=> User::model()->encryptPassword($model->password)));
			$urrf = UserRoleRef::model()->findByAttributes(array('uid'=>$record->uid));

			if($urrf->roles->name == 'admin') {

				$data['response'] = 'success';
				$data['data'] = $model->attributes;
				Yii::app()->user->setState('ajax_authorize', $model->username);

			}else{

				$data['response'] = 'error';
				$data['data'] = array('You are not authorized');
				Yii::app()->user->setState('ajax_authorize', null);
			}
		}else{
			$data['response'] = 'error';
			$data['data'] = $model->getErrors();
			Yii::app()->user->setState('ajax_authorize', null);
		}



		echo json_encode($data);
	}
        
        
        public function actionAbout(){
            $this->render('application.views.site.pages.about');
        }
        
        public function actionReturn(){
            $this->render('application.views.site.pages.return');
        }

        public function actionFaq(){
            $this->render('application.views.site.pages.faq');
        }
        
        public function actionTerms(){
            $this->render('application.views.site.pages.terms');
        }
        
        public function actionDelivery(){
            $this->render('application.views.site.pages.delivery');
        }
        
        public function actionPrivacy(){
            $this->render('application.views.site.pages.privacy');
        }
        
        

}