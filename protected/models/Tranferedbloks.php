<?php

/**
 * This is the model class for table "tranferedbloks".
 *
 * The followings are the available columns in table 'tranferedbloks':
 * @property integer $refno
 * @property integer $customercode
 * @property integer $salerefno
 * @property integer $blockrefnumber_previous
 * @property integer $blockrefnumber_current
 * @property integer $currentblock_previouscustomer
 * @property integer $other1
 * @property double $other2
 * @property string $other3
 * @property integer $addedby
 * @property string $addeddate
 * @property string $addedtime
 */
class Tranferedbloks extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tranferedbloks';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('customercode, salerefno, blockrefnumber_previous, blockrefnumber_current, currentblock_previouscustomer', 'required'),
			array('customercode, salerefno, blockrefnumber_previous, blockrefnumber_current, currentblock_previouscustomer, other1, addedby', 'numerical', 'integerOnly'=>true),
			array('other2', 'numerical'),
			array('other3', 'length', 'max'=>150),
			array('addeddate, addedtime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('refno, customercode, salerefno, blockrefnumber_previous, blockrefnumber_current, currentblock_previouscustomer, other1, other2, other3, addedby, addeddate, addedtime', 'safe', 'on'=>'search'),
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
			'customercode' => 'Customercode',
			'salerefno' => 'Salerefno',
			'blockrefnumber_previous' => 'Blockrefnumber Previous',
			'blockrefnumber_current' => 'Blockrefnumber Current',
			'currentblock_previouscustomer' => 'Currentblock Previouscustomer',
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
		$criteria->compare('customercode',$this->customercode);
		$criteria->compare('salerefno',$this->salerefno);
		$criteria->compare('blockrefnumber_previous',$this->blockrefnumber_previous);
		$criteria->compare('blockrefnumber_current',$this->blockrefnumber_current);
		$criteria->compare('currentblock_previouscustomer',$this->currentblock_previouscustomer);
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
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()->db2;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tranferedbloks the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
