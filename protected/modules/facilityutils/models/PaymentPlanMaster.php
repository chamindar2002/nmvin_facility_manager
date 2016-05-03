<?php

/**
 * This is the model class for table "payment_plan_master".
 *
 * The followings are the available columns in table 'payment_plan_master':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $assign_to_customer_id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $is_active
 * @property integer $deleted
 */
class PaymentPlanMaster extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'payment_plan_master';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('assign_to_customer_id, is_active, deleted', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('description, created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, description, assign_to_customer_id, created_at, updated_at, is_active, deleted', 'safe', 'on'=>'search'),
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
                    'facilityMasters' => array(self::HAS_MANY, 'FacilityMaster', 'payment_plan_master_id'),
                    'paymentModels' => array(self::HAS_MANY, 'PaymentModel', 'payment_plan_master_id'),
                    'customerDetails' => array(self::HAS_MANY, 'Customerdetails', 'assign_to_customer_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'description' => 'Description',
                        'assign_to_customer_id' => 'Assign To Customer',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
			'is_active' => 'Is Active',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
                $criteria->compare('assign_to_customer_id',$this->assign_to_customer_id);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);
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
	 * @return PaymentPlanMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function listPaymentPlans($customer_id = 1){
            $criteria = new CDbCriteria();
            $criteria->compare('deleted',0);
            $criteria->compare('is_active',1);
            $criteria->compare('assign_to_customer_id',1); //nimavin
            $pplan_defaults_obj = PaymentPlanMaster::model()->findAll($criteria);
            
            $data = array();
                       
            //$data_pplan_defaults = CHtml::listData($pplan_defaults_obj,'id','name');
            
            foreach($pplan_defaults_obj As $obj1){
                    $data[$obj1->id] = $obj1->name;
                    
            }
                
             if($customer_id !== 1 && $customer_id !== null){
                $criteria2 = new CDbCriteria();
                $criteria2->compare('deleted',0);
                $criteria2->compare('assign_to_customer_id',$customer_id);//customer specific
                $pplan_customer_obj  = PaymentPlanMaster::model()->findAll($criteria2);

                //$data_pplan_customer = CHtml::listData($pplan_customer_obj,'id','name');
                
                foreach($pplan_customer_obj As $obj2){
                    $data[$obj2->id] = $obj2->name;
                    
                }
                
                //return array_merge($data_pplan_defaults, $data_pplan_customer);
            }
            
            return $data;
            
        }
}
