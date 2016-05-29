<?php

/**
 * This is the model class for table "projectdetails".
 *
 * The followings are the available columns in table 'projectdetails':
 * @property integer $refno
 * @property integer $locationcode
 * @property integer $projectcode
 * @property integer $customercode
 * @property integer $housecatcode
 * @property string $blocknumber
 * @property double $blocksize
 * @property double $blockprice
 * @property string $reservedate
 * @property integer $reservestatus
 * @property integer $paymentmethod
 * @property string $duedate
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
class ProjectDetails extends NmwndbActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'projectdetails';
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
			array('locationcode, projectcode, customercode, housecatcode, blocknumber, blocksize, blockprice, reservedate, paymentmethod, duedate', 'required'),
			array('locationcode, projectcode, customercode, housecatcode, reservestatus, paymentmethod, deleted, addedby, lastmodifiedby, deletedby', 'numerical', 'integerOnly'=>true),
			array('blocksize, blockprice', 'numerical'),
			array('blocknumber', 'length', 'max'=>100),
			array('addeddate, addedtime, lastmodifieddate, lastmodifiedtime, deleteddate, deletedtime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('refno, locationcode, projectcode, customercode, housecatcode, blocknumber, blocksize, blockprice, reservedate, reservestatus, paymentmethod, duedate, deleted, addedby, addeddate, addedtime, lastmodifiedby, lastmodifieddate, lastmodifiedtime, deletedby, deleteddate, deletedtime', 'safe', 'on'=>'search'),
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
			'projectDetails' => array(self::BELONGS_TO, 'ProjectMaster', 'projectcode'),
			'customerDetails' => array(self::BELONGS_TO, 'Customerdetails', 'customercode'),
			'locationDetails' => array(self::HAS_ONE, 'LocationMaster', 'locationcode'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'refno' => 'Refno',
			'locationcode' => 'Location Code',
			'projectcode' => 'Project Code',
			'customercode' => 'Customer Code',
			'housecatcode' => 'Housecat Code',
			'blocknumber' => 'Block Number',
			'blocksize' => 'Block Size',
			'blockprice' => 'Block Price',
			'reservedate' => 'Reserve Date',
			'reservestatus' => 'Reserve Status',
			'paymentmethod' => 'Payment Method',
			'duedate' => 'Duedate',
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

		$criteria->compare('refno',$this->refno);
		$criteria->compare('locationcode',$this->locationcode);
		$criteria->compare('projectcode',$this->projectcode);
		$criteria->compare('customercode',$this->customercode);
		$criteria->compare('housecatcode',$this->housecatcode);
		$criteria->compare('blocknumber',$this->blocknumber,true);
		$criteria->compare('blocksize',$this->blocksize);
		$criteria->compare('blockprice',$this->blockprice);
		$criteria->compare('reservedate',$this->reservedate,true);
		$criteria->compare('reservestatus',$this->reservestatus);
		$criteria->compare('paymentmethod',$this->paymentmethod);
		$criteria->compare('duedate',$this->duedate,true);
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
	 * @return ProjectDetails the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function getBlockListData($project_id){

		$criteria = new CDbCriteria();
		$criteria->compare('deleted', 0);
		$criteria->compare('projectcode', $project_id);
		$data = self::model()->findAll($criteria);

		return $data;

	}

	public static function getBlock($block_id){
		return ProjectDetails::model()->findByPk($block_id)->attributes;
	}

	public function setBlockSoldOut($block_id, $customer_id){
		$block = $this->findByPk($block_id);
		$block->reservestatus = 2;
		$block->customercode = $customer_id;
		$block->save();

		return true;


	}
}
