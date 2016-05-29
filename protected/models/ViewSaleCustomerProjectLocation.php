<?php

/**
 * This is the model class for table "view_sale_customer_project_location".
 *
 * The followings are the available columns in table 'view_sale_customer_project_location':
 * @property integer $blockrefnumber
 * @property integer $sales_ref_no
 * @property integer $projectcode
 * @property string $project_name
 * @property integer $locationcode
 * @property string $location_name
 * @property string $location_city
 * @property string $blocknumber
 * @property integer $customercode
 * @property string $firstname
 * @property string $familyname
 * @property string $passportno
 */
class ViewSaleCustomerProjectLocation extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'view_sale_customer_project_location';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('customercode, projectcode, blockrefnumber', 'required'),
			//array('blockrefnumber, project_name, location_name, location_city, blocknumber, firstname, familyname, passportno, customercode', 'required'),
			array('blockrefnumber, sales_ref_no, projectcode, locationcode, customercode', 'numerical', 'integerOnly'=>true),
			array('project_name, location_name, location_city, blocknumber, firstname, familyname, passportno', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('blockrefnumber, sales_ref_no, projectcode, project_name, locationcode, location_name, location_city, blocknumber, customercode, firstname, familyname, passportno', 'safe', 'on'=>'search'),
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
			'blockrefnumber' => 'Block Number',
			'sales_ref_no' => 'Sales Ref No',
			'projectcode' => 'Project',
			'project_name' => 'Project Name',
			'locationcode' => 'Locationcode',
			'location_name' => 'Location Name',
			'location_city' => 'Location City',
			'blocknumber' => 'Blocknumber',
			'customercode' => 'Customercode',
			'firstname' => 'Firstname',
			'familyname' => 'Familyname',
			'passportno' => 'Passportno',
			'addeddate' => 'Date'
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

		$criteria->compare('blockrefnumber',$this->blockrefnumber);
		$criteria->compare('sales_ref_no',$this->sales_ref_no);
		$criteria->compare('addeddate',$this->addeddate);
		$criteria->compare('projectcode',$this->projectcode);
		$criteria->compare('project_name',$this->project_name,true);
		$criteria->compare('locationcode',$this->locationcode);
		$criteria->compare('location_name',$this->location_name,true);
		$criteria->compare('location_city',$this->location_city,true);
		$criteria->compare('blocknumber',$this->blocknumber,true);
		$criteria->compare('customercode',$this->customercode);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('familyname',$this->familyname,true);
		$criteria->compare('passportno',$this->passportno,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,

			'sort'=>array(
				'defaultOrder'=>'sales_ref_no DESC',
			),
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
	 * @return ViewSaleCustomerProjectLocation the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
