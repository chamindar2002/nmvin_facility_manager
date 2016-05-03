<?php

/**
 * This is the model class for table "facility_refunds".
 *
 * The followings are the available columns in table 'facility_refunds':
 * @property integer $id
 * @property integer $facility_master_id
 * @property integer $customer_id
 * @property string $customer_name
 * @property string $block_name
 * @property integer $refunded_by
 * @property string $created_date
 * @property string $refunded_amount
 *
 * The followings are the available model relations:
 * @property FacilityMaster $facilityMaster
 */
class FacilityRefunds extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'facility_refunds';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('facility_master_id, customer_id, customer_name, block_name, refunded_by, refunded_amount', 'required'),
			array('facility_master_id, customer_id, refunded_by', 'numerical', 'integerOnly'=>true),
			array('block_name', 'length', 'max'=>100),
			array('refunded_amount', 'length', 'max'=>10),
			array('created_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, facility_master_id, customer_id, customer_name, block_name, refunded_by, created_date, refunded_amount', 'safe', 'on'=>'search'),
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
			'facilityMaster' => array(self::BELONGS_TO, 'FacilityMaster', 'facility_master_id'),
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
			'block_name' => 'Block Name',
			'refunded_by' => 'Refunded By',
			'created_date' => 'Created Date',
			'refunded_amount' => 'Refunded Amount',
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
		$criteria->compare('block_name',$this->block_name,true);
		$criteria->compare('refunded_by',$this->refunded_by);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('refunded_amount',$this->refunded_amount,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FacilityRefunds the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
