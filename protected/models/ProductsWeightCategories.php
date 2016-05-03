<?php

/**
 * This is the model class for table "products_weight_categories".
 *
 * The followings are the available columns in table 'products_weight_categories':
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property double $maximum_weight
 * @property integer $unit_of_weight_id
 *
 * The followings are the available model relations:
 * @property ProductsMaster[] $productsMasters
 * @property ShippingUnitOfWeight $unitOfWeight
 */
class ProductsWeightCategories extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'products_weight_categories';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code, name, maximum_weight, unit_of_weight_id', 'required'),
			array('unit_of_weight_id', 'numerical', 'integerOnly'=>true),
			array('maximum_weight', 'numerical'),
			array('code', 'length', 'max'=>5),
			array('name', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, code, name, maximum_weight, unit_of_weight_id', 'safe', 'on'=>'search'),
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
			'productsMasters' => array(self::HAS_MANY, 'ProductsMaster', 'products_weight_category_id'),
			'unitOfWeight' => array(self::BELONGS_TO, 'ShippingUnitOfWeight', 'unit_of_weight_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'code' => 'Code',
			'name' => 'Name',
			'maximum_weight' => 'Maximum Weight',
			'unit_of_weight_id' => 'Unit Of Weight',
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
		$criteria->compare('code',$this->code,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('maximum_weight',$this->maximum_weight);
		$criteria->compare('unit_of_weight_id',$this->unit_of_weight_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProductsWeightCategories the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        
        function getFullSpec()
        {
            return '[Code: '.$this->code.'] [Label: '.$this->name.'] [Max Weight: '.$this->maximum_weight.']';
        }
}
