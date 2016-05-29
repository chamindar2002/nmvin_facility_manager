<?php

class DefaultController extends Controller
{
	public function beforeAction($action) {
		$this->layout = Sales::module()->layout;
		return parent::beforeAction($action);
	}


	public function actionIndex()
	{
		$this->render('index');
	}
}