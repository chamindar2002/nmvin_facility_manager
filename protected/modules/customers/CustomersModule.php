<?php

class CustomersModule extends CWebModule
{
    public $layout = 'application.modules.useradmin.views.layouts.user_layout';
    public $module_name = 'Customer Management';
    
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'customers.models.*',
			'customers.components.*',
                        'customers.models.*',
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