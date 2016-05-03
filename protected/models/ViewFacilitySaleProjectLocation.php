<?php

/**
 * This is the model class for table "view_facility_sale_project_location".
 *
 * The followings are the available columns in table 'view_facility_sale_project_location':
 * @property integer $facility_master_id
 * @property integer $customer_id
 * @property integer $payment_plan_master_id
 * @property integer $repayment_schema_generated
 * @property integer $is_active
 * @property integer $deleted
 * @property integer $sales_ref_no
 * @property integer $projectcode
 * @property string $project_name
 * @property integer $locationcode
 * @property string $location_name
 * @property string $location_city
 * @property string $blocknumber
 */
class ViewFacilitySaleProjectLocation extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'view_facility_sale_project_location';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('customer_id, payment_plan_master_id, project_name, location_name, location_city', 'required'),
			array('facility_master_id, customer_id, payment_plan_master_id, repayment_schema_generated, is_active, deleted, sales_ref_no, projectcode, locationcode', 'numerical', 'integerOnly'=>true),
			array('project_name, location_name, location_city, blocknumber', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('facility_master_id, customer_id, payment_plan_master_id, repayment_schema_generated, is_active, deleted, sales_ref_no, projectcode, project_name, locationcode, location_name, location_city, blocknumber', 'safe', 'on'=>'search'),
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
			'facility_master_id' => 'Facility Master',
			'customer_id' => 'Customer',
			'payment_plan_master_id' => 'Payment Plan Master',
			'repayment_schema_generated' => 'Repayment Schema Generated',
			'is_active' => 'Is Active',
			'deleted' => 'Deleted',
			'sales_ref_no' => 'Sales Ref No',
			'projectcode' => 'Projectcode',
			'project_name' => 'Project Name',
			'locationcode' => 'Locationcode',
			'location_name' => 'Location Name',
			'location_city' => 'Location City',
                        'blocknumber' => 'blocknumber',
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
		$criteria->compare('payment_plan_master_id',$this->payment_plan_master_id);
		$criteria->compare('repayment_schema_generated',$this->repayment_schema_generated);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('deleted',$this->deleted);
		$criteria->compare('sales_ref_no',$this->sales_ref_no);
		$criteria->compare('projectcode',$this->projectcode);
		$criteria->compare('project_name',$this->project_name,true);
		$criteria->compare('locationcode',$this->locationcode);
		$criteria->compare('location_name',$this->location_name,true);
		$criteria->compare('location_city',$this->location_city,true);
                $criteria->compare('location_city',$this->blocknumber,true);
                

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ViewFacilitySaleProjectLocation the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public static function listProjects(){
            $c = new CDbCriteria();
            $c->group = 'locationcode';
            
            $data = self::model()->findAll($c);
            
            return CHtml::listData($data,'locationcode','location_name');
        }
}
