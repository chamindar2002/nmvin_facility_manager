<?php

/**
 * This is the model class for table "refunded_receipts".
 *
 * The followings are the available columns in table 'refunded_receipts':
 * @property integer $refund_id
 * @property integer $receipt_id
 *
 * The followings are the available model relations:
 * @property FacilityRefunds $refund
 * @property PaymentReceiptsMaster $receipt
 */
class RefundedReceipts extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'refunded_receipts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('refund_id, receipt_id', 'required'),
			array('refund_id, receipt_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('refund_id, receipt_id', 'safe', 'on'=>'search'),
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
			'refund' => array(self::BELONGS_TO, 'FacilityRefunds', 'refund_id'),
			'receipt' => array(self::BELONGS_TO, 'PaymentReceiptsMaster', 'receipt_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'refund_id' => 'Refund',
			'receipt_id' => 'Receipt',
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

		$criteria->compare('refund_id',$this->refund_id);
		$criteria->compare('receipt_id',$this->receipt_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RefundedReceipts the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
