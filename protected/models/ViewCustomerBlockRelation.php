<?php

/**
 * This is the model class for table "view_customer_block_relation".
 *
 * The followings are the available columns in table 'view_customer_block_relation':
 * @property integer $customercode
 * @property string $familyname
 * @property string $firstname
 * @property string $title
 * @property string $addressline1
 * @property string $addressline2
 * @property string $passportno
 * @property string $mobile
 * @property string $blocknumber
 * @property integer $refno
 * @property integer $projectcode
 * @property string $project_name
 */
class ViewCustomerBlockRelation extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'view_customer_block_relation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('familyname, firstname, addressline1, addressline2, passportno, blocknumber, projectcode, project_name', 'required'),
			array('customercode, refno, projectcode', 'numerical', 'integerOnly'=>true),
			array('familyname, firstname, addressline1, addressline2, passportno, mobile, blocknumber, project_name', 'length', 'max'=>100),
			array('title', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('customercode, familyname, firstname, title, addressline1, addressline2, passportno, mobile, blocknumber, refno, projectcode, project_name', 'safe', 'on'=>'search'),
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
			'customercode' => 'Customercode',
			'familyname' => 'Familyname',
			'firstname' => 'Firstname',
			'title' => 'Title',
			'addressline1' => 'Addressline1',
			'addressline2' => 'Addressline2',
			'passportno' => 'Passportno',
			'mobile' => 'Mobile',
			'blocknumber' => 'Blocknumber',
			'refno' => 'Refno',
			'projectcode' => 'Projectcode',
			'project_name' => 'Project Name',
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

		$criteria->compare('customercode',$this->customercode);
		$criteria->compare('familyname',$this->familyname,true);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('addressline1',$this->addressline1,true);
		$criteria->compare('addressline2',$this->addressline2,true);
		$criteria->compare('passportno',$this->passportno,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('blocknumber',$this->blocknumber,true);
		$criteria->compare('refno',$this->refno);
		$criteria->compare('projectcode',$this->projectcode);
		$criteria->compare('project_name',$this->project_name,true);

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
	 * @return ViewCustomerBlockRelation the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
