<?php

/**
 * This is the model class for table "view_receipt_master_detail".
 *
 * The followings are the available columns in table 'view_receipt_master_detail':
 * @property integer $id
 * @property integer $facility_master_id
 * @property integer $customer_id
 * @property string $customer_name
 * @property string $customer_address
 * @property integer $transaction_id
 * @property double $amount_paid
 * @property string $receipt_date
 * @property integer $addedby
 * @property string $created_at
 * @property string $name_of_scheme
 * @property string $house_number
 * @property double $value_of_house
 * @property string $details
 * @property integer $old_receipt_no
 * @property integer $deleted
 * @property integer $payment_type_id
 * @property string $payment_type
 * @property string $cheque_number
 * @property integer $bank_id
 * @property string $bank_name
 * @property string $cheque_date
 * @property double $amount
 */
class ViewReceiptMasterDetail extends CActiveRecord
{
    public $total_paid;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'view_receipt_master_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('facility_master_id, customer_id, customer_name, customer_address, transaction_id, amount_paid, receipt_date, payment_type_id, payment_type, cheque_number, bank_id, bank_name, amount', 'required'),
			array('id, facility_master_id, customer_id, transaction_id, addedby, old_receipt_no, deleted, payment_type_id, bank_id', 'numerical', 'integerOnly'=>true),
			array('amount_paid, value_of_house, amount', 'numerical'),
			array('customer_name, name_of_scheme, house_number, details', 'length', 'max'=>255),
			array('payment_type, cheque_number', 'length', 'max'=>20),
			array('bank_name', 'length', 'max'=>25),
			array('created_at, cheque_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, facility_master_id, customer_id, customer_name, customer_address, transaction_id, amount_paid, receipt_date, addedby, created_at, name_of_scheme, house_number, value_of_house, details, old_receipt_no, deleted, payment_type_id, payment_type, cheque_number, bank_id, bank_name, cheque_date, amount', 'safe', 'on'=>'search'),
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
			'receipt_date' => 'Receipt Date',
			'addedby' => 'Addedby',
			'created_at' => 'Created At',
			'name_of_scheme' => 'Name Of Scheme',
			'house_number' => 'House Number',
			'value_of_house' => 'Value Of House',
			'details' => 'Details',
			'old_receipt_no' => 'Old Receipt No',
			'deleted' => 'Deleted',
			'payment_type_id' => 'Payment Type',
			'payment_type' => 'Payment Type',
			'cheque_number' => 'Cheque Number',
			'bank_id' => 'Bank',
			'bank_name' => 'Bank Name',
			'cheque_date' => 'Cheque Date',
			'amount' => 'Amount',
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
		$criteria->compare('addedby',$this->addedby);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('name_of_scheme',$this->name_of_scheme,true);
		$criteria->compare('house_number',$this->house_number,true);
		$criteria->compare('value_of_house',$this->value_of_house);
		$criteria->compare('details',$this->details,true);
		$criteria->compare('old_receipt_no',$this->old_receipt_no);
		$criteria->compare('deleted',$this->deleted);
		$criteria->compare('payment_type_id',$this->payment_type_id);
		$criteria->compare('payment_type',$this->payment_type,true);
		$criteria->compare('cheque_number',$this->cheque_number,true);
		$criteria->compare('bank_id',$this->bank_id);
		$criteria->compare('bank_name',$this->bank_name,true);
		$criteria->compare('cheque_date',$this->cheque_date,true);
		$criteria->compare('amount',$this->amount);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ViewReceiptMasterDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
