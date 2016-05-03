<?php

/**
 * This is the model class for table "payment_bank".
 *
 * The followings are the available columns in table 'payment_bank':
 * @property integer $id
 * @property string $bank_code
 * @property string $bank_name
 * @property integer $sort_order
 * @property string $created_at
 * @property string $updated_at
 * @property integer $deleted
 */
class PaymentBank extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'payment_bank';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('bank_code, bank_name, sort_order, created_at, updated_at', 'required'),
			array('sort_order, deleted', 'numerical', 'integerOnly'=>true),
			array('bank_code', 'length', 'max'=>20),
			array('bank_name', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, bank_code, bank_name, sort_order, created_at, updated_at, deleted', 'safe', 'on'=>'search'),
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
			'bank_code' => 'Bank Code',
			'bank_name' => 'Bank Name',
			'sort_order' => 'Sort Order',
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
		$criteria->compare('bank_code',$this->bank_code,true);
		$criteria->compare('bank_name',$this->bank_name,true);
		$criteria->compare('sort_order',$this->sort_order);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);
		$criteria->compare('deleted',$this->deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PaymentBank the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
