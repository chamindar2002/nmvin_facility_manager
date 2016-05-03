<?php

/**
 * This is the model class for table "view_item_search".
 *
 * The followings are the available columns in table 'view_item_search':
 * @property integer $id
 * @property integer $make_id
 * @property integer $model_id
 * @property double $selling_price
 * @property integer $quantity
 * @property integer $is_active
 * @property string $make
 * @property string $model
 * @property string $scale
 * @property string $type
 * @property string $brand
 */
class ViewItemSearch extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'view_item_search';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('make_id, model_id, selling_price, quantity, is_active, make, model, scale, type, brand', 'required'),
			array('id, make_id, model_id, quantity, is_active', 'numerical', 'integerOnly'=>true),
			array('selling_price', 'numerical'),
			array('make, type', 'length', 'max'=>20),
			array('model', 'length', 'max'=>30),
			array('scale', 'length', 'max'=>10),
			array('brand', 'length', 'max'=>25),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, make_id, model_id, selling_price, quantity, is_active, make, model, scale, type, brand', 'safe', 'on'=>'search'),
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
			'make_id' => 'Make',
			'model_id' => 'Model',
			'selling_price' => 'Selling Price',
			'quantity' => 'Quantity',
			'is_active' => 'Is Active',
			'make' => 'Make',
			'model' => 'Model',
			'scale' => 'Scale',
			'type' => 'Type',
			'brand' => 'Brand',
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
		$criteria->compare('make_id',$this->make_id);
		$criteria->compare('model_id',$this->model_id);
		$criteria->compare('selling_price',$this->selling_price);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('make',$this->make,true);
		$criteria->compare('model',$this->model,true);
		$criteria->compare('scale',$this->scale,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('brand',$this->brand,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ViewItemSearch the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
