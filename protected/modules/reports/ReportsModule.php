<?php

class ReportsModule extends CWebModule
{
    public $layout = 'application.modules.useradmin.views.layouts.user_layout';
    public $module_name = 'Reports';
	public function init()
	{
        //throw new CHttpException(400, 'A database error occured. Could not fetch data for processing.' );
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'reports.models.*',
			'reports.components.*',
                        'payments.models.*',
                        'dataimport.models.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
