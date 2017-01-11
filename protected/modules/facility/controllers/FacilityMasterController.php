<?php

class FacilityMasterController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    //public $layout='//layouts/column2';
    public function beforeAction($action)
    {

        User::_can(['manager', 'admin', 'staff-front-office']);
        $this->layout = Facility::module()->layout;
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
                'actions' => array('view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('index', 'create', 'update', 'AutocompleteByMemberId'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete', 'ViewDelete', 'Destroy'),
                'users' => array('admin'),
            ),
            array('deny',  // deny all users
                'users' => array('*'),
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
        $model = new FacilityMaster;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);


        $saleDetails = null;
        $facility = null;
        $facility_arr = array();

        if (isset($_GET['Customer_Code'])) {
            $model->customer_id = $_GET['Customer_Code'];
            $saleDetails = SalesDetails::model()->findAllByAttributes(
                array(
                    'customercode' => $_GET['Customer_Code'],
                    'deleted' => 0,
                )
            );


            $facility = FacilityMaster::model()->findAllByAttributes(
                array(
                    'customer_id' => $_GET['Customer_Code'],
                    'deleted' => 0,
                )
            );


            foreach ($facility As $f) {
                $facility_arr[$f->sales_ref_no] = $f->attributes;
            }

        }

        if (isset($_POST['FacilityMaster'])) {
            $model->attributes = $_POST['FacilityMaster'];
            $model->created_at = new CDbExpression('NOW()');
            if ($model->save()) {

                $paymentModel = PaymentModel::model()
                    ->findAllByAttributes(
                        array(
                            'payment_plan_master_id' => $_POST['FacilityMaster']['payment_plan_master_id'],
                        ), array('order' => 'payment_sequence')
                    );


                $rpm_schma = new RepaymentSchema();

                //echo '<pre>';
                $installment_no = 1;

                foreach ($paymentModel As $pm) {
                    if ($pm->is_installment_definer) {
                        for ($i = 1; $i <= $pm->no_of_installments; $i++) {
                            //echo "[$i] Installment ".$pm->installment_amount.'<br>';
                            $rpm_schma->buildNewRepaymentSchemaForCustomer
                            ($_POST['FacilityMaster']['customer_id'],
                                $pm,
                                $model->id,
                                $installment_no,
                                $_POST['FacilityMaster']['payment_plan_master_id']
                            );
                            $installment_no++;
                        }
                    } else {
                        //echo $pm->paymentPlanItem->name.' '.$pm->total_payable.'<br>';
                        $rpm_schma->buildNewRepaymentSchemaForCustomer
                        ($_POST['FacilityMaster']['customer_id'],
                            $pm,
                            $model->id,
                            0,
                            $_POST['FacilityMaster']['payment_plan_master_id']
                        );
                    }
                }

            }

            /*
             * generate repayment schema
             */
            if (!empty($rpm_schma)) {
                $fm = $this->loadModel($model->id);
                $fm->repayment_schema_generated = 1;
                $fm->save();
            }

            $model->refresh();
            //echo '</pre>';
            //exit();
            /*if($model->save())
                $this->redirect(array('view','id'=>$model->id));*/
            Yii::app()->user->setFlash('success', 'Facility created successfully');
        }

        $this->render('create', array(
            'model' => $model, 'saleDetails' => $saleDetails, 'facility_arr' => $facility_arr,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        $facilityMaster = FacilityMaster::model()->findByPk($id);
        $customer_id = $facilityMaster->customer_id;

        $saleDetails = null;
        $house_transfers = null;

        $facility = null;
        $facility_arr = array();

        if (isset($facilityMaster)) {
            $model->customer_id = $customer_id;
            $saleDetails = SalesDetails::model()->findAllByAttributes(
                array(
                    'customercode' => $customer_id,
//                                    'deleted'=>0,;
                )
            );

//                    echo '<pre>';
//                    var_dump($saleDetails);
//                    echo '</pre>';
//                    exit;

            if (sizeof($saleDetails) == 0) {
                $house_transfers = HouseOwnershipTranfers::model()->findAllByAttributes(
                    array(
                        'customercode_previous' => $customer_id,
                    )
                );

            }


            $facility = FacilityMaster::model()->findAllByAttributes(
                array(
                    'customer_id' => $customer_id,
                    'deleted' => 0,
                )
            );


            foreach ($facility As $f) {
                $facility_arr[$f->sales_ref_no] = $f->attributes;
            }
        }
        //exit;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['FacilityMaster'])) {
            $model->attributes = $_POST['FacilityMaster'];
            $model->updated_at = new CDbExpression('NOW()');
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model, 'saleDetails' => $saleDetails, 'facility_arr' => $facility_arr, 'house_transfers' => $house_transfers,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {

        //$this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        //if(!isset($_GET['ajax']))
        //	$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionDestroy()
    {
        #delete function

        $receipts = null;

        if (isset($_POST['facility_master_id'])) {

            $facility_master_id = $_POST['facility_master_id'];

            $model = $this->loadModel($facility_master_id);
            $receipts = PaymentReceiptsMaster::model()
                ->findAllByAttributes(array('facility_master_id' => $facility_master_id, 'deleted' => '0'));


            if (sizeof($receipts) == 0) {
                $model->is_deletable = true;

                #next
                #delete facility
                $model->deleted = 1;
                if ($model->save()) {
                    #delete repayment schema

                    $criteria = new CDbCriteria;
                    $criteria->compare('facility_master_id', $facility_master_id);
                    RepaymentSchema::model()->deleteAll($criteria);
                    Yii::app()->user->setFlash('success', 'Repayment Schema and facility deleted successfully');
                }

            } else {
                Yii::app()->user->setFlash('error', 'Cannot delete, Receipts have been issued.');
            }

            $this->render('delete',
                array(
                    'receipts' => $receipts,
                    'model' => $model,

                ));

        }
        //throw new Exception('error occured');

    }

    public function actionViewDelete($id)
    {
        $model = $this->loadModel($id);
        $receipts = PaymentReceiptsMaster::model()->findAllByAttributes(array('facility_master_id' => $id, 'deleted' => 0));

        $facility_block_relation = ViewFacilityCustomerBlockRelation::model()
            ->findByAttributes(
                array('facility_master_id' => $id,)
            );

        if (sizeof($receipts) == 0) {
            $model->is_deletable = true;
        } else {
            Yii::app()->user->setFlash('error', 'Cannot delete, Receipts have been issued.');
        }

        $this->render('delete',
            array(
                'receipts' => $receipts,
                'model' => $model,
                'facility_block_relation' => $facility_block_relation,
            ));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        //$dataProvider=new CActiveDataProvider('FacilityMaster');


        $criteria = new CDbCriteria(array(
            'condition' => 'deleted = 0',

        ));

        $model = new FacilityMaster('search');

        $model->unsetAttributes();
        if (isset($_GET['FacilityMaster']))
            $model->attributes = $_GET['FacilityMaster'];

        $dataProvider = new CActiveDataProvider('FacilityMaster',
                            array('criteria' => $criteria, 'sort' => array('defaultOrder' => 'id DESC'))
        );

        $this->render('index', array(
            'dataProvider' => $dataProvider, 'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new FacilityMaster('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['FacilityMaster']))
            $model->attributes = $_GET['FacilityMaster'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return FacilityMaster the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = FacilityMaster::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param FacilityMaster $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'facility-master-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionAutocompleteByMemberId()
    {
        $res = array();
        $term = Yii::app()->getRequest()->getParam('term', false);
        if ($term) {
            // test table is for the sake of this example
            //$sql = "SELECT mid, first_name,last_name FROM member where first_name = '$term'";
            //$sql = 'SELECT mid,first_name,last_name,association_memeber_id,gender,member_id FROM member where LCASE(member_id) LIKE :strcode';

            //$sql = 'SELECT mid,first_name,last_name,association_memeber_id,gender,member_id FROM member where LCASE(member_id) LIKE :strcode  OR LCASE(first_name) LIKE :strcode OR LCASE(last_name) LIKE :strcode';

            $sql = 'SELECT 	customercode,familyname,firstname,addressline1,addressline2,passportno
                        FROM nmwndb.customerdetails  WHERE 
                        LCASE(customercode) LIKE :strcode 
                        OR LCASE(familyname) LIKE :strcode
                        OR LCASE(firstname) LIKE :strcode
                        OR LCASE(addressline1) LIKE :strcode
                        OR LCASE(addressline2) LIKE :strcode
                        OR LCASE(passportno) LIKE :strcode';
            $cmd = Yii::app()->db->createCommand($sql);
            $cmd->bindValue(":strcode", "%" . strtolower($term) . "%", PDO::PARAM_STR);
            $res = $cmd->queryAll();
        }
        echo CJSON::encode($res);
        Yii::app()->end();
    }
}
