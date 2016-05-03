<?php

/**
 * This is the model class for table "payment_receipt_print_counter".
 *
 * The followings are the available columns in table 'payment_receipt_print_counter':
 * @property integer $id
 * @property integer $receipt_master_id
 * @property integer $printed_by
 * @property string $created_at
 * @property string $updated_at
 */
class PaymentReceiptPrintCounter extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'payment_receipt_print_counter';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('receipt_master_id, printed_by, created_at, updated_at', 'required'),
			array('receipt_master_id, printed_by', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, receipt_master_id, printed_by, created_at, updated_at', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'receipt_master_id' => 'Receipt Master',
			'printed_by' => 'Printed By',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
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
		$criteria->compare('receipt_master_id',$this->receipt_master_id);
		$criteria->compare('printed_by',$this->printed_by);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PaymentReceiptPrintCounter the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public static function addPrintReceiptCounterRecord($receipt_id){
            $model = new PaymentReceiptPrintCounter;
            $model->receipt_master_id = $receipt_id;
            $model->printed_by = yii::app()->user->userId;
            $model->created_at = new CDbExpression('NOW()');
            $model->updated_at = new CDbExpression('NOW()');
            $model->save();
        }
        
        public static function isDuplicate($receipt_id){
            
            $model = PaymentReceiptPrintCounter::model()->findByAttributes(array('receipt_master_id'=>$receipt_id));
            
            if(sizeof($model) > 0)
                        return true;
            
            
            return false;
        }
}
