<?php

class TransferController extends Controller
{
	public function beforeAction($action) {
		User::_can(['manager','admin', 'staff-front-office']);
		$this->layout = Sales::module()->layout;
		return parent::beforeAction($action);
	}


	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionGetBlockData(){
		$block_data = array('sales_data'=>null, 'block_data'=>null, 'customer_data'=>null,'transfer_history'=>null);

		$data = $data = ['status' => 'error', 'data'=>array(), 'message'=>null];
		if(isset($_GET['blockref_id']) && $_GET['blockref_id'] != ''){

			$block_data['block_data'] = ProjectDetails::model()->findByPk($_GET['blockref_id'])->attributes;
			$history = HouseOwnershipTranfers::model()->findAllByAttributes(array('blockrefnumber'=>$_GET['blockref_id']));
			foreach($history As $h){
				$block_data['transfer_history'][] = array('customer'=>$h->customerdata_previous->attributes, 'key'=>$h->refno);
			}
			//$block_data['transfer_history']


			$sales_data = SalesDetails::model()->findByAttributes(array('blockrefnumber'=>$_GET['blockref_id'], 'deleted'=>0));
			if(isset($sales_data)){
				$block_data['sales_data'] = $sales_data->attributes;
				$block_data['customer_data'] = $sales_data->customer->attributes;
			}
			$data = $data = ['status' => 'success', 'data'=>$block_data, 'message'=>null];


		}

		echo json_encode($data);
	}

	public function actionOwnershipTransfer()
	{
		$model = new HouseOwnershipTranfers();
		$projects = ProjectMaster::getProjects();
		$project_id = Yii::app()->request->getParam('project_code');
		$model->projectcode = $project_id;

		$blockListdata = array();
		$projectMaster = array();

		if($project_id != 0){
			$blockListdata = $model->getBlockListData($project_id);
			$projectMaster = ProjectMaster::model()->findByPk($project_id);

		}


		$this->render('application.modules.sales.views.transfer.ownershiptransfer.index',
			array('model'=>$model,'projects'=>$projects,'blockListdata'=>$blockListdata));
	}

	public function actionBlocktransfer(){

		$model=new BlockSwap();

		$projects = ProjectMaster::getProjects();

		$project_id = Yii::app()->request->getParam('project_code');
		$model->projectcode = $project_id;

		$blockListdata = array();
		$projectMaster = array();

		if($project_id != 0){
			$blockListdata = $model->getBlockListData($project_id);
			$projectMaster = ProjectMaster::model()->findByPk($project_id);

		}

		$this->render('application.modules.sales.views.transfer.blocktransfer.index',
			array(
				'model'=>$model,
				'projects'=>$projects,
				'blockListdata'=>$blockListdata,
				));
	}

	public function actionCreateNewSwap(){
		$data = array();


		if(User::_can(['manager','admin'], true)){

			if(isset($_POST['transfer_data'])){

				$data = json_decode($_POST['transfer_data']);

				if($data->tranfer_to_block_sales_ref == 0){


					$model = $this->swapToUnOccupiedblock($data);


				}else{


					$model = $this->swaptoOccupiedBlocks($data);
				}

				$data = ['status' => 'success', 'data'=>null, 'message'=>'Saved successfully.'];

			}


		}else{

			$data = ['status' => 'error', 'data'=>['No Permission',403], 'message'=>null];
			//var_dump($data);

		}


		echo json_encode($data);

	}

	private function swapToUnOccupiedblock($data){


		//$setblocksoldout = SalesManager::getInstance()->setBlockSoldOut($blockswapto_blockref,$blockswapfrom_ccode); //set to sold
		ProjectDetails::model()->setBlockSoldOut($data->tranfer_to_block_id, $data->tranfer_from_block_customer_id);

		//$unsetBlock = SalesManager::getInstance()->UnsetBlockSoldOut($blockswapfrom_blockref,0); // unset to available
		ProjectDetails::model()->unsetBlockSoldOut($data->tranfer_from_block_id);

		//$sale = BlockSwapManager::getInstance()->UpdateSale($blockswapfrom_saleref,$blockswapto_blockref);//update sales record to new blocknumber
		$this->UpdateSale($data->tranfer_from_block_sales_ref, $data->tranfer_to_block_id);

		/*$newTransfer = BlockSwapManager::getInstance()->AddNewBlockTransfer($blockswapfrom_blockref,$blockswapfrom_ccode,$blockswapfrom_saleref,$blockswapto_blockref,$blockswapto_ccode);*/
		$this->AddNewBlockTransfer(
			$data->tranfer_from_block_id,
			$data->tranfer_from_block_customer_id,
			$data->tranfer_from_block_sales_ref,
			$data->tranfer_to_block_id,
			$data->tranfer_to_block_customer_id
		);

	}

	private function swaptoOccupiedBlocks($data){
		//$sale = BlockSwapManager::getInstance()->UpdateSale($blockswapfrom_saleref,$blockswapto_blockref);//(swap block no)update sales record to new blocknumber
		$this->UpdateSale($data->tranfer_from_block_sales_ref, $data->tranfer_to_block_id);
		//$sale = BlockSwapManager::getInstance()->UpdateSale($blockswapto_saleref,$blockswapfrom_blockref);//(swap block no)update sales record to new blocknumber
		$this->UpdateSale($data->tranfer_to_block_sales_ref, $data->tranfer_from_block_id);

		//$newTransfer = BlockSwapManager::getInstance()->AddNewBlockTransfer($blockswapfrom_blockref,$blockswapfrom_ccode,$blockswapfrom_saleref, $blockswapto_blockref,$blockswapto_ccode);
		$this->AddNewBlockTransfer(
			$data->tranfer_from_block_id,
			$data->tranfer_from_block_customer_id,
			$data->tranfer_from_block_sales_ref,
			$data->tranfer_to_block_id,
			$data->tranfer_to_block_customer_id
		);
		//$setblocksoldout = SalesManager::getInstance()->setBlockSoldOut($blockswapto_blockref,$blockswapfrom_ccode); //set to sold
		ProjectDetails::model()->setBlockSoldOut($data->tranfer_to_block_id, $data->tranfer_from_block_customer_id);


		//$newTransfer += BlockSwapManager::getInstance()->AddNewBlockTransfer($blockswapto_blockref,$blockswapto_ccode,$blockswapto_saleref, $blockswapfrom_blockref,$blockswapfrom_ccode);
		$this->AddNewBlockTransfer(
			$data->tranfer_to_block_id,
			$data->tranfer_to_block_customer_id,
			$data->tranfer_to_block_sales_ref,
			$data->tranfer_from_block_id,
			$data->tranfer_from_block_customer_id
		);

		//$setblocksoldout = SalesManager::getInstance()->setBlockSoldOut($blockswapfrom_blockref,$blockswapto_ccode); //set to sold
		ProjectDetails::model()->setBlockSoldOut($data->tranfer_from_block_id, $data->tranfer_to_block_customer_id);

		//return $newTransfer;
		//return $this->AddNewBlockTransfer($data);
	}



		private function AddNewBlockTransfer(
			$blockref,
			$salesref,
			$blockref_previous,
			$blockref_current,
			$currentbock_previous_customer
		){

		$model = new Tranferedbloks();
		$model->customercode = $blockref;
		$model->salerefno = $salesref;
		$model->blockrefnumber_previous = $blockref_previous;
		$model->blockrefnumber_current = $blockref_current;
		$model->currentblock_previouscustomer = $currentbock_previous_customer;
		$model->addedby = yii::app()->user->userId;
		$model->addeddate = new CDbExpression('NOW()');
		$model->addedtime = date("h:i:s");

		$model->save();

		return $model;

	}

	private function UpdateSale($saleref, $blockref){

		$model = SalesDetails::model()->findByPk($saleref);
		$model->blockrefnumber = $blockref;
		$model->lastmodifiedby = yii::app()->user->userId;
		$model->lastmodifieddate = new CDbExpression('NOW()');
		$model->lastmodifiedtime = date("h:i:s");

		return $model->save();

	}

	private function UpdateSaleCustomer($saleref, $customer_id){

		$model = SalesDetails::model()->findByPk($saleref);
		$model->customercode = $customer_id;
		$model->lastmodifiedby = yii::app()->user->userId;
		$model->lastmodifieddate = new CDbExpression('NOW()');
		$model->lastmodifiedtime = date("h:i:s");

		return $model->save();

	}

	public function actionNewOwnershipTransfer(){

		$data = array();


		if(User::_can(['manager','admin'], true)){

			if(isset($_POST)){


				$saleref = $_POST['saleref'];
				$blockref = $_POST['blockref'];
				$old_customer = $_POST['old_customer'];
				$new_customer = $_POST['new_customer'];

				$this->newHouseOwnershipTransfer($new_customer, $old_customer, $saleref, $blockref);
				$this->UpdateSaleCustomer($saleref, $new_customer);
				ProjectDetails::model()->setBlockSoldOut($blockref, $new_customer);



				$data = ['status' => 'success', 'data'=>null, 'message'=>'Updated successfully.'];

			}


		}else{

			$data = ['status' => 'error', 'data'=>['No Permission',403], 'message'=>null];
			//var_dump($data);

		}


		echo json_encode($data);

	}

	public function newHouseOwnershipTransfer($ccode_current,$ccode_previous,$salerefno,$blockrefnumber){

		$hot = new HouseOwnershipTranfers();
		$hot->customercode_current = $ccode_current;
		$hot->customercode_previous = $ccode_previous;
		$hot->salerefno = $salerefno;
		$hot->blockrefnumber = $blockrefnumber;
		$hot->addedby = yii::app()->user->userId;
		$hot->addeddate = new CDbExpression('NOW()');
		$hot->addedtime = date("h:i:s");
		$hot->save();


	}

	public function actionCustomerTransferHistory(){
		$data = array();
		if(isset($_GET['customer_id'])){
			$customer_id = $_GET['customer_id'];
			$history = HouseOwnershipTranfers::model()->findAllByAttributes(array('customercode_previous'=>$customer_id));

			foreach($history As $h){
				$data[] = array('customer'=>$h->customerdata_previous->attributes, 'key'=>$h->refno, 'bock_transfers'=>$h->block_tranfers->attributes);
			}
		}

		echo json_encode($data);
	}




	/*
	 * if($blockswapto_blockstat == 0){
						$ok = swaptoUnoccupiedBlock($blockswapfrom_blockref,$blockswapfrom_blockstat,$blockswapfrom_ccode,$blockswapfrom_saleref,
											  $blockswapto_blockref,$blockswapto_blockstat,$blockswapto_ccode,$blockswapto_saleref);
					}else if($blockswapto_blockstat == 2){
						$ok = swaptoOccupiedBlocks($blockswapfrom_blockref,$blockswapfrom_blockstat,$blockswapfrom_ccode,$blockswapfrom_saleref,
											  $blockswapto_blockref,$blockswapto_blockstat,$blockswapto_ccode,$blockswapto_saleref);
					}



	--------------------------------------------------------------------

	function swaptoUnoccupiedBlock($blockswapfrom_blockref,$blockswapfrom_blockstat,$blockswapfrom_ccode,$blockswapfrom_saleref,
								$blockswapto_blockref,$blockswapto_blockstat,$blockswapto_ccode,$blockswapto_saleref){



	$setblocksoldout = SalesManager::getInstance()->setBlockSoldOut($blockswapto_blockref,$blockswapfrom_ccode); //set to sold
	$unsetBlock = SalesManager::getInstance()->UnsetBlockSoldOut($blockswapfrom_blockref,0); // unset to available

	$sale = BlockSwapManager::getInstance()->UpdateSale($blockswapfrom_saleref,$blockswapto_blockref);//update sales record to new blocknumber

	$newTransfer = BlockSwapManager::getInstance()->AddNewBlockTransfer($blockswapfrom_blockref,$blockswapfrom_ccode,$blockswapfrom_saleref,
									    								$blockswapto_blockref,$blockswapto_ccode);


	return $newTransfer;
	}

	--------------------------------------------------------------------

	function swaptoOccupiedBlocks($blockswapfrom_blockref,$blockswapfrom_blockstat,$blockswapfrom_ccode,$blockswapfrom_saleref,
					 $blockswapto_blockref,$blockswapto_blockstat,$blockswapto_ccode,$blockswapto_saleref){



	$sale = BlockSwapManager::getInstance()->UpdateSale($blockswapfrom_saleref,$blockswapto_blockref);//(swap block no)update sales record to new blocknumber
	$sale = BlockSwapManager::getInstance()->UpdateSale($blockswapto_saleref,$blockswapfrom_blockref);//(swap block no)update sales record to new blocknumber

	$newTransfer = BlockSwapManager::getInstance()->AddNewBlockTransfer($blockswapfrom_blockref,$blockswapfrom_ccode,$blockswapfrom_saleref,
									    								$blockswapto_blockref,$blockswapto_ccode);
	$setblocksoldout = SalesManager::getInstance()->setBlockSoldOut($blockswapto_blockref,$blockswapfrom_ccode); //set to sold



	$newTransfer += BlockSwapManager::getInstance()->AddNewBlockTransfer($blockswapto_blockref,$blockswapto_ccode,$blockswapto_saleref,
									    								$blockswapfrom_blockref,$blockswapfrom_ccode);
	$setblocksoldout = SalesManager::getInstance()->setBlockSoldOut($blockswapfrom_blockref,$blockswapto_ccode); //set to sold

	return $newTransfer;
	}


	--------------------------------------------------------------------

	public function AddNewBlockTransfer($blockswapfrom_blockref,$blockswapfrom_ccode,$blockswapfrom_saleref,
									    $blockswapto_blockref,$blockswapto_ccode){

		$newtransfer = new Tranferedbloks();
		$newtransfer->setCustomercode($blockswapfrom_ccode);
		$newtransfer->setSalerefno($blockswapfrom_saleref);
		$newtransfer->setBlockrefnumberPrevious($blockswapfrom_blockref);
		$newtransfer->setBlockrefnumberCurrent($blockswapto_blockref);
		$newtransfer->setCurrentblockPreviouscustomer($blockswapto_ccode);
		$newtransfer->setAddedby($_SESSION[SYSTEMNAME.'logid']);
		$newtransfer->setAddeddate(strtotime(date('mm-dd-yyyy')));
		$newtransfer->setAddedtime(date("h:i:s"));
		$newtransfer->save();
		return 1;
	}

	--------------------------------------------------------------------

	public function UpdateSale($saleref,$blockref){
		$sale = SalesPeer::retrieveByPK($saleref);
		$sale->setBlockrefnumber($blockref);
		$sale->setLastmodifiedby($_SESSION[SYSTEMNAME.'logid']);
		$sale->setAddeddate(strtotime(date('mm-dd-yyyy')));
		$sale->setLastmodifiedtime(date("h:i:s"));
		$sale->save();
		return 1;
	}

	--------------------------------------------------------------------

	ProjectDetails::model()->setBlockSoldOut($new_block, $model->customercode);
	ProjectDetails::model()->unsetBlockSoldOut($prv_block);

	 */

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