<?php

/**
 * This is the model class for table "house_ownership_tranfers".
 *
 * The followings are the available columns in table 'house_ownership_tranfers':
 * @property integer $refno
 * @property integer $customercode_current
 * @property integer $customercode_previous
 * @property integer $salerefno
 * @property integer $blockrefnumber
 * @property integer $other1
 * @property double $other2
 * @property string $other3
 * @property integer $addedby
 * @property string $addeddate
 * @property string $addedtime
 */
class HouseOwnershipTranfers extends NmwndbActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'house_ownership_tranfers';
	}
        
        public function getDbConnection()
        {
        return self::getNimavinMasterDbConnection();
        }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('customercode_current, customercode_previous, salerefno, blockrefnumber', 'required'),
			array('customercode_current, customercode_previous, salerefno, blockrefnumber, other1, addedby', 'numerical', 'integerOnly'=>true),
			array('other2', 'numerical'),
			array('other3', 'length', 'max'=>150),
			array('addeddate, addedtime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('refno, customercode_current, customercode_previous, salerefno, blockrefnumber, other1, other2, other3, addedby, addeddate, addedtime', 'safe', 'on'=>'search'),
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
			'refno' => 'Refno',
			'customercode_current' => 'Customercode Current',
			'customercode_previous' => 'Customercode Previous',
			'salerefno' => 'Salerefno',
			'blockrefnumber' => 'Blockrefnumber',
			'other1' => 'Other1',
			'other2' => 'Other2',
			'other3' => 'Other3',
			'addedby' => 'Addedby',
			'addeddate' => 'Addeddate',
			'addedtime' => 'Addedtime',
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

		$criteria->compare('refno',$this->refno);
		$criteria->compare('customercode_current',$this->customercode_current);
		$criteria->compare('customercode_previous',$this->customercode_previous);
		$criteria->compare('salerefno',$this->salerefno);
		$criteria->compare('blockrefnumber',$this->blockrefnumber);
		$criteria->compare('other1',$this->other1);
		$criteria->compare('other2',$this->other2);
		$criteria->compare('other3',$this->other3,true);
		$criteria->compare('addedby',$this->addedby);
		$criteria->compare('addeddate',$this->addeddate,true);
		$criteria->compare('addedtime',$this->addedtime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HouseOwnershipTranfers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
