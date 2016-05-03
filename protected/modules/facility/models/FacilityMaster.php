<?php

/**
 * This is the model class for table "facility_master".
 *
 * The followings are the available columns in table 'facility_master':
 * @property integer $id
 * @property integer $customer_id
 * @property integer $sales_ref_no
 * @property integer $payment_plan_master_id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $is_active
 * @property integer $deleted
 * @property integer $repayment_schema_generated
 * @property integer $is_refunded
 */
class FacilityMaster extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
    
        public $is_deletable = false;     
    
	public function tableName()
	{
		return 'facility_master';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('customer_id, payment_plan_master_id, sales_ref_no', 'required'),
			array('customer_id, payment_plan_master_id, sales_ref_no, is_active, repayment_schema_generated, deleted', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, customer_id, payment_plan_master_id, sales_ref_no, created_at, updated_at, is_active,repayment_schema_generated, deleted, is_refunded', 'safe', 'on'=>'search'),
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
                    'paymentPlanMaster' => array(self::BELONGS_TO, 'PaymentPlanMaster', 'payment_plan_master_id'),
                    'customerDetails' => array(self::BELONGS_TO, 'Customerdetails', 'customer_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'customer_id' => 'Customer',
			'payment_plan_master_id' => 'Payment Plan Master',
                        'sales_ref_no' => 'Sale Details',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
			'is_active' => 'Is Active',
			'deleted' => 'Deleted',
                        'repayment_schema_generated' => 'Repayment Schema Generated',
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
		$criteria->compare('customer_id',$this->customer_id);
		$criteria->compare('payment_plan_master_id',$this->payment_plan_master_id);
                $criteria->compare('sales_ref_no',$this->sales_ref_no);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);
                $criteria->compare('repayment_schema_generated',$this->repayment_schema_generated);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('deleted',0);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FacilityMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public static function getValidFacility($customer_id){
            $c = new CDbCriteria();
            $c->compare('deleted', 0);
            $c->compare('customer_id', $customer_id);
            
            return self::model()->findAll($c);
        }
        
        
}
