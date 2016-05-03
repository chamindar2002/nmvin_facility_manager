<?php

/**
 * This is the model class for table "payment_receipt_details".
 *
 * The followings are the available columns in table 'payment_receipt_details':
 * @property string $id
 * @property integer $payment_receipt_master_id
 * @property integer $payment_type_id
 * @property integer $cheque_number
 * @property string $cheque_date
 * @property double $amount
 * @property string $created_at
 * @property string $updated_at
 *
 * The followings are the available model relations:
 * @property PaymentReceiptsMaster $paymentReceiptMaster
 * @property PaymentTypes $paymentType
 */
class PaymentReceiptDetails extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'payment_receipt_details';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('payment_receipt_master_id, payment_type_id, cheque_number, amount', 'required'),
			array('payment_receipt_master_id, payment_type_id', 'numerical', 'integerOnly'=>true),
			array('amount', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, payment_receipt_master_id, payment_type_id, cheque_number, cheque_date, amount, created_at, updated_at', 'safe', 'on'=>'search'),
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
			'paymentReceiptMaster' => array(self::BELONGS_TO, 'PaymentReceiptsMaster', 'payment_receipt_master_id'),
			'paymentType' => array(self::BELONGS_TO, 'PaymentTypes', 'payment_type_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'payment_receipt_master_id' => 'Payment Receipt Master',
			'payment_type_id' => 'Payment Type',
			'cheque_number' => 'Cheque Number',
			'cheque_date' => 'Cheque Date',
			'amount' => 'Amount',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('payment_receipt_master_id',$this->payment_receipt_master_id);
		$criteria->compare('payment_type_id',$this->payment_type_id);
		$criteria->compare('cheque_number',$this->cheque_number);
		$criteria->compare('cheque_date',$this->cheque_date,true);
		$criteria->compare('amount',$this->amount);
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
	 * @return PaymentReceiptDetails the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
