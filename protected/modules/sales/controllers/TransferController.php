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
		$block_data = array('sales_data'=>null, 'block_data'=>null, 'customer_data'=>null);

		$data = $data = ['status' => 'error', 'data'=>array(), 'message'=>null];
		if(isset($_GET['blockref_id'])){

			$block_data['block_data'] = ProjectDetails::model()->findByPk($_GET['blockref_id'])->attributes;

			$sales_data = SalesDetails::model()->findByAttributes(array('blockrefnumber'=>$_GET['blockref_id'], 'deleted'=>0));
			if(isset($sales_data)){
				$block_data['sales_data'] = $sales_data->attributes;
				$block_data['customer_data'] = $sales_data->customer->attributes;
			}
			$data = $data = ['status' => 'success', 'data'=>$block_data, 'message'=>null];


		}

		echo json_encode($data);
	}

	public function actionBlocktransfer(){

		$model=new BlockTransfer;

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

	public function actionCreate(){
		$data = array();

		if(isset($_POST['transfer_data'])){

			$data = json_decode($_POST['transfer_data']);

		}

		echo $data->tranfer_from_block_id;
		//print_r($data);


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