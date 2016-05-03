<?php

/**
 * This is the model class for table "payment_model".
 *
 * The followings are the available columns in table 'payment_model':
 * @property integer $id
 * @property integer $payment_plan_master_id
 * @property integer $payment_plan_item_id
 * @property integer $is_installment_definer
 * @property integer $no_of_installments
 * @property double $installment_amount
 * @property double $interest
 * @property double $tax
 * @property double $total_payable
 * @property integer $payment_sequence
 * @property string $created_at
 * @property string $updated_at
 * @property integer $deleted
 */
class PaymentModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'payment_model';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('payment_plan_master_id, payment_plan_item_id, total_payable', 'required'),
			array('payment_plan_master_id, payment_plan_item_id, is_installment_definer, payment_sequence, no_of_installments, deleted', 'numerical', 'integerOnly'=>true),
			array('installment_amount, interest, tax, total_payable', 'numerical'),
			array('created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, payment_plan_master_id, payment_plan_item_id, is_installment_definer, no_of_installments, installment_amount, interest, tax, total_payable, payment_sequence, created_at, updated_at, deleted', 'safe', 'on'=>'search'),
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
                    'paymentPlanItem' => array(self::BELONGS_TO, 'PaymentPlanItems', 'payment_plan_item_id'),
                );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'payment_plan_master_id' => 'Payment Plan Master',
			'payment_plan_item_id' => 'Payment Plan Item',
			'is_installment_definer' => 'Is Installment Definer',
			'no_of_installments' => 'No Of Installments',
			'installment_amount' => 'Installment Amount',
			'interest' => 'Interest',
			'tax' => 'Tax',
			'total_payable' => 'Total Payable',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
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
		$criteria->compare('payment_plan_master_id',$this->payment_plan_master_id);
		$criteria->compare('payment_plan_item_id',$this->payment_plan_item_id);
		$criteria->compare('is_installment_definer',$this->is_installment_definer);
		$criteria->compare('no_of_installments',$this->no_of_installments);
		$criteria->compare('installment_amount',$this->installment_amount);
		$criteria->compare('interest',$this->interest);
		$criteria->compare('tax',$this->tax);
		$criteria->compare('total_payable',$this->total_payable);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);
		$criteria->compare('deleted',0);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PaymentModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public static function getInstallmentsDefinerRecord($id){
            $payment_model = PaymentModel::model()->findByAttributes(
                    array(
                        'payment_plan_master_id'=>$id,
                        'is_installment_definer'=>1,
                        )
                    );
            if($payment_model)
                return $payment_model->attributes;
            
            
            return array();
        }
        
        public function getAvailablePaymentPlanItems($payplan_master_id,$current_payplan_item){
            
            $criteria = new CDbCriteria();
            $criteria->compare('is_active', 1);
            $criteria->compare('deleted',0);
            $payplan_list = PaymentPlanItems::model()->findAll($criteria);
            $payplan_list = CHtml::listData($payplan_list, 'id', 'name');
            
            
            $criteria2 = new CDbCriteria();
            $criteria2->compare('payment_plan_master_id',$payplan_master_id);
            $criteria2->compare('deleted', 0);
            $payplan_model_items = PaymentModel::model()->findAll($criteria2);
            
            foreach ($payplan_model_items As $pl){
                if(key_exists($pl->payment_plan_item_id, $payplan_list)){
                    if($pl->payment_plan_item_id != $current_payplan_item){
                        unset($payplan_list[$pl->payment_plan_item_id]);
                    }
                }
            }
            
            
            if($payplan_list)
                    return $payplan_list;
            
            return array();
                    
                    
        }
        
        public function getCountOfPaymentPlanItems($payplan_master_id){
            $criteria2 = new CDbCriteria();
            $criteria2->compare('payment_plan_master_id',$payplan_master_id);
            $criteria2->compare('deleted', 0);
            $payplan_model_items = PaymentModel::model()->findAll($criteria2);
            
            if($payplan_model_items)
                return count($payplan_model_items);
            
            
            return 0;
        }
        
        public function getModelName()
        {
            return __CLASS__;
        }
        
        public function isPaymentModelUtilized($id){
            $repaymentSchema = RepaymentSchema::model()->findByAttributes(array('payment_model_id'=>$id));
            if(sizeof($repaymentSchema) > 0){
                    return true;
            }
            
            return false;
        }
        
        public function getTotalPayableByPplanMaster($payment_plan_master){
            
            $model = $this->model()->findAllByAttributes(
                                    array(
                                        'payment_plan_master_id'=>$payment_plan_master,
                                        'deleted'=>0,
                                    ));
            $t = 0;
            foreach($model As $m){
                if($m->is_installment_definer){
                    $t += $m->total_payable * $m->no_of_installments;
                }else{
                    $t += $m->total_payable;
                }
            }
            return $t;
            
        }
        
        public function getTotalPaid($facilty_master_id){
            
            $sqltot111="select sum(amount_paid) as total_paid FROM  payment_receipts_master WHERE facility_master_id='$facilty_master_id' AND deleted='0'";
            
            $total = Yii::app()->db->createCommand($sqltot111)->queryScalar();
            
            return $total;
        }
        
}
