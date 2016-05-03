<?php

/**
 * This is the model class for table "customer_receiptmethodofpayment".
 *
 * The followings are the available columns in table 'customer_receiptmethodofpayment':
 * @property integer $refno
 * @property integer $receiptno
 * @property string $receiptstatus
 * @property string $bank
 * @property string $chequnumber
 * @property string $chequedate
 * @property double $amount
 * @property integer $deleted
 */
class CustomerReceiptmethodofpayment extends NmwndbActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'customer_receiptmethodofpayment';
	}
        
        public function getDbConnection()
        {
        return self::getNimavinMasterDbConnection();
        }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('receiptno, receiptstatus, bank, chequnumber, chequedate', 'required'),
			array('receiptno, deleted', 'numerical', 'integerOnly'=>true),
			array('amount', 'numerical'),
			array('receiptstatus', 'length', 'max'=>2),
			array('bank', 'length', 'max'=>10),
			array('chequnumber', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('refno, receiptno, receiptstatus, bank, chequnumber, chequedate, amount, deleted', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'refno' => 'Refno',
			'receiptno' => 'Receiptno',
			'receiptstatus' => 'Receiptstatus',
			'bank' => 'Bank',
			'chequnumber' => 'Chequnumber',
			'chequedate' => 'Chequedate',
			'amount' => 'Amount',
			'deleted' => 'Deleted',
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

		$criteria->compare('refno',$this->refno);
		$criteria->compare('receiptno',$this->receiptno);
		$criteria->compare('receiptstatus',$this->receiptstatus,true);
		$criteria->compare('bank',$this->bank,true);
		$criteria->compare('chequnumber',$this->chequnumber,true);
		$criteria->compare('chequedate',$this->chequedate,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('deleted',$this->deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CustomerReceiptmethodofpayment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
