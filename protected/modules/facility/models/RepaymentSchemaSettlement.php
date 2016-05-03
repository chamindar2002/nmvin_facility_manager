<?php

/**
 * This is the model class for table "repayment_schema_settlement".
 *
 * The followings are the available columns in table 'repayment_schema_settlement':
 * @property string $id
 * @property integer $facility_master_id
 * @property integer $payment_receipt_master_id
 * @property integer $repayment_schema_id
 * @property integer $paid_full
 * @property double $amount_payable
 * @property double $amount_paid
 * @property double $balance_bf
 * @property string $created_at
 * @property string $updated_at
 * @property string $comment
 * @property integer $deleted
 *
 * The followings are the available model relations:
 * @property PaymentReceiptsMaster $paymentReceiptMaster
 * @property RepaymentSchema $repaymentSchema
 * @property FacilityMaster $facilityMaster
 */
class RepaymentSchemaSettlement extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'repayment_schema_settlement';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('facility_master_id, payment_receipt_master_id, repayment_schema_id, paid_full, amount_payable, amount_paid, balance_bf, created_at', 'required'),
            array('facility_master_id, payment_receipt_master_id, repayment_schema_id, paid_full, deleted', 'numerical', 'integerOnly'=>true),
            array('amount_payable, amount_paid, balance_bf', 'numerical'),
            array('updated_at, comment', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, facility_master_id, payment_receipt_master_id, repayment_schema_id, paid_full, amount_payable, amount_paid, balance_bf, created_at, updated_at, comment, deleted', 'safe', 'on'=>'search'),
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
            'repaymentSchema' => array(self::BELONGS_TO, 'RepaymentSchema', 'repayment_schema_id'),
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
            'payment_receipt_master_id' => 'Payment Receipt Master',
            'repayment_schema_id' => 'Repayment Schema',
            'paid_full' => 'Paid Full',
            'amount_payable' => 'Amount Payable',
            'amount_paid' => 'Amount Paid',
            'balance_bf' => 'Balance Bf',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'comment' => 'Comment',
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

        $criteria->compare('id',$this->id,true);
        $criteria->compare('facility_master_id',$this->facility_master_id);
        $criteria->compare('payment_receipt_master_id',$this->payment_receipt_master_id);
        $criteria->compare('repayment_schema_id',$this->repayment_schema_id);
        $criteria->compare('paid_full',$this->paid_full);
        $criteria->compare('amount_payable',$this->amount_payable);
        $criteria->compare('amount_paid',$this->amount_paid);
        $criteria->compare('balance_bf',$this->balance_bf);
        $criteria->compare('created_at',$this->created_at,true);
        $criteria->compare('updated_at',$this->updated_at,true);
        $criteria->compare('comment',$this->comment,true);
        $criteria->compare('deleted',$this->deleted);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return RepaymentSchemaSettlement the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    
    public function voidAllSettlementsOnFacilityMaster($facility_master_id){
        
        $sql="UPDATE `nmwndb_asiast`.`repayment_schema_settlement`
              SET `deleted` = '1'
              WHERE `repayment_schema_settlement`.`facility_master_id` = $facility_master_id";
	Yii::app()->db->createCommand($sql)->query();
    }
    
    public function getRepaymentSettlementsByReceiptId($receipt_id,$show_minimal = false){
        
        $criteria = new CDbCriteria();
        $criteria->compare('payment_receipt_master_id',$receipt_id);
        $criteria->compare('deleted',0);
        $stlmntObj = self::model()->findAll($criteria);
        
        $data = array();
        $data_minimal = array(1=>'');
        
        $installment_count = array();
        $installment_count_part = array();
        $other_repayments = array();
        $other_repayments_part = array();
        
        foreach($stlmntObj As $so){
            $paymentModel = PaymentModel::model()->findByPk($so->repaymentSchema->payment_model_id);
            if($so->repaymentSchema->installment_number > 0){
                /*
                 * if installment display installment number
                 */
                if($so->balance_bf < 0){
                    $data[] = $paymentModel->paymentPlanItem->name.' '.$so->repaymentSchema->installment_number.' (Part)';
                    $installment_count_part[] = $so->repaymentSchema->installment_number;
                }else{
                    $data[] = $paymentModel->paymentPlanItem->name.' '.$so->repaymentSchema->installment_number;
                    $installment_count[] = $so->repaymentSchema->installment_number;
                }
                
                //$installment_count++;
                
            }else{
                if($so->balance_bf < 0){
                    $data[] = $paymentModel->paymentPlanItem->name.' (Part)';
                    $other_repayments_part[] = $paymentModel->paymentPlanItem->name;
                }else{
                    $data[] = $paymentModel->paymentPlanItem->name;
                    $other_repayments[] = $paymentModel->paymentPlanItem->name;
                }
            }
            
        }
        
        if(count($installment_count) > 1){
            
           $data_minimal[1] = 'Intallment '.$installment_count[0].'-'.end($installment_count).',';
        }
        
        if(count($installment_count) == 1){
            $data_minimal[1] = 'Intallment '.$installment_count[0].',';
        }
        
        if(count($installment_count_part) > 0){
            $data_minimal[1] .= 'Intallment(P) '.end($installment_count_part).',';
        }
        
        if(count($other_repayments) > 0){
            foreach($other_repayments As $key=>$value){
                $data_minimal[1] .= substr($value,0,14).',';
            }
        }
        
        if(count($other_repayments_part) > 0){
            foreach($other_repayments_part As $key=>$value){
                $data_minimal[1] .= substr($value,0,14).'(P)'.',';
            }
        }
           
        
        if(!$show_minimal){
            return $data;
        }else{
        //return $data_minimal;
            return $data = array(substr($data_minimal[1],0,-1));
        }
    }
}