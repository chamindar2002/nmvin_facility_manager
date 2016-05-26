<?php

/**
 * This is the model class for table "location".
 *
 * The followings are the available columns in table 'location':
 * @property integer $locationcode
 * @property string $locationname
 * @property string $locationcity
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
class LocationMaster extends NmwndbActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'location';
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
			array('locationname, locationcity', 'required'),
			array('deleted, addedby, lastmodifiedby, deletedby', 'numerical', 'integerOnly'=>true),
			array('locationname, locationcity', 'length', 'max'=>100),
			array('addeddate, addedtime, lastmodifieddate, lastmodifiedtime, deleteddate, deletedtime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('locationcode, locationname, locationcity, deleted, addedby, addeddate, addedtime, lastmodifiedby, lastmodifieddate, lastmodifiedtime, deletedby, deleteddate, deletedtime', 'safe', 'on'=>'search'),
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
			'locationcode' => 'Locationcode',
			'locationname' => 'Location Name',
			'locationcity' => 'Location City',
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

		$criteria->compare('locationcode',$this->locationcode);
		$criteria->compare('locationname',$this->locationname,true);
		$criteria->compare('locationcity',$this->locationcity,true);
		$criteria->compare('deleted',$this->deleted);
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
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LocationMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public static function getLocations(){
            $c = new CDbCriteria();
            $c->compare('deleted', 0);
            $c->order = 'locationname';
            $data = self::model()->findAll($c);
            
            return $data;
        }
}
