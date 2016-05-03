<?php

/**
 * This is the model class for table "payment_receipts_imports_mapping".
 *
 * The followings are the available columns in table 'payment_receipts_imports_mapping':
 * @property string $id
 * @property integer $old_receipt_no
 * @property integer $new_receipt_no
 * @property integer $sale_ref_no
 * @property string $created_at
 * @property string $updated_at
 * @property integer $user_id
 *
 * The followings are the available model relations:
 * @property PaymentReceiptsMaster $newReceiptNo
 */
class PaymentReceiptsImportsMapping extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'payment_receipts_imports_mapping';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('old_receipt_no, new_receipt_no, sale_ref_no, created_at, updated_at, user_id', 'required'),
			array('old_receipt_no, new_receipt_no, sale_ref_no, user_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, old_receipt_no, new_receipt_no, sale_ref_no, created_at, updated_at, user_id', 'safe', 'on'=>'search'),
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
			'newReceiptNo' => array(self::BELONGS_TO, 'PaymentReceiptsMaster', 'new_receipt_no'),
                        'oldReceiptNo' => array(self::BELONGS_TO, 'Customerreceipts', 'old_receipt_no'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'old_receipt_no' => 'Old Receipt No',
			'new_receipt_no' => 'New Receipt No',
			'sale_ref_no' => 'Sale Ref No',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
			'user_id' => 'User',
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
		$criteria->compare('old_receipt_no',$this->old_receipt_no);
		$criteria->compare('new_receipt_no',$this->new_receipt_no);
		$criteria->compare('sale_ref_no',$this->sale_ref_no);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);
		$criteria->compare('user_id',$this->user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PaymentReceiptsImportsMapping the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function addMappingEntry($old_rcpt,$new_rcpt,$saleref_no){
            
            $model = new PaymentReceiptsImportsMapping();
            $model->new_receipt_no = $new_rcpt;
            $model->old_receipt_no = $old_rcpt;
            $model->sale_ref_no = $saleref_no;
            $model->created_at = new CDbExpression('NOW()');
            $model->updated_at = new CDbExpression('NOW()');
            $model->user_id = yii::app()->user->userId;
            $model->save();
            
        }
}
