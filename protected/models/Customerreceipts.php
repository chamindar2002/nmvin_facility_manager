<?php

/**
 * This is the model class for table "customerreceipts".
 *
 * The followings are the available columns in table 'customerreceipts':
 * @property integer $receiptno
 * @property integer $salerefno
 * @property integer $locationcode
 * @property integer $projectcode
 * @property integer $customercode
 * @property string $receiptdate
 * @property string $oldreceiptno
 * @property integer $blocknumber
 * @property string $paidfor
 * @property integer $paymenttype
 * @property double $paidamount
 * @property integer $deleted
 * @property integer $addedby
 * @property string $addeddate
 * @property string $addedtime
 * @property integer $lastmodifiedby
 * @property string $lastmodifieddate
 * @property string $lastmodifiedtime
 * @property integer $deletedby
 * @property string $deleteddate
 * @property string $deletedtime
 */
class Customerreceipts extends NmwndbActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'customerreceipts';
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
			array('salerefno, locationcode, projectcode, customercode, receiptdate, blocknumber, paidfor, paymenttype, paidamount', 'required'),
			array('salerefno, locationcode, projectcode, customercode, blocknumber, paymenttype, deleted, addedby, lastmodifiedby, deletedby', 'numerical', 'integerOnly'=>true),
			array('paidamount', 'numerical'),
			array('oldreceiptno', 'length', 'max'=>20),
			array('paidfor', 'length', 'max'=>10),
			array('addeddate, addedtime, lastmodifieddate, lastmodifiedtime, deleteddate, deletedtime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('receiptno, salerefno, locationcode, projectcode, customercode, receiptdate, oldreceiptno, blocknumber, paidfor, paymenttype, paidamount, deleted, addedby, addeddate, addedtime, lastmodifiedby, lastmodifieddate, lastmodifiedtime, deletedby, deleteddate, deletedtime', 'safe', 'on'=>'search'),
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
			'receiptno' => 'Receiptno',
			'salerefno' => 'Salerefno',
			'locationcode' => 'Locationcode',
			'projectcode' => 'Projectcode',
			'customercode' => 'Customercode',
			'receiptdate' => 'Receiptdate',
			'oldreceiptno' => 'Oldreceiptno',
			'blocknumber' => 'Blocknumber',
			'paidfor' => 'Paidfor',
			'paymenttype' => 'Paymenttype',
			'paidamount' => 'Paidamount',
			'deleted' => 'Deleted',
			'addedby' => 'Addedby',
			'addeddate' => 'Addeddate',
			'addedtime' => 'Addedtime',
			'lastmodifiedby' => 'Lastmodifiedby',
			'lastmodifieddate' => 'Lastmodifieddate',
			'lastmodifiedtime' => 'Lastmodifiedtime',
			'deletedby' => 'Deletedby',
			'deleteddate' => 'Deleteddate',
			'deletedtime' => 'Deletedtime',
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

		$criteria->compare('receiptno',$this->receiptno);
		$criteria->compare('salerefno',$this->salerefno);
		$criteria->compare('locationcode',$this->locationcode);
		$criteria->compare('projectcode',$this->projectcode);
		$criteria->compare('customercode',$this->customercode);
		$criteria->compare('receiptdate',$this->receiptdate,true);
		$criteria->compare('oldreceiptno',$this->oldreceiptno,true);
		$criteria->compare('blocknumber',$this->blocknumber);
		$criteria->compare('paidfor',$this->paidfor,true);
		$criteria->compare('paymenttype',$this->paymenttype);
		$criteria->compare('paidamount',$this->paidamount);
		$criteria->compare('deleted',$this->deleted);
		$criteria->compare('addedby',$this->addedby);
		$criteria->compare('addeddate',$this->addeddate,true);
		$criteria->compare('addedtime',$this->addedtime,true);
		$criteria->compare('lastmodifiedby',$this->lastmodifiedby);
		$criteria->compare('lastmodifieddate',$this->lastmodifieddate,true);
		$criteria->compare('lastmodifiedtime',$this->lastmodifiedtime,true);
		$criteria->compare('deletedby',$this->deletedby);
		$criteria->compare('deleteddate',$this->deleteddate,true);
		$criteria->compare('deletedtime',$this->deletedtime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Customerreceipts the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
