<?php

/**
 * This is the model class for table "customerdetails".
 *
 * The followings are the available columns in table 'customerdetails':
 * @property integer $customercode
 * @property string $title
 * @property string $familyname
 * @property string $firstname
 * @property string $addressline1
 * @property string $addressline2
 * @property string $postcode
 * @property string $country
 * @property string $email
 * @property string $Skype
 * @property string $landline
 * @property string $mobile
 * @property string $workphone
 * @property string $fax
 * @property string $proffession
 * @property string $gender
 * @property string $passportno
 * @property string $sladdressline1
 * @property string $sladdressline2
 * @property string $sladdressline3
 * @property string $sllandline
 * @property string $slmobile
 * @property string $slcontactperson
 * @property integer $onlineuserid
 * @property integer $deleted
 * @property integer $addedby
 * @property string $addeddate
 * @property string $addedtime
 * @property integer $lastmodifiedby
 * @property string $lastmodifieddate
 * @property string $lastmodifiedtime
 * @property integer $deletedby
 * @property string $deleteddate
 * @property string $deletedtime
 */
class Customerdetails extends NmwndbActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'customerdetails';
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
			array('familyname, firstname, addressline1, addressline2, landline, passportno, mobile', 'required'),
			array('passportno', 'unique', 'message' => "This ID/Passport number already exists."),
			array('onlineuserid, deleted, addedby, lastmodifiedby, deletedby', 'numerical', 'integerOnly'=>true),
			array('title, gender', 'length', 'max'=>10),
			array('familyname, firstname, addressline1, addressline2, email, Skype, landline, mobile, workphone, fax, proffession, passportno, sladdressline1, sladdressline2, sladdressline3, sllandline, slmobile, slcontactperson', 'length', 'max'=>100),
			array('postcode', 'length', 'max'=>20),
			array('country', 'length', 'max'=>50),
			array('addeddate, addedtime, lastmodifieddate, lastmodifiedtime, deleteddate, deletedtime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('customercode, title, familyname, firstname, addressline1, addressline2, postcode, country, email, Skype, landline, mobile, workphone, fax, proffession, gender, passportno, sladdressline1, sladdressline2, sladdressline3, sllandline, slmobile, slcontactperson, onlineuserid, deleted, addedby, addeddate, addedtime, lastmodifiedby, lastmodifieddate, lastmodifiedtime, deletedby, deleteddate, deletedtime', 'safe', 'on'=>'search'),
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
			'title' => 'Title',
			'familyname' => 'Family Name',
			'firstname' => 'First Name',
			'addressline1' => 'Address Line 1',
			'addressline2' => 'Address Line 2',
			'postcode' => 'Postcode',
			'country' => 'Country',
			'email' => 'Email',
			'Skype' => 'Skype',
			'landline' => 'Landline',
			'mobile' => 'Mobile',
			'workphone' => 'Workphone',
			'fax' => 'Fax',
			'proffession' => 'Proffession',
			'gender' => 'Gender',
			'passportno' => 'Passport/NIC Number',
			'sladdressline1' => 'Address In Sri Lanka Line 1',
			'sladdressline2' => 'Address In Sri Lanka Line 2',
			'sladdressline3' => 'Address In Sri Lanka Line 3',
			'sllandline' => 'Land Line',
			'slmobile' => 'Mobile',
			'slcontactperson' => 'Contact Person in Sri Lanka',
			'onlineuserid' => 'Onlineuserid',
			'deleted' => 'Deleted',
			'addedby' => 'Addedby',
			'addeddate' => 'Addeddate',
			'addedtime' => 'Addedtime',
			'lastmodifiedby' => 'Lastmodifiedby',
			'lastmodifieddate' => 'Lastmodifieddate',
			'lastmodifiedtime' => 'Lastmodifiedtime',
			'deletedby' => 'Deletedby',
			'deleteddate' => 'Deleteddate',
			'deletedtime' => 'Deletedtime',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('familyname',$this->familyname,true);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('addressline1',$this->addressline1,true);
		$criteria->compare('addressline2',$this->addressline2,true);
		$criteria->compare('postcode',$this->postcode,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('Skype',$this->Skype,true);
		$criteria->compare('landline',$this->landline,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('workphone',$this->workphone,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('proffession',$this->proffession,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('passportno',$this->passportno,true);
		$criteria->compare('sladdressline1',$this->sladdressline1,true);
		$criteria->compare('sladdressline2',$this->sladdressline2,true);
		$criteria->compare('sladdressline3',$this->sladdressline3,true);
		$criteria->compare('sllandline',$this->sllandline,true);
		$criteria->compare('slmobile',$this->slmobile,true);
		$criteria->compare('slcontactperson',$this->slcontactperson,true);
		$criteria->compare('onlineuserid',$this->onlineuserid);
		$criteria->compare('deleted',0);
		$criteria->compare('addedby',$this->addedby);
		$criteria->compare('addeddate',$this->addeddate,true);
		$criteria->compare('addedtime',$this->addedtime,true);
		$criteria->compare('lastmodifiedby',$this->lastmodifiedby);
		$criteria->compare('lastmodifieddate',$this->lastmodifieddate,true);
		$criteria->compare('lastmodifiedtime',$this->lastmodifiedtime,true);
		$criteria->compare('deletedby',$this->deletedby);
		$criteria->compare('deleteddate',$this->deleteddate,true);
		$criteria->compare('deletedtime',$this->deletedtime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,

			'sort'=>array(
				'defaultOrder'=>'customercode DESC',
			),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Customerdetails the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public static function getCustomers(){
            $c = new CDbCriteria();
            $c->compare('deleted', 0);
            $c->order = 'firstname';
            $data = self::model()->findAll($c);
            
            return $data;
        }
        
        function getFullName()
        {
            return $this->firstname.' '.$this->familyname;
        }
        
        public static function getFullAddress($customercode){
            $customer = Customerdetails::model()->findByPk($customercode);
            $add = isset($customer->addressline1) ? $customer->addressline1.' ' : '';
            $add .= isset($customer->addressline2) ? $customer->addressline2.' ' : '';
            $add .= isset($customer->postcode) ? $customer->postcode.' ' : '';
            $add .= isset($customer->country) ? $customer->country.'. ' : '';
            $add . '.';
            
            if($customer)
                return $add;
            
            return '-';
        }
        
        public static function getFullName2($customercode){
            $customer = Customerdetails::model()->findByPk($customercode);
            $name = isset($customer->title) ? $customer->title.'. ' : '';
            $name .= isset($customer->firstname) ? $customer->firstname.' ' : '';
            $name .= isset($customer->familyname) ? $customer->familyname.' ' : '';
            
            
            if($customer)
                return $name;
            
            return '-';
        }

	 public static function getCustomer($customer_id){
		 return Customerdetails::model()->findByPk($customer_id)->attributes;
	 }
}
