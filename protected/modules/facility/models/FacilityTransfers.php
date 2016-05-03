<?php

/**
 * This is the model class for table "facility_transfers".
 *
 * The followings are the available columns in table 'facility_transfers':
 * @property integer $id
 * @property integer $facility_master_id
 * @property integer $customer_id_original
 * @property integer $customer_id_new
 * @property string $created_at
 * @property string $updated_at
 * @property integer $added_by
 */
class FacilityTransfers extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'facility_transfers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('facility_master_id, customer_id_original, customer_id_new, created_at, added_by', 'required'),
			array('facility_master_id, customer_id_original, customer_id_new, added_by', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, facility_master_id, customer_id_original, customer_id_new, created_at, updated_at, added_by', 'safe', 'on'=>'search'),
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
			'facility_master_id' => 'Facility Master',
			'customer_id_original' => 'Customer Id Original (Transferer)',
			'customer_id_new' => 'Customer Id New (Transfaree)',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
			'added_by' => 'Added By',
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
		$criteria->compare('customer_id_original',$this->customer_id_original);
		$criteria->compare('customer_id_new',$this->customer_id_new);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);
		$criteria->compare('added_by',$this->added_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FacilityTransfers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
