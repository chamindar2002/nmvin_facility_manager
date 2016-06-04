<?php

/**
 * This is the model class for table "repayment_schema".
 *
 * The followings are the available columns in table 'repayment_schema':
 * @property integer $id
 * @property integer $facility_master_id
 * @property integer $customer_id
 * @property integer $payment_model_id
 * @property integer $payment_plan_master_id
 * @property double $amount_payable
 * @property double $amount_paid
 * @property double $amount_diff
 * @property integer $installment_number
 * @property string $payment_due_date
 * @property integer $paid
 * @property integer $receipt_id
 * @property integer $is_istallment
 * @property string $created_at
 * @property string $updated_at
 */
class RepaymentSchema extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'repayment_schema';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('facility_master_id, customer_id, payment_model_id, payment_plan_master_id, amount_payable, amount_paid, amount_diff, installment_number, payment_due_date, paid, receipt_id, created_at, updated_at', 'required'),
			array('facility_master_id, customer_id, payment_model_id, payment_plan_master_id, installment_number, paid, receipt_id, is_istallment', 'numerical', 'integerOnly'=>true),
			array('amount_payable, amount_paid, amount_diff', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, facility_master_id, customer_id, payment_model_id, payment_plan_master_id, amount_payable, amount_paid, amount_diff, installment_number, payment_due_date, paid, receipt_id, is_istallment, created_at, updated_at', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                     'paymentModel' => array(self::BELONGS_TO, 'PaymentModel', 'payment_model_id'),
                     'customer' => array(self::BELONGS_TO,'Customerdetails', 'customer_id'),
                     'settlements' => array(self::HAS_ONE,'RepaymentSchemaSettlement', 'repayment_schema_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'facility_master_id' => 'Facility Master',
			'customer_id' => 'Customer',
			'payment_model_id' => 'Payment Model',
			'payment_plan_master_id' => 'Payment Plan Master',
			'amount_payable' => 'Amount Payable',
			'amount_paid' => 'Amount Paid',
			'amount_diff' => 'Amount Diff',
			'installment_number' => 'Installment Number',
			'payment_due_date' => 'Payment Due Date',
			'paid' => 'Paid',
			'receipt_id' => 'Receipt',
			'is_istallment' => 'Is Istallment',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('facility_master_id',$this->facility_master_id);
		$criteria->compare('customer_id',$this->customer_id);
		$criteria->compare('payment_model_id',$this->payment_model_id);
		$criteria->compare('payment_plan_master_id',$this->payment_plan_master_id);
		$criteria->compare('amount_payable',$this->amount_payable);
		$criteria->compare('amount_paid',$this->amount_paid);
		$criteria->compare('amount_diff',$this->amount_diff);
		$criteria->compare('installment_number',$this->installment_number);
		$criteria->compare('payment_due_date',$this->payment_due_date,true);
		$criteria->compare('paid',$this->paid);
		$criteria->compare('receipt_id',$this->receipt_id);
		$criteria->compare('is_istallment',$this->is_istallment);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RepaymentSchema the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        
        public function buildNewRepaymentSchemaForCustomer(
                $customer_id,
                $payment_model,
                $facility_master_id,
                $installment_number,
                $payment_plan_master_id
                ){
            
            $model = new RepaymentSchema();
            $model->facility_master_id = $facility_master_id;
            $model->customer_id = $customer_id;
            $model->payment_model_id = $payment_model->id;
            $model->payment_plan_master_id = $payment_plan_master_id;
            $model->amount_payable = $payment_model->total_payable;
            $model->amount_paid = 0;
            $model->amount_diff = 0;
            $model->installment_number = $installment_number;
            $model->payment_due_date = date('Y-m-d');//have to change
            $model->paid = 0;
            $model->receipt_id = 0;
            $model->is_istallment = ($installment_number > 0) ? 1 : 0;
            $model->created_at =  new CDbExpression('NOW()');
            $model->updated_at =  new CDbExpression('NOW()');
            
            
            if($model->save())
                return $model;
            
            
            return array();
            
        }
        
        
        public static function fetchRepaymentSchema($facility_master_id){
            
            $criteria = new CDbCriteria();
            $criteria->compare('facility_master_id', $facility_master_id);
            $criteria->compare('paid', 0);
            $criteria->order = 'id ASC';
            
            return self::model()->findAll($criteria);
        }
        
        public function getRepaymentSchemaTotalPayable($facilty_master_id){
            
            $sqltot111="select sum(amount_payable) as total FROM  repayment_schema WHERE facility_master_id='$facilty_master_id' AND paid='0'";
            
            $total = Yii::app()->db->createCommand($sqltot111)->queryScalar();
            
            return $total;
        }
        
        public static function invokeRepaymentSchemaSettlementFunctions(
                                            $receipt_master_id,
                                            $rpmschema,
                                            $amount){
            
            /*
             * get any values over paid from last paid receipt and increase the amount 
             * adding the over paid value
             */
            $facility_master_id = $rpmschema[0]->facility_master_id;
            $last_receipt_balance_bf = self::getOverPaidAmountFromLastPayment($facility_master_id);
            $amount += $last_receipt_balance_bf;
            
            $comment = '';
            
            foreach ($rpmschema As $rs){
                $amt_payable = $rs->amount_payable;
                
                
                //$last_receipt_balance_bf = self::getOverPaidAmountFromLastPayment($rs->facility_master_id);
                //$amount += self::getOverPaidAmountFromLastPayment($rs->facility_master_id);
                
                echo '<p>';
                echo "balance from last receipt : $last_receipt_balance_bf | And the amounnt is $amount<br>";
                echo "amount payable $amt_payable <br>";
                echo '</p>';
                
                if($amt_payable > $amount){
                    
                    $comment = 'partially paid '.$amt_payable.' with amount '. $amount;
                    echo "$comment -> Receipt Id :".$receipt_master_id."<br>";
                    /*
                     * do the following
                     * 1. add receipt no
                     */
                    self::model()->addRepaymentSchemaSettlement(
                                                        $rs->facility_master_id,
                                                        $receipt_master_id,
                                                        $rs->id,
                                                        $paid_full = 0,
                                                        $rs->amount_payable,
                                                        $amount,$comment);
                    
                    break;
                }else if($amt_payable < $amount){
                    $comment = 'fully paid '.$amt_payable;
                    //$amount = $amount - $amt_payable;
                    echo "$comment -> Receipt Id :".$receipt_master_id."<br>";
                    /*
                     * do the following
                     * 1. mark flag as paid
                     * 2. add recipt no
                     */
                    
                    self::model()->addRepaymentSchemaSettlement(
                                                        $rs->facility_master_id,
                                                        $receipt_master_id,
                                                        $rs->id,
                                                        $paid_full = 1,
                                                        $rs->amount_payable,
                                                        $amount,$comment);
                    
                    self::model()->updateRepaymentSchema($rs->id,$receipt_master_id);
                    
                    $amount = $amount - $amt_payable;
                    
                    
                    
                }else{
                    /*
                     * amounts are equal
                     */
                     $comment = 'fully paid e '.$amt_payable.'';
                     
                     echo "$comment -> Receipt Id :".$receipt_master_id."<br>";
                     
                     self::model()->addRepaymentSchemaSettlement(
                                                        $rs->facility_master_id,
                                                        $receipt_master_id,
                                                        $rs->id,
                                                        $paid_full = 1,
                                                        $rs->amount_payable,
                                                        $amount,$comment);
                    
                    self::model()->updateRepaymentSchema($rs->id,$receipt_master_id);
                    
                    
                     break;
                }
                
                //echo $amt_payable.' | '.$amount.'<br>';
            }
        }
        
        public function addRepaymentSchemaSettlement(
                                                        $facility_master_id,
                                                        $receipt_master_id,
                                                        $repayment_schema_id,
                                                        $paid_full,
                                                        $amount_payable,
                                                        $amount_paid,$comment
                                                        ) {
            
            $rpmchst = new RepaymentSchemaSettlement();
            $rpmchst->facility_master_id = $facility_master_id;
            $rpmchst->payment_receipt_master_id = $receipt_master_id;
            $rpmchst->repayment_schema_id = $repayment_schema_id;
            $rpmchst->paid_full = $paid_full;
            $rpmchst->amount_payable = $amount_payable;
            $rpmchst->amount_paid = $amount_paid;
            $rpmchst->balance_bf = $amount_paid - $amount_payable;
            $rpmchst->created_at = new CDbExpression('NOW()');
            $rpmchst->comment = $comment;
            $rpmchst->save();
             
            if(!empty($rpmchst->getErrors())){
                print_r($rpmchst->getErrors());
                exit(); 
            }
            
            
            $rpmchst->refresh();
            
            return true;
            
        }
        
        public function updateRepaymentSchema($repayment_schema_id,$receipt_master_id){
            $rpm = self::model()->findByPk($repayment_schema_id);
            $rpm->paid = 1;
            $rpm->receipt_id = $receipt_master_id;
            $rpm->save();
                    
        }
        
        public function getOverPaidAmountFromLastPayment($facility_master_id){
            $criteria = new CDbCriteria();
            $criteria->condition  = "facility_master_id=:fm_id and deleted='0'";
            $criteria->order = "id DESC";
            $criteria->limit = 1;
            $criteria->params = array(":fm_id" => $facility_master_id);

            $repayment_schema_settlement = RepaymentSchemaSettlement::model()->findAll($criteria);
            
            if($repayment_schema_settlement){
                if($repayment_schema_settlement[0]->balance_bf >= 0){
                    return $repayment_schema_settlement[0]->balance_bf;
                }else{
                    return $repayment_schema_settlement[0]->amount_payable + $repayment_schema_settlement[0]->balance_bf;
                }
            }
            
            return 0;
        }
        
        
        public function setUpaidAllByFacilityMaster($facility_master_id){
            $sql="UPDATE `nmwndb_asiast`.`repayment_schema` 
                  SET `paid` = '0'
                  WHERE `repayment_schema`.`facility_master_id` = $facility_master_id";
            Yii::app()->db->createCommand($sql)->query();
        }
}


