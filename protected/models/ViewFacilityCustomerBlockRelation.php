<?php

/**
 * This is the model class for table "view_facility_customer_block_relation".
 *
 * The followings are the available columns in table 'view_facility_customer_block_relation':
 * @property integer $facility_master_id
 * @property integer $customer_id
 * @property integer $sales_ref_no
 * @property integer $is_active
 * @property integer $deleted
 * @property integer $customercode
 * @property string $familyname
 * @property string $firstname
 * @property string $addressline1
 * @property string $addressline2
 * @property string $passportno
 * @property string $mobile
 * @property string $blocknumber
 */
class ViewFacilityCustomerBlockRelation extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'view_facility_customer_block_relation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('customer_id, sales_ref_no, familyname, firstname, addressline1, addressline2, passportno, blocknumber', 'required'),
			array('facility_master_id, customer_id, sales_ref_no, is_active, deleted, customercode', 'numerical', 'integerOnly'=>true),
			array('familyname, firstname, addressline1, addressline2, passportno, mobile, blocknumber', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('facility_master_id, customer_id, sales_ref_no, is_active, deleted, customercode, familyname, firstname, addressline1, addressline2, passportno, mobile, blocknumber', 'safe', 'on'=>'search'),
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
			'facility_master_id' => 'Facility Master',
			'customer_id' => 'Customer',
			'sales_ref_no' => 'Sales Ref No',
			'is_active' => 'Is Active',
			'deleted' => 'Deleted',
			'customercode' => 'Customercode',
			'familyname' => 'Familyname',
			'firstname' => 'Firstname',
			'addressline1' => 'Addressline1',
			'addressline2' => 'Addressline2',
			'passportno' => 'Passportno',
			'mobile' => 'Mobile',
			'blocknumber' => 'Blocknumber',
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

		$criteria->compare('facility_master_id',$this->facility_master_id);
		$criteria->compare('customer_id',$this->customer_id);
		$criteria->compare('sales_ref_no',$this->sales_ref_no);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('deleted',$this->deleted);
		$criteria->compare('customercode',$this->customercode);
		$criteria->compare('familyname',$this->familyname,true);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('addressline1',$this->addressline1,true);
		$criteria->compare('addressline2',$this->addressline2,true);
		$criteria->compare('passportno',$this->passportno,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('blocknumber',$this->blocknumber,true);
		$criteria->compare('project_name',$this->project_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ViewFacilityCustomerBlockRelation the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
