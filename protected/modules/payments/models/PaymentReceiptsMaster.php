<?php

/**
 * This is the model class for table "payment_receipts_master".
 *
 * The followings are the available columns in table 'payment_receipts_master':
 * @property integer $id
 * @property integer $facility_master_id
 * @property integer $customer_id
 * @property string $customer_name
 * @property string $customer_address
 * @property integer $transaction_id
 * @property double $amount_paid
 * @property string $receipt_date
 * @property integer $deleted
 * @property integer $addedby
 * @property string $created_at
 * @property string $updated_at
 * @property string $name_of_scheme
 * @property string $house_number
 * @property double $value_of_house
 * @property string $details
 * @property integer $old_receipt_no
 *
 * The followings are the available model relations:
 * @property PaymentReceiptDetails[] $paymentReceiptDetails
 */
class PaymentReceiptsMaster extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
        public $method_of_payment;
        
        public $bank;
        public $cheque_number;
        
        public $total_paid;
    
	public function tableName()
	{
		return 'payment_receipts_master';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('facility_master_id, customer_id, customer_name, customer_address, amount_paid, receipt_date', 'required'),
			array('facility_master_id, customer_id, transaction_id, deleted, addedby, old_receipt_no', 'numerical', 'integerOnly'=>true),
			array('amount_paid, value_of_house', 'numerical'),
			array('customer_name, name_of_scheme, house_number, details', 'length', 'max'=>255),
			array('created_at, updated_at', 'safe'),
                    
                        array('method_of_payment', 'check_bank_attributes', 'on'=>'validate_method_of_payment'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, facility_master_id, customer_id, customer_name, customer_address, transaction_id, amount_paid, receipt_date, deleted, addedby, created_at, updated_at, name_of_scheme, house_number, value_of_house, details, old_receipt_no', 'safe', 'on'=>'search'),
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
                    'paymentReceiptDetails' => array(self::HAS_MANY, 'PaymentReceiptDetails', 'payment_receipt_master_id'),
                    'repaymentSchemaSettlements' => array(self::HAS_MANY, 'RepaymentSchemaSettlement', 'payment_receipt_master_id'),
                    'userRef'=>array(self::BELONGS_TO,'User','addedby'),
                     
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
			'customer_name' => 'Customer Name',
                        'customer_address' => 'Customer Address',
			'transaction_id' => 'Transaction',
			'amount_paid' => 'Amount Paid',
                        'receipt_date' => 'Date',
			'deleted' => 'Deleted',
			'addedby' => 'Addedby',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
                        'name_of_scheme' => 'Name Of Scheme',
                        'house_number' => 'House Number',
                        'value_of_house' => 'Value Of House',
                        'details' => 'Details',
                        'old_receipt_no' => 'Old Receipt Number',
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
		$criteria->compare('customer_name',$this->customer_name,true);
                $criteria->compare('customer_address',$this->customer_address,true);
		$criteria->compare('transaction_id',$this->transaction_id);
		$criteria->compare('amount_paid',$this->amount_paid);
                $criteria->compare('receipt_date',$this->receipt_date,true);
		$criteria->compare('deleted',0);
		$criteria->compare('addedby',$this->addedby);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);
                $criteria->compare('name_of_scheme',$this->name_of_scheme,true);
                $criteria->compare('house_number',$this->house_number,true);
                $criteria->compare('value_of_house',$this->value_of_house);
                $criteria->compare('details',$this->details,true);
                $criteria->compare('old_receipt_no',$this->old_receipt_no);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PaymentReceiptsMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function getFacilityMasterIdByReceiptId($rmid){
            $receiptMaster = PaymentReceiptsMaster::model()->findByPk($rmid);
            
            if($receiptMaster)
                return $receiptMaster->facility_master_id;
                
            
                
           return null;
        }
        
        public function check_bank_attributes(){
            //$this->addError('method_of_payment', 'yyy'.$this->method_of_payment);
            if($this->method_of_payment == 'CHEQUE'){
                if($this->cheque_number == ''){
                    $this->addError('method_of_payment', 'Cheque number cannot be blank.');
                }
                if($this->bank == ''){
                    $this->addError('method_of_payment', 'Bank not selected.');
                }
            }else if($this->method_of_payment == 'BANK DEPOSIT'){
                if($this->bank == ''){
                    $this->addError('method_of_payment', 'Bank not selected.');
                }
            }
        }
        
        public function add_receipt_detail($receipt_master,$post){
            
            $receipt_detail = new PaymentReceiptDetails();
            $receipt_detail->payment_receipt_master_id = $receipt_master->id;
            
            $payment_type_obj = PaymentTypes::model()->findByAttributes(array('name'=>$post['opt_method_of_payment']));
            $receipt_detail->payment_type = $post['opt_method_of_payment'];
            $receipt_detail->payment_type_id = $payment_type_obj->id;
                        
            $receipt_detail->cheque_number = $post['PaymentReceiptsMaster']['cheque_number'] != null ? $post['PaymentReceiptsMaster']['cheque_number'] : '0';
            
            $bank_id = $post['PaymentReceiptsMaster']['bank'] != null ? $post['PaymentReceiptsMaster']['bank'] : 1;
            
            //var_dump($bank_id);exit;
            
            $bank_obj = PaymentBank::model()->findByPk($bank_id);
            $receipt_detail->bank_id = $bank_id;
            $receipt_detail->bank_name = $bank_obj->bank_name;
            $receipt_detail->amount = $receipt_master->amount_paid;
            
            if($receipt_detail->save()){
                return true;
            }
            
            
            return false;
            
        }
        
        
}
